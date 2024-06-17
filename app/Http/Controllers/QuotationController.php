<?php

namespace App\Http\Controllers;

use PDF;
use App\User;
use Mpdf\Mpdf;
use App\Branch;
use App\Details;
use App\Product;
use App\Service;
use App\Vehicle;
use App\Washbay;
use App\SalePart;
use App\BranchSetting;
use App\JobcardDetail;
use App\CheckoutCategory;
use App\QuoteObservation;
use App\tbl_service_pros;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Labours;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


	/*Listing of Quotation Service*/
	public function list()
	{
		$month = date('m');
		$year = date('Y');
		$available = "";
		$servi_id = "";
		$start_date = "$year/$month/01";
		$end_date = "$year/$month/30";
		$current_month = DB::select("SELECT service_date FROM tbl_services where service_date BETWEEN  '$start_date' AND '$end_date'");

		if (!empty($current_month)) {
			foreach ($current_month as $list) {
				$date[] = $list->service_date;
			}
			$available = json_encode($date);
		}

		$ser_id_jobcard_details = DB::table('tbl_jobcard_details')->get()->toArray();
		foreach ($ser_id_jobcard_details as $ser_id) {
			$servi_id = $ser_id->service_id;
		}

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::user()->role_id) == 'Customer') {
				if (Gate::allows('quotation_owndata')) {
					$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['customer_id', '=', Auth::User()->id], ['is_quotation', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
				} else {
					$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['is_quotation', '=', 1], ['branch_id', $adminCurrentBranch->branch_id], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
				}
			} elseif (getUsersRole(Auth::user()->role_id) == 'Employee' || getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
				if (Gate::allows('quotation_owndata')) {
					$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['create_by', '=', Auth::User()->id], ['is_quotation', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
				} else {
					$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['is_quotation', '=', 1], ['branch_id', $adminCurrentBranch->branch_id], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
				}
			}
		} elseif (Auth::user()->role_id === 1) {
			$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['is_quotation', '=', 1], ['soft_delete', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'ASC')->get()->toArray();

		} elseif (Auth::user()->role_id === 6) {
			$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['is_quotation', '=', 1], ['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->orderBy('id', 'ASC')->get()->toArray();

		} 
		
		

		return view('quotation/list', compact('service', 'available', 'current_month', 'servi_id'));
	}
	

	/*Add new Quotation Service*/
	public function index()
	{
		//Get last Jobcard data
		$last_order = DB::table('tbl_services')->latest()->where('sales_id', '=', null)->first();

		if (!empty($last_order)) {
		// Get the last jobcard number
		$lastJobcardNumber = $last_order->job_no;

		// Extract the numeric part of the jobcard number
		$lastNumber = intval(substr($lastJobcardNumber, -4));

		// Increment the last number
		$incrementedNumber = $lastNumber + 1;

		// Generate jobcard number with format RMAL-RP-24-<increment>
		$prefix = 'RMAL-RP-24-';
		$new_number = $prefix . str_pad($incrementedNumber, 4, '0', STR_PAD_LEFT);
			} else {
		// If no previous jobcard found, start from 0001
		$new_number = 'RMAL-RP-24-0001';
			}

       	$code = $new_number;
		$customer = DB::table('users')->where([['role', 'Customer'], ['soft_delete', 0]])->get()->toArray();
		$country = DB::table('tbl_countries')->get()->toArray();
		$onlycustomer = DB::table('users')->where([['role', '=', 'Customer'], ['id', '=', Auth::User()->id]])->first();
		$vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
		$fuel_type = DB::table('tbl_fuel_types')->where('soft_delete', '=', 0)->get()->toArray();
		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get()->toArray();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();
		$tax = DB::table('tbl_account_tax_rates')->where([['soft_delete', '=', 0]])->get()->toArray();
		$inspection_points_library_data = DB::table('inspection_points_library')->get();

		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$taxes = DB::table('tbl_account_tax_rates')->where('soft_delete', '=', 0)->get()->toArray();
		$payment = DB::table('tbl_payments')->where('soft_delete', '=', 0)->get()->toArray();
        $job_cartegory = DB::table('tbl_products')->where([['soft_delete', '=', 0]])->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		$adminBranch = BranchSetting::where('id', '=', 2)->first();
		if (Auth::User()->role_id === 1) {
			$vehicle_name = Vehicle::where([['soft_delete', '=', 0], ['branch_id', '=', $adminCurrentBranch->branch_id]])->get();
            $cat_name = CheckoutCategory::where([['soft_delete', '=', 0], ['branch_id', '=', $adminCurrentBranch->branch_id]])->get();
			$branchDatas = Branch::get();
			$customer = DB::table('users')->where([['role', '=', 'Customer'], ['soft_delete', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
			$brand = DB::table('tbl_products')->where([['category', '=', 1], ['soft_delete', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
			$stockQuantities = [];
			foreach ($brand as $brands) {
				$stockQuantities[$brands->id] = $brands->quantity; // Assuming 'stock_quantity' is the field for available stock
			}
			$manufacture_name = DB::table('tbl_product_types')->where('soft_delete', '=', 0)->get()->toArray();
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
		} elseif (Auth::User()->role_id === 6) {
			$vehicle_name = Vehicle::where([['soft_delete', '=', 0], ['branch_id', '=', $currentUser->branch_id]])->get();
			$customer = DB::table('users')->where([['role', '=', 'Customer'], ['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
            $cat_name = CheckoutCategory::where([['soft_delete', '=', 0], ['branch_id', '=', $currentUser->branch_id]])->get();
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
			$brand = DB::table('tbl_products')->where([['category', '=', 1], ['soft_delete', '=', 0], ['branch_id',  $currentUser->branch_id]])->get()->toArray();
			$stockQuantities = [];
			foreach ($brand as $brands) {
				$stockQuantities[$brands->id] = $brands->quantity; // Assuming 'stock_quantity' is the field for available stock
			}
			$manufacture_name = DB::table('tbl_product_types')->where('soft_delete', '=', 0)->get()->toArray();
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		
		}
		 elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$vehicle_name = Vehicle::where('soft_delete', '=', 0)->get();
            $cat_name = CheckoutCategory::where('soft_delete', '=', 0)->distinct()->select('checkout_point')->get();
			$employee = DB::table('users')->where('role', '=', 'Employee')->where('soft_delete', '=', 0)->get()->toArray();
			$brand = DB::table('tbl_products')->where([['category', '=', 1], ['soft_delete', '=', 0]])->get()->toArray();
			$stockQuantities = [];
			foreach ($brand as $brands) {
				$stockQuantities[$brands->id] = $brands->quantity; // Assuming 'stock_quantity' is the field for available stock
			}
			$manufacture_name = DB::table('tbl_product_types')->where('soft_delete', '=', 0)->get()->toArray();
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0]])->get()->toArray();
		}

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'salepart'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$repairCategoryList = DB::table('table_repair_category')->where([['soft_delete', 0]])->get()->toArray();

		return view('quotation.add', compact('stockQuantities','customer', 'employee', 'code', 'color', 'taxes', 'payment', 'brand', 'manufacture_name', 'tbl_custom_fields', 'branchDatas','employee', 'customer', 'code', 'country', 'onlycustomer', 'vehical_brand', 'vehical_type', 'fuel_type', 'color', 'tbl_custom_fields', 'inspection_points_library_data', 'tax', 'branchDatas', 'repairCategoryList','vehicle_name', 'cat_name','job_cartegory', 'model_name'));
	}


	/*Save Quotation Service Data inside Service Table (First step of add service)*/
	public function store(Request $request)
{
    // Initialize variables
    $finalCharge = 0; // Initial charge from the request
    $job = $request->jobno;
    $Customername = $request->Customername;
    $vehicalname = $request->vehicalname;
    $title = $request->title;
    $service_category = $request->repair_cat;
    $ser_type = $request->service_type;
    $details = $request->details;
    $discountPercentage = $request->discountPercentage;
    $totalProductPrice = 0;

    // Format the date
    if (getDateFormat() == 'm-d-Y') {
        $date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date)));
    } else {
        $date = date('Y-m-d H:i:s', strtotime($request->date));
    }

    // Calculate the total price of all products
    $products = $request->product;
    if (!empty($products)) {
        foreach ($products['product_id'] as $key => $value) {
            $description = $products['product_id'][$key];
            $qty = $products['qty'][$key];
            $price = $products['price'][$key];
            $total_price = $products['total_price'][$key];
            $manufacture = $products['Manufacturer_id'][$key];

            // Create and save product details
            $info = new Details;
            $info->quantity = $qty;
            $info->quotation_id = $job;
            $info->price = $price;
            $info->total_price = $total_price;
            $info->product_id = $description;
            $info->product_type_id = $manufacture;
            $info->sellman = Auth::user()->id;
            $info->customer_id = $Customername;
            $info->branch_id = $request->branch;
            $info->date = $date;
            $characters = '0123456789';
            $code = 'SP' . substr(str_shuffle($characters), 0, 6);
            $info->bill_no = $code;

            $info->save();

            // Update product quantity
            $product = Product::find($description);
            if ($product) {
                $product->quantity -= $qty; // Subtract the sold quantity from the current quantity
                $product->save();
            }

            // Add the total price of this product to the total product price
            $totalProductPrice += $total_price;
        }
    }

    // Apply discount if provided
    if ($discountPercentage) {
        $discountAmount = ($discountPercentage / 100) * $finalCharge;
        $finalCharge -= $discountAmount;

        // Calculate discount on total product price
        $discountedProductPrice = ($discountPercentage / 100) * $totalProductPrice;
        $finalCharge += $discountedProductPrice;

			// Create and save service details
		$services = new Service;
		$services->job_no = $job;
		$services->vehicle_id = $vehicalname;
		$services->service_date = $date;
		$services->title = $title;
		$services->service_category = $service_category;
		$services->done_status = 0;
		$services->charge = $finalCharge + $request->charge; // Save the final charge including product prices and discount
		$services->customer_id = $Customername;
		$services->detail = $details;
		$services->service_type = $ser_type;
		$services->is_quotation = 1;
		$services->quotation_modify_status = 1;
		$services->branch_id = $request->branch;
		$services->create_by = Auth::User()->id;

		// Save custom fields
		$custom = $request->custom;
		$custom_field_value = [];
		if (!empty($custom)) {
			foreach ($custom as $key => $value) {
				$custom_field_value[] = [
					'id' => $key,
					'value' => is_array($value) ? implode(",", $value) : $value
				];
			}
			$services->custom_field = json_encode($custom_field_value);
		}

		if (!empty($request->Tax)) {
			$services->tax_id = implode(', ', $request->Tax);
		}

		$services->save();


    } else {
        // Add total product price to the final charge
        $finalCharge += $totalProductPrice;
		// Create and save service details
		$services = new Service;
		$services->job_no = $job;
		$services->vehicle_id = $vehicalname;
		$services->service_date = $date;
		$services->title = $title;
		$services->service_category = $service_category;
		$services->done_status = 0;
		$services->charge = $finalCharge + $request->charge; // Save the final charge including product prices and discount
		$services->customer_id = $Customername;
		$services->detail = $details;
		$services->service_type = $ser_type;
		$services->is_quotation = 1;
		$services->quotation_modify_status = 1;
		$services->branch_id = $request->branch;
		$services->create_by = Auth::User()->id;

		// Save custom fields
		$custom = $request->custom;
		$custom_field_value = [];
		if (!empty($custom)) {
			foreach ($custom as $key => $value) {
				$custom_field_value[] = [
					'id' => $key,
					'value' => is_array($value) ? implode(",", $value) : $value
				];
			}
			$services->custom_field = json_encode($custom_field_value);
		}

		if (!empty($request->Tax)) {
			$services->tax_id = implode(', ', $request->Tax);
		}

		$services->save();

    }

    
    
    // Handle washbay status
    $washbay_status = $request->washbay;
    if ($washbay_status == 'on') {
        $washbay_charge = $request->washBayCharge;
        $washbays = new Washbay;
        $washbays->service_id = $services->id;
        $washbays->jobcard_no = $job;
        $washbays->vehicle_id = $vehicalname;
        $washbays->customer_id = $Customername;
        $washbays->price = $washbay_charge;
        $washbays->save();
    }

    // Redirect to the quotation modify page
    return redirect()->route('quotation_modify', ['id' => $services->id]);
}




	//Quotation Modify Form(Observation Points and Other Products)
	public function quotationModify($id)
	{
		$viewid = $id;
		$first = $color = null;
		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id', '=', $id)->get()->toArray();
		$services = DB::table('tbl_services')->where('id', '=', $id)->first();
		$v_id = $services->vehicle_id;
		$s_id = $services->sales_id;
		$sales = DB::table('tbl_sales')->where('id', '=', $s_id)->first();

		$s_date = DB::table('tbl_sales')->where('vehicle_id', '=', $v_id)->first();
		if (!empty($s_date)) {
			$color_id = $s_date->color_id;
			$color = DB::table('tbl_colors')->where('id', '=', $color_id)->first();
		}

		$service_data = DB::table('tbl_services')->latest()->first();
		if (!empty($v_id)) {
			$vehicale = DB::table('tbl_vehicles')->where('id', '=', $v_id)->first();
			$model_id = getModel_id($vehicale->modelname);
		}

		$job = DB::table('tbl_jobcard_details')->where('service_id', '=', $id)->first();

		$pros = DB::table('tbl_service_pros')->where([['service_id', '=', $id], ['type', '=', '1']])->get()->toArray();

		$pros2 = DB::table('tbl_service_pros')->where([['service_id', '=', $id], ['type', '=', '0']])->get()->toArray();

		$obser_id = DB::table('tbl_service_observation_points')->where('services_id', $viewid)->get()->toArray();

		$tbl_observation_points = DB::table('tbl_observation_points')->where('observation_type_id', '=', 1)->get()->toArray();
		$tbl_observation_service = DB::table('tbl_observation_points')->where('observation_type_id', '=', 2)->get()->toArray();
		$vehicalemodel = DB::table('tbl_vehicles')->get()->toArray();
		$tbl_points = DB::table('tbl_points')->get()->toArray();

		$c_point = DB::table('tbl_checkout_categories')->get()->toArray();
		if (!empty($c_point)) {
			$point_count = count($c_point);
			$total = ceil($point_count / 3);
			$categorypoint = (array_chunk($c_point, $total));
			$first = $categorypoint[0];
		}

		$tax = DB::table('tbl_account_tax_rates')->get()->toArray();
		$logo = DB::table('tbl_settings')->first();

		$data = DB::select("select tbl_service_pros.*, tbl_points.*,tbl_service_observation_points.id from tbl_points join tbl_service_observation_points on tbl_service_observation_points.observation_points_id = tbl_points.id join tbl_service_pros on tbl_service_pros.tbl_service_observation_points_id = tbl_service_observation_points.id where tbl_service_observation_points.services_id = $viewid and tbl_service_observation_points.review = 1 and tbl_service_pros.type = 0");
        

		/*Get status of MoT test is it checked or not*/
		$fetch_mot_test_status = DB::table('tbl_services')->where('id', '=', $id)->first();

		$washbay_price = Washbay::where([['jobcard_no', '=', $services->job_no], ['service_id', '=', $services->id]])->first();

		$washbayPrice = null;
		if (!empty($washbay_price)) {
			$washbayPrice = $washbay_price->price;
		}

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if ((Auth::User()->role_id === 1)) {
			$product = DB::table('tbl_products')->where([['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
			$tbl_checkout_categories = DB::table('tbl_checkout_categories')->where('vehicle_id', '=', $model_id)->orWhere('vehicle_id', '=', 0)->get()->toArray();
			$tbl_checkout_categories = DB::table('tbl_checkout_categories')->where([['vehicle_id', '=', $model_id], ['soft_delete', '=', 0]])->orWhere('vehicle_id', '=', 0)->where('branch_id', '=', $adminCurrentBranch->branch_id)->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$product = DB::table('tbl_products')->where([['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
			$employees = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0]])->get()->toArray();
			$tbl_checkout_categories = DB::table('tbl_checkout_categories')->where([['vehicle_id', '=', $model_id], ['soft_delete', '=', 0]])->orWhere('vehicle_id', '=', 0)->get()->toArray();
			$names = 1;
		} else {
			$product = DB::table('tbl_products')->where([['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
			$tbl_checkout_categories = DB::table('tbl_checkout_categories')->where([['vehicle_id', '=', $model_id], ['soft_delete', '=', 0]])->orWhere('vehicle_id', '=', 0)->where('branch_id', '=', $currentUser->branch_id)->get()->toArray();
		}

		$categoryJob = DB::table('table_repair_category')->get();
		$selectProduct = DB::table('inspection_points_library')->get();

		return view('quotation.quotationmodify', compact('categoryJob','selectProduct','viewid', 'services', 'tbl_observation_points', 'tbl_observation_service', 'tbl_service_observation_points', 'vehicale', 'sales', 'product', 's_id', 'job', 'pros', 'pros2', 'tbl_checkout_categories', 'first', 'vehicalemodel', 'tbl_points', 's_date', 'color', 'service_data', 'tax', 'logo', 'obser_id', 'data', 'fetch_mot_test_status', 'washbayPrice'));
	}

	public function quotationSales($id)
	{
		// $services = DB::table('tbl_services')->where('id', '=', $id)->first();
		$service = DB::table('tbl_services')->where('id', '=', $id)->first();
		
		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		

		$manufacture_name = DB::table('tbl_product_types')->where('soft_delete', '=', 0)->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		
		if (Auth::user()->role_id === 1) {
			$brand = Product::where([['category', 1], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get();
			$sales = Details::where([['quotation_id', $service->job_no], ['branch_id', $adminCurrentBranch->branch_id]])->first();
			$stock = Details::where([['quotation_id', $sales->quotation_id], ['branch_id', $adminCurrentBranch->branch_id]])->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
		} elseif (Auth::user()->role_id === 6) {
			$brand = Product::where([['category', 1], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get();
			$sales = Details::where([['quotation_id', $service->job_no], ['branch_id', $currentUser->branch_id]])->first();
			$stock = Details::where([['quotation_id', $sales->quotation_id], ['branch_id', $currentUser->branch_id]])->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		} elseif (Auth::user()->role == "Customer") {
			$sales = Details::where('quotation_id', $service->job_no)->first();
			$brand = Product::where([['category', 1], ['soft_delete', '=', 0]])->get();
			$stock = Details::where('bill_no', '=', $sales->bill_no)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0]])->get()->toArray();
		}else {
			$brand = Product::where([['category', 1], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get();
			$sales = Details::where([['quotation_id', $service->job_no], ['branch_id', $currentUser->branch_id]])->first();
			$stock = Details::where([['quotation_id', $sales->quotation_id], ['branch_id', $currentUser->branch_id]])->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		}

		$repairCategoryList = DB::table('table_repair_category')->where([['soft_delete', 0]])->get()->toArray();

		return view('quotation.quotationSales', compact('sales','brand', 'stock', 'service', 'employee', 'manufacture_name', 'tbl_custom_fields','branchDatas', 'repairCategoryList'));
	}

	//jobcard store
	public function add_modify_quotation(Request $request)
	{
		$job_no = $request->job_no;
		$service_id = $request->service_id;
		// $kms = $request->kms;
		$coupan_no = $request->coupan_no;
		$product2 = $request->product2;
		$chargeable = $request->yesno_;
		$obs_auto_id = $request->obs_id;

		if (getDateFormat() == 'm-d-Y') {
			$in_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->in_date)));
			$odate = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->out_date)));
		} else {
			$in_date = date('Y-m-d H:i:s', strtotime($request->in_date));
			$odate = date('Y-m-d H:i:s', strtotime($request->out_date));
		}

		// Extract observation data
        $observations = $request->input('jognum');

        // Example processing: Loop through observations and save to database
        foreach ($observations['Manufacturer_id'] as $index => $manufacturerId) {
            $productId = $observations['product_id'][$index] ?? null;
            $quantity = $observations['qty'][$index] ?? null;

            // Perform validation (you can use Laravel's validator or request validation)

            // Example insert to database
            if ($manufacturerId && $productId && $quantity) {
                // Assuming you have an Observation model
                QuoteObservation::create([
					'quotation_id' => $request->job_no,
                    'job_cartegory_name' => $manufacturerId,
                    'product' => $productId,
                    'observation' => $quantity,
                ]);
            }
        }


		$checking_servicePro = 0;
		$checking_jobcardTable = 0;

		if (!empty($product2)) {
			foreach ($product2['product_id'] as $key => $value) {
				$charge_abl = $chargeable[$key];
				$obs_auto = $obs_auto_id[$key];
				$product_id2 = $product2['product_id'][$key];
				$price2 = $product2['price'][$key];
				$qty2 = $product2['qty'][$key];
				$total2 = $product2['total'][$key];
				$category = $product2['category'][$key];
				$sub = $product2['sub_points'][$key];
				$comment = $product2['comment'][$key];
				$service_charge = $product2['service_charge'][$key];

				$old_data = DB::table('tbl_service_pros')->where([['service_id', '=', $service_id], ['category', '=', $category], ['obs_point', '=', $sub]])->count();

				if ($old_data == 0) {
					$tbl_service_pros = new tbl_service_pros;
					$tbl_service_pros->service_id = $service_id;
					$tbl_service_pros->product_id = $product_id2;
					$tbl_service_pros->tbl_service_observation_points_id = $obs_auto;
					$tbl_service_pros->quantity = $qty2;
					$tbl_service_pros->price = $price2;
					$tbl_service_pros->total_price = $total2;
					$tbl_service_pros->category = $category;
					$tbl_service_pros->obs_point = $sub;
					$tbl_service_pros->category_comments = $comment;
					$tbl_service_pros->service_charge = $service_charge;
					$tbl_service_pros->chargeable = $charge_abl;
					$tbl_service_pros->save();

					if ($tbl_service_pros->save()) {
						$checking_servicePro = 1;
					}
				} else {
					// dd($product_id2, $qty2, $price2, $total2, $charge_abl, $comment, $service_id, $category, $sub);
					DB::update("update tbl_service_pros set 
														product_id = '$product_id2',
														quantity = '$qty2',
														price = '$price2', 
														total_price = '$total2',
														chargeable = '$charge_abl',
														category_comments='$comment',
														service_charge='$service_charge'
														where service_id = $service_id and category = '$category' and obs_point = '$sub'");

					$checking_servicePro = 1;
				}
			}
		}
		$ot_product = $request->other_product;
		$ot_price = $request->other_price;

		if (!empty($ot_product)) {
			$prd_delete = DB::table('tbl_service_pros')->where([['service_id', '=', $service_id], ['tbl_service_observation_points_id', '=', null]])->delete();

			foreach ($ot_product as $key => $value) {
				$prod = $ot_product[$key];
				$pri = $ot_price[$key];

				$othr_pr = DB::table('tbl_service_pros')->where([['service_id', '=', $service_id], ['comment', '=', $prod]])->count();
				if ($othr_pr == 0) {
					if ($prod != null && $pri != null) {
						$tbl_service_pros = new tbl_service_pros;
						$tbl_service_pros->service_id = $service_id;
						$tbl_service_pros->comment = $prod;
						$tbl_service_pros->total_price = $pri;
						$tbl_service_pros->type = 1;
						$tbl_service_pros->save();

						if ($tbl_service_pros->save()) {
							$checking_servicePro = 1;
						}
					}
					
				}
			}
		}
		$tblcountjob = DB::table('tbl_jobcard_details')->where('jocard_no', '=', $job_no)->count();
		if ($tblcountjob == 0) {
			$servicedd = DB::table('tbl_services')->where('job_no', '=', $job_no)->first();
			$cus_id = $servicedd->customer_id;
			$vehi_id = $servicedd->vehicle_id;

			$tbl_jobcard_details = new JobcardDetail;
			$tbl_jobcard_details->customer_id = $cus_id;
			$tbl_jobcard_details->vehicle_id = $vehi_id;
			$tbl_jobcard_details->service_id = $service_id;
			$tbl_jobcard_details->jocard_no = $job_no;
			$tbl_jobcard_details->in_date = $in_date;
			// $tbl_jobcard_details->kms_run = $kms;
			if (!empty($coupan_no)) {
				$tbl_jobcard_details->coupan_no = $coupan_no;
			}
			$tbl_jobcard_details->save();

			if ($tbl_jobcard_details->save()) {
				$checking_jobcardTable = 1;
			}
		}

		/*If Mot Test done then Add to related service charge*/
		$get_mot_status_of_service_tbl = DB::table('tbl_services')->where('id', '=', $service_id)->first();

		if ($get_mot_status_of_service_tbl->mot_status == 1) {

			//Add related prices
		} else {
			//Nothing to Add anything
		}

		$finalSubmit = $request->finalSubmit;

		/*------------------- Quotation pdf mail send to customer start ----------------------*/

		$serviceid = $service_id;
		$tbl_services = DB::table('tbl_services')->where('id', '=', $serviceid)->first();
		$jobcard = $tbl_services->job_no;
		// $service_data = DB::table('tbl_services')->where('id', $ser_id)->first();
		

		if (getObservationPriceFillOrNot($jobcard) == true) {
			$c_id = $tbl_services->customer_id;
			$v_id = $tbl_services->vehicle_id;

			$job = DB::table('tbl_jobcard_details')->where('service_id', '=', $serviceid)->first();
			$s_date = DB::table('tbl_sales')->where('vehicle_id', '=', $v_id)->first();
			$vehical = DB::table('tbl_vehicles')->where('id', '=', $v_id)->first();
			$customer = DB::table('users')->where('id', '=', $c_id)->first();

			$service_pro = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
				->where('type', '=', 0)
				->where('chargeable', '=', 1)
				->get()->toArray();

			$service_pro2 = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
				->where('type', '=', 1)->get()->toArray();

			$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id', '=', $serviceid)->get();

			$logo = DB::table('tbl_settings')->first();

			if (!empty($tbl_services->tax_id)) {
				$service_taxes = explode(', ', $tbl_services->tax_id);
			} else {
				$service_taxes = '';
			}
			$washbay_data = Washbay::where('service_id', '=', $serviceid)->first();
			$all_data3 = DB::table('tbl_details')->where([['quotation_id', $job_no]])->get()->toArray();
			$custo_info = DB::table('users')->where('id', $c_id)->first();
			$vehi_name = $tbl_services->vehicle_id;
			$Vehicle_inf = DB::table('tbl_vehicles')->where('id', $vehi_name)->first();
			$maker = $Vehicle_inf->vehiclebrand_id;
			$chassis_no = $Vehicle_inf->chassisno;

			$mpdf = new Mpdf();

			// Get the HTML content from the view
			$html = view('quotation.quotationservicepdf', compact('Vehicle_inf','maker','vehi_name','chassis_no','all_data3','tbl_services', 'logo', 'job', 's_date', 'vehical', 'customer', 'service_pro', 'service_pro2', 'service_taxes', 'washbay_data'));

			// Write HTML content to the PDF
			$mpdf->autoLangToFont = true;
			$mpdf->autoScriptToLang = true;
			$mpdf->WriteHTML($html);

			$str = "1234567890";
			$str1 = str_shuffle($str);

			$filename = 'QUOTATION-' . $str1 . '.pdf';

			$filePath = 'public/pdf/quotation/' . $filename;
			$pdfContents = $mpdf->Output($filePath, Destination::FILE);
			$quotation = URL::to($filePath);

			// Output the PDF and save it to the specified path
			// $mpdf->Output($filePath, Destination::FILE);

			// return response()->download($filePath, $filename); 


			/********************* Email format for service quotation **********************/

			/*Send url inside mail to get confirmation about service quotation of customer*/
			$base_url = url('/');

			//For Quotation pdf file with path
			$pdfFileName = $str1 . ".pdf";
			$normalPdfFilePath = "/public/pdf/quotation/" . $pdfFileName;
			$fullQuotationPdfPath = $base_url . $normalPdfFilePath;

			$mailSendStatus = 0;
			//Admin email id
			$admin_email = DB::table('users')->where([['id', '=', 1], ['role', '=', 'admin']])->orderBy('id', 'DESC')->pluck('email')->first();

			//Customer email id
			$user = DB::table('users')->where('id', '=', $c_id)->first();
			$email = $user->email;

			//currencie code
			$currencie_symbol = getCurrencySymbols();

			//For live purpose email id, user and admin email id
			$emails = [$user->email, $admin_email];

			$firstname = getUserFullName($c_id);
			$systemname = $logo->system_name;
			$title = $tbl_services->title;
			$sDate = $tbl_services->service_date;
			$details = $tbl_services->detail;
			$vehicleName = getVehicleName($tbl_services->vehicle_id);


			//Get total amount of quotation
			$final_grand_total = getTotalPriceOfQuotation($tbl_services->id);

			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'service_quotation_pdf_mail_accept_or_declined')->first();
			try {
				if ($emailformats->is_send == 0) {
					$emailformat = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'service_quotation_pdf_mail_accept_or_declined')->first();
					$mail_format = $emailformat->notification_text;
					$mail_subjects = $emailformat->subject;
					$mail_send_from = $emailformat->send_from;

					$search1 = array('{ vehicle_name }', '{ jobcard_number }');
					$replace1 = array($vehicleName, $jobcard);
					$mail_sub = str_replace($search1, $replace1, $mail_subjects);

					$search = array('{ system_name }', '{ customer_name }', '{ detail }', '{ service_date }', '{ total_amount }', '{ currency_symbol }', '{ vehicle_name }', '{ download_file_url }', '{ download_file_name }');
					$replace = array($systemname, $firstname, $details, $sDate, $final_grand_total, $currencie_symbol, $vehicleName, $quotation, $pdfFileName);

					$email_content = str_replace($search, $replace, $mail_format);

					//live format email

					$server = $_SERVER['SERVER_NAME'];
					if (isset($_SERVER['HTTPS'])) {
						$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
					} else {
						$protocol = 'http';
					}
					// $url = "$protocol://$server/garage/public/pdf/service/".$str1.'.pdf';
					$url = URL::to('/public/pdf/quotation/' . $str1 . '.pdf');
					$fileatt = "test.pdf"; // Path to the file

					$fileatt_type = "application/pdf"; // File Type
					$fileatt_name = $str1 . '.pdf'; // Filename that will be used for the file as the attachment
					$email_from = $mail_send_from; // Who the email is from
					$email_subject = $mail_sub; // The Subject of the email
					$email_message = $email_content;

					$email_to = $email; // Who the email is to
					/* $headers = "{$from}";  */
					$headers = "From: " . $email_from;

					// $file = fopen($url, 'rb');


					// $contents = file_get_contents($url); // read the remote file
					// touch('temp.pdf'); // create a local EMPTY copy
					// file_put_contents('temp.pdf', $contents);


					// $data = fread($file, filesize("temp.pdf"));
					// // $data = fread($file,19189);
					// fclose($file);
					$semi_rand = md5(time());
					$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

					$headers .= "\nMIME-Version: 1.0\n" .
						"Content-Type: multipart/mixed;\n" .
						" boundary=\"{$mime_boundary}\"";
					$email_message .= "This is a multi-part message in MIME format.\n\n" .
						"--{$mime_boundary}\n" .
						"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
						"Content-Transfer-Encoding: 7bit\n\n" .
						$email_message .= "\n\n";
					$data = chunk_split(base64_encode(file_get_contents('temp.pdf')));
					$email_message .= "--{$mime_boundary}\n" .
						"Content-Type: {$fileatt_type};\n" .
						" name=\"{$fileatt_name}\"\n" .
						"Content-Transfer-Encoding: base64\n\n" .
						$data .= "\n\n" .
						"--{$mime_boundary}--\n";

					$actual_link = $_SERVER['HTTP_HOST'];
					$startip = '0.0.0.0';
					$endip = '255.255.255.255';
					if (($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <= $endip)) {
						//local format email

						$data = array(
							'email' => $email,
							'mail_sub1' => $mail_sub,
							'emailsend' => $mail_send_from,
							'email_content1' => $email_content,
							'pdf' => $pdfContents,
							'str' => $str1 . '.pdf',
						);
						$data1 = Mail::send('quotation.servicequotationmail', $data, function ($message) use ($data, $emails, $systemname) {

							$message->from($data['emailsend'], $systemname);
							// $message->attachData($data['pdf'], "quotation.pdf");
							$message->to($emails)->subject($data['mail_sub1']);
						});

						$mailSendStatus = 1;
					} else {
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$headers .= 'From:' . $email_from . "\r\n" .
							"CC: " . $admin_email;

						$ok = mail($email_to, $email_subject, $email_content, $headers);

						if ($ok != false) {
							$mailSendStatus = 1;
						}
					}
				}
			} catch (\Exception $e) {
			}
		}
		/*-------------------Quotation pdf mail send to customer end ----------------------*/

		if ($finalSubmit != null) {

			Service::where('id', '=', $service_id)->update(['quotation_modify_status' => 2]);

			return redirect('jobcard/list')->with('message', 'Quotation Submitted Successfully');
		} else {
			return redirect('/quotation/list')->with('message', 'Quotation Submitted Successfully');
		}
	}

	public function quotationFinal($service_id)
	{
		Service::where('id', '=', $service_id)->update(['quotation_modify_status' => 2]);

		return redirect('jobcard/list')->with('message', 'Quotation Submitted Successfully');
	}


	// pdf generate for download
	public function quotationPDF($service_id, Request $request)
	{
		$serviceid = $service_id;
		$tbl_services = DB::table('tbl_services')->where('id', '=', $serviceid)->first();
		$jobcard = $tbl_services->job_no;
		$vehi_name = $tbl_services->vehicle_id;
		$Vehicle_inf = DB::table('tbl_vehicles')->where('id', $vehi_name)->first();
		$maker = $Vehicle_inf->vehiclebrand_id;
		$chassis_no = $Vehicle_inf->chassisno;

		$all_data3 = DB::table('tbl_details')->where([['quotation_id', $jobcard]])->get()->toArray();


		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;

		$job = DB::table('tbl_jobcard_details')->where('service_id', '=', $serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id', '=', $v_id)->first();
		$vehical = DB::table('tbl_vehicles')->where('id', '=', $v_id)->first();
		$customer = DB::table('users')->where('id', '=', $c_id)->first();
		$washbay_data = Washbay::where('service_id', '=', $serviceid)->first();

		//For Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes']])->get()->toArray();

		$service_pro = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 0)
			->get()->toArray();

		$service_pro2 = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 1)->get()->toArray();

		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id', '=', $serviceid)->get();

		$logo = DB::table('tbl_settings')->first();

		if (!empty($tbl_services->tax_id)) {
			$service_taxes = explode(', ', $tbl_services->tax_id);
		} else {
			$service_taxes = null;
		}

		$mpdf = new Mpdf();

		// Get the HTML content from the view
		$html = view('quotation.quotationservicepdf', compact('maker','all_data3','vehi_name','chassis_no','Vehicle_inf','tbl_services', 'logo', 'job', 's_date', 'vehical', 'customer', 'service_pro', 'service_pro2', 'service_taxes', 'washbay_data', 'tbl_custom_fields'));

		// Write HTML content to the PDF
		$mpdf->autoLangToFont = true;
		$mpdf->autoScriptToLang = true;
		$mpdf->WriteHTML($html);

		$filename = 'QUOTATION-' . $tbl_services->job_no . '.pdf';

		$filePath = public_path('pdf/quotation/') . $filename;

		$mpdf->Output($filePath, Destination::FILE);

		// Check if page_action is set to 'mobile_app'
		if ($request->input('page_action') === 'mobile_app') {
			$filePath = 'public/pdf/quotation/' . $filename;
			$quotation = URL::to($filePath);
			return redirect($quotation);
		} else {
			return response()->download($filePath, $filename);
		}
	}

	public function quotationSend($service_id)
	{
		$serviceid = $service_id;
		$tbl_services = DB::table('tbl_services')->where('id', '=', $serviceid)->first();
		$jobcard = $tbl_services->job_no;

		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;

		$job = DB::table('tbl_jobcard_details')->where('service_id', '=', $serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id', '=', $v_id)->first();
		$vehical = DB::table('tbl_vehicles')->where('id', '=', $v_id)->first();
		$customer = DB::table('users')->where('id', '=', $c_id)->first();

		$service_pro = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 0)
			->where('chargeable', '=', 1)
			->get()->toArray();

		$service_pro2 = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 1)->get()->toArray();

		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id', '=', $serviceid)->get();

		$logo = DB::table('tbl_settings')->first();

		if (!empty($tbl_services->tax_id)) {
			$service_taxes = explode(', ', $tbl_services->tax_id);
		} else {
			$service_taxes = null;
		}

		$pdf = PDF::loadView('quotation.quotationservicepdf', compact('tbl_services', 'logo', 'job', 's_date', 'vehical', 'customer', 'service_pro', 'service_pro2', 'service_taxes'));
		$str = "1234567890";
		$str1 = str_shuffle($str);

		$filePath = 'public/pdf/quotation/' . $str1 . '.pdf';
		$pdf->save($filePath);
		$quotation = URL::to($filePath);
		$message = "Here is the PDF file for your quotation: $quotation";
		$mobile = getMobile($c_id);
		$whatsappURL = "https://api.whatsapp.com/send?phone=" . urlencode($mobile) . "&text=$message";

		return redirect($whatsappURL);
	}

	//Quotation modal view
	public function quotationView(Request $request)
	{
		$page_action = $request->page_action;
		$ser_id = $request->servicesid;
		$service_data = DB::table('tbl_services')->where('id', $ser_id)->first();
		$vehi_name = $service_data->vehicle_id;
		$cus_id = $service_data->customer_id;
		$cus_ids = $service_data->assign_to;
		$tbl_sales = DB::table('tbl_sales')->where('vehicle_id', $vehi_name)->first();

		if (!empty($tbl_sales)) {
			$regi = DB::table('tbl_sales')->where('vehicle_id', $vehi_name)->first();
		} else {
			$regi = DB::table('tbl_vehicles')->where('id', $vehi_name)->first();
		}
		$month = date('m');
		$year = date('Y');
		$start_date = "$year/$month/01";
		$end_date = "$year/$month/30";
		$current_month = DB::select("SELECT service_date FROM tbl_services where service_date BETWEEN  '$start_date' AND '$end_date'");

		if (!empty($current_month)) {
			foreach ($current_month as $list) {
				$date[] = $list->service_date;
			}
			$available = json_encode($date);
		}

		$Vehicle_inf = DB::table('tbl_vehicles')->where('id', $vehi_name)->first();
		$maker = $Vehicle_inf->vehiclebrand_id;
		$chassis_no = $Vehicle_inf->chassisno;

		$logo = DB::table('tbl_settings')->first();
		$custo_info = DB::table('users')->where('id', $cus_id)->first();
		$assigned  = DB::table('users')->where([['id', '=', $cus_ids], ['role', '=', 'employee']])->first();

		$used_cpn_data = DB::table('tbl_jobcard_details')->where('service_id', $ser_id)->first();

		$service_id = $ser_id;
		$numbers = $service_data->job_no;
		$all_data = DB::table('tbl_service_pros')->where([['service_id', $service_id], ['type', '=', 0]])->get()->toArray();
		$all_data2 = DB::table('tbl_service_pros')->where([['service_id', $service_id], ['type', '=', 1]])->get()->toArray();
		$all_data3 = DB::table('tbl_details')->where([['quotation_id', $numbers]])->get()->toArray();

		$service_taxes = null;
		if (!empty($service_data->tax_id)) {
			$service_taxes = explode(', ', $service_data->tax_id);
		} else {
			$service_taxes = '';
		}

		// $products = DB::table('tbl_products')->get();

		// foreach ($products as $product) {
		// 	$labours = Labours::whereHas('product', function ($query) use ($product) {
		// 		$query->where('name', $product->name);
		// 	})->get();

		// 	// Now $labours contains all labours associated with the current product
		// }

		$washbay_data = Washbay::where('service_id', '=', $ser_id)->first();

		//For Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes']])->get()->toArray();

		$html = view('quotation.quotationmodel')->with(compact('available','assigned','current_month','chassis_no','page_action', 'service_id', 'logo', 'custo_info', 'vehi_name', 'regi', 'all_data', 'all_data2', 'all_data3', 'used_cpn_data', 'service_data', 'service_taxes', 'tbl_custom_fields', 'washbay_data', 'maker', 'Vehicle_inf'))->render();

		return response()->json(['success' => true, 'html' => $html]);
	}



	//Quotation delete
	public function destroy($id)
	{
		$service1 = DB::table('tbl_jobcard_details')->where('service_id', '=', $id)->first();
		$tbl_invoices1 = DB::table('tbl_invoices')->where('sales_service_id', '=', $id)->first();

		if (!empty($tbl_invoices1)) {
			$in_id = $tbl_invoices1->id;

			$tbl_invoices = DB::table('tbl_invoices')->where('id', '=', $in_id)->first();
			$invoice_no = $tbl_invoices->invoice_number;
			$incomes_id = DB::table('tbl_incomes')->where('invoice_number', '=', $invoice_no)->first();

			if (!empty($incomes_id)) {
				$incomeid = $incomes_id->id;
			}
		}

		if (!empty($service1)) {
			$jobid = $service1->jocard_no;
			$tbl_gatepasses = DB::table('tbl_gatepasses')->where('jobcard_id', '=', $jobid)->delete();
		}

		$tbl_jobcard_details = DB::table('tbl_jobcard_details')->where('service_id', '=', $id)->update(['soft_delete' => 1]);
		$tbl_service_pros = DB::table('tbl_service_pros')->where('service_id', '=', $id)->update(['soft_delete' => 1]);
		$tbl_services = DB::table('tbl_services')->where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/quotation/list')->with('message', 'Quotation Deleted Successfully');
	}

	public function destoryMultiple(Request $request)
	{
		$ids = $request->input('ids');

		foreach ($ids as $id) {
			$this->destroy($id);
		}

		return response()->json(['message' => 'Successfully deleted selected purchase records']);
	}


	//Quotation edit (Quotation service add first step edit)
	public function quotationEdit($id)
	{
		$service = DB::table('tbl_services')->where('id', '=', $id)->first();
		$vehical = DB::table('tbl_vehicles')->where('soft_delete', '=', 0)->get()->toArray();
		$customer = DB::table('users')->where([['role', 'Customer'], ['soft_delete', 0]])->get()->toArray();
		$cus_id = $service->customer_id;
		$vah_id = $service->vehicle_id;
		$tbl_sales = DB::table('tbl_sales')->where('vehicle_id', $vah_id)->first();

		$regi_no = null;
		if (!empty($tbl_sales)) {
			$regi = DB::table('tbl_sales')->where('customer_id', $cus_id)->first();
		} else {
			$regi = DB::table('tbl_vehicles')->where('id', $vah_id)->first();
		}

		if (!empty($regi)) {
			$regi_no = $regi->registration_no;
		}

		$tax = DB::table('tbl_account_tax_rates')->where([['soft_delete', '=', 0]])->get()->toArray();

		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		/*New for mot data display library*/
		$inspection_points_library_data = DB::table('inspection_points_library')->get();

		$mot_inspections_data = DB::table('mot_vehicle_inspection')->where('service_id', '=', $id)->get()->toArray();
		$mot_inspections_answers = "";

		if (!empty($mot_inspections_data)) {
			foreach ($mot_inspections_data as $key => $value) {
				$mot_inspections_answers = json_decode($value->answer_question_id, true);
			}
		}

		$washbay_data = Washbay::where([['service_id', '=', $id], ['jobcard_no', '=', $service->job_no]])->first();
		$washbayPrice = null;
		if (!empty($washbay_data)) {
			$washbayPrice = $washbay_data->price;
		}

		$manufacture_name = DB::table('tbl_product_types')->where('soft_delete', '=', 0)->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if ((Auth::User()->role_id) === 1) {
			$branchDatas = Branch::where('id', '=', $adminCurrentBranch->branch_id)->get();
			$brand = Product::where([['category', 1], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get();
			$sales = Details::where([['quotation_id', $service->job_no], ['branch_id', $adminCurrentBranch->branch_id]])->first();
			$stock = Details::where([['quotation_id', $sales->quotation_id], ['branch_id', $adminCurrentBranch->branch_id]])->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$sales = Details::where('quotation_id', $service->job_no)->first();
			$brand = Product::where([['category', 1], ['soft_delete', '=', 0]])->get();
			$stock = Details::where('bill_no', '=', $sales->bill_no)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0]])->get()->toArray();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$brand = Product::where([['category', 1], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get();
			$sales = Details::where([['quotation_id', $service->job_no], ['branch_id', $currentUser->branch_id]])->first();
			$stock = Details::where([['quotation_id', $sales->quotation_id], ['branch_id', $currentUser->branch_id]])->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		}

		$repairCategoryList = DB::table('table_repair_category')->where([['soft_delete', 0]])->get()->toArray();

		return view('quotation/edit', compact('sales','brand', 'stock', 'service', 'vehical', 'employee', 'manufacture_name', 'customer', 'regi_no', 'tbl_custom_fields', 'tax', 'inspection_points_library_data', 'mot_inspections_answers', 'washbayPrice', 'branchDatas', 'repairCategoryList'));
	}

	//Quotation update (Quotation service add first step update)
	public function quotationUpdate(Request $request, $id)
	{
		$job = 'J' . substr($request->jobno, 1);
		$Customername = $request->Customername;
		$vehicalname = $request->vehicalname;
		$title = $request->title;
		$service_category = $request->repair_cat;
		$ser_type = $request->service_type;
		$donestatus = $request->donestatus;
		$details = $request->details;
		$taxId = $request->Tax;
		$mot_test_status = $request->motTestStatusCheckbox;
		if (getDateFormat() == 'm-d-Y') {
			$date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->date)));
		} else {
			$date = date('Y-m-d H:i:s', strtotime($request->date));
		}

		if ($ser_type == 'free') {
			$charge = "0";
		}
		if ($ser_type == 'paid') {
			$charge = $request->charge;
		}

		$services = Service::find($id);
		$services->job_no = $job;
		$services->service_date = $date;
		$services->title = $title;
		$services->service_category = $service_category;
		$services->charge = $charge;
		$services->detail = $details;
		$services->service_type = $ser_type;
		$services->branch_id = $request->branch;
		$tblservice = DB::table('tbl_services')->where('id', '=', $id)->first();
		$status = $tblservice->done_status;
		if ($status == 0) {
			$services->done_status = 0;
		} elseif ($status == 1) {
			$services->done_status = 1;
		} elseif ($status == 2) {
			$services->done_status = 2;
		}

		//Custom Field Data
		$custom = $request->custom;
		$custom_fileld_value = array();
		$custom_fileld_value_jason_array = array();
		if (!empty($custom)) {
			foreach ($custom as $key => $value) {
				if (is_array($value)) {
					$add_one_in = implode(",", $value);
					$custom_fileld_value[] = array("id" => "$key", "value" => "$add_one_in");
				} else {
					$custom_fileld_value[] = array("id" => "$key", "value" => "$value");
				}
			}

			$custom_fileld_value_jason_array['custom_fileld_value'] = json_encode($custom_fileld_value);

			foreach ($custom_fileld_value_jason_array as $key1 => $val1) {
				$serviceData = $val1;
			}
			$services->custom_field = $serviceData;
		}

		/*for save tax id inside service table when quotation creation time*/
		if (!empty($request->Tax)) {
			$services->tax_id = implode(', ', $request->Tax);
		} else {
			$services->tax_id = null;
		}

		if ($mot_test_status == "on") {
			$mot_test_status = 1;
		} else {
			$mot_test_status = 0;
		}

		$services->mot_status = $mot_test_status;
		$services->save();

		$service_latest_data = Service::where('job_no', '=', $job)->first();
		$service_id = $service_latest_data->id;
		$job_no = $service_latest_data->job_no;

		$inspection_data = array();

		/*For MOT data and its related values stored*/
		if ($request->motTestStatusCheckbox == "on") {

			$inspection_answers = DB::table('mot_vehicle_inspection')->where('service_id', '=', $service_id)->first();

			if (!empty($inspection_answers)) {
				$inspection_data = $request->inspection;
				$data_for_db = json_encode($inspection_data);

				$fill_mot_vehicle_inspection = array('answer_question_id' => $data_for_db, 'vehicle_id' => $vehicalname, 'service_id' => $service_id, 'jobcard_number' => $job_no);

				$mot_vehicle_inspection_data_store = DB::table('mot_vehicle_inspection')->where('service_id', '=', $service_id)->update($fill_mot_vehicle_inspection);

				//get id from 'mot_vehicle_inspection' to store latest id 
				$get_vehicle_inspection_id = DB::table('mot_vehicle_inspection')->where('service_id', '=', $service_id)->first();

				$get_vehicle_current_id = $get_vehicle_inspection_id->id;

				if (in_array('x', $inspection_data) || in_array('r', $inspection_data)) {
					$mot_test_status = 'fail';
				} else {
					$mot_test_status = 'pass';
				}

				//$generateMotTestNumber = rand();
				$todayDate = date('Y-m-d');

				$fill_data_vehicle_mot_test_reports = array('vehicle_id' => $vehicalname, 'service_id' => $service_id, 'mot_vehicle_inspection_id' => $get_vehicle_current_id, 'test_status' => $mot_test_status, 'date' => $todayDate);

				/*Store data on Vehicle_mot_test_report table*/
				$insert_data_vehicle_mot_test_reports = DB::table('vehicle_mot_test_reports')->where('service_id', '=', $service_id)->update($fill_data_vehicle_mot_test_reports);
			} else {
				//$inspection_data = Input::get('inspection');
				$inspection_data = $request->inspection;
				$data_for_db = json_encode($inspection_data);

				$fill_mot_vehicle_inspection = array('answer_question_id' => $data_for_db, 'vehicle_id' => $vehicalname, 'service_id' => $service_id, 'jobcard_number' => $job_no);

				$mot_vehicle_inspection_data_store = DB::table('mot_vehicle_inspection')->insert($fill_mot_vehicle_inspection);

				//get id from 'mot_vehicle_inspection' to store latest id 
				$get_vehicle_inspection_id = DB::table('mot_vehicle_inspection')->latest('id')->first();

				$get_vehicle_current_id = $get_vehicle_inspection_id->id;

				if (in_array('x', $inspection_data) || in_array('r', $inspection_data)) {
					$mot_test_status = 'fail';
				} else {
					$mot_test_status = 'pass';
				}

				$generateMotTestNumber = rand();
				$todayDate = date('Y-m-d');

				$fill_data_vehicle_mot_test_reports = array('vehicle_id' => $vehicalname, 'service_id' => $service_id, 'mot_vehicle_inspection_id' => $get_vehicle_current_id, 'test_status' => $mot_test_status, 'mot_test_number' => $generateMotTestNumber, 'date' => $todayDate);

				/*Store data on Vehicle_mot_test_report table*/
				$insert_data_vehicle_mot_test_reports = DB::table('vehicle_mot_test_reports')->insert($fill_data_vehicle_mot_test_reports);
			}
		} else {
			$get_vehicle_inspection_id = DB::table('mot_vehicle_inspection')->where('service_id', '=', $service_id)->first();
			$vehicle_mot_report_data = DB::table('vehicle_mot_test_reports')->where('service_id', '=', $service_id)->first();

			if (!empty($get_vehicle_inspection_id)) {
				$data = DB::table('mot_vehicle_inspection')->where('service_id', '=', $service_id)->delete();
			}

			if (!empty($vehicle_mot_report_data)) {
				$data = DB::table('vehicle_mot_test_reports')->where('service_id', '=', $service_id)->delete();
			}
		}

		//Checking for Washbay status, if washbay status on then data store inside washbay table
		$washbay_status = $request->washbay;
		$washbay_charge = $request->washBayCharge;
		$washbay_data = Washbay::where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->first();
		$invoicesData = DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->first();
		$serviceData = DB::table('tbl_services')->where('id', '=', $id)->first();

		if (!empty($washbay_data)) {
			if ($washbay_status == 'on') {
				if (!empty($invoicesData)) {
					if ($washbay_charge != $washbay_data->price) {
						$totalAmount = $invoicesData->total_amount;
						$grandTotal = $invoicesData->grand_total;

						$totalAmountNew = ($totalAmount - $washbay_data->price) + $washbay_charge;
						$grandTotalNew = 0;
						$discountNew = 0;
						$taxNew = 0;
						$grandTotalOld = 0;

						$discountIs = $invoicesData->discount;
						$taxIs = $invoicesData->tax_name;

						if (!empty($discountIs)) {
							$discountNew = ($totalAmountNew * ($discountIs / 100));
						}
						$all_taxes = 0;
						if (!empty($taxIs)) {

							$taxes = explode(', ', $taxIs);
							foreach ($taxes as $tax) {
								$singleTax = preg_replace("/[^0-9,.]/", "", $tax);
								$all_taxes += $singleTax;
							}
						}

						$afterDiscountCutTotalAmount = $totalAmountNew - $discountNew;
						$taxNew = ($afterDiscountCutTotalAmount * ($all_taxes / 100));
						$grandTotalNew = $afterDiscountCutTotalAmount + $taxNew;

						DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->update(['total_amount' => $totalAmountNew, 'grand_total' => $grandTotalNew]);

						Washbay::where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->update(['price' => $washbay_charge]);
					}
				} else {
					Washbay::where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->update(['price' => $washbay_charge]);
				}
			} else {
				if (!empty($invoicesData)) {
					$totalAmount = $invoicesData->total_amount;
					$grandTotal = $invoicesData->grand_total;

					$totalAmountNew = $totalAmount - $washbay_data->price;
					$grandTotalNew = 0;
					$discountNew = 0;
					$taxNew = 0;
					$grandTotalOld = 0;

					$discountIs = $invoicesData->discount;
					$taxIs = $invoicesData->tax_name;

					if (!empty($discountIs)) {
						$discountNew = ($totalAmountNew * ($discountIs / 100));
					}


					$all_taxes = 0;
					if (!empty($taxIs)) {

						$taxes = explode(', ', $taxIs);
						foreach ($taxes as $tax) {
							$singleTax = preg_replace("/[^0-9,.]/", "", $tax);
							$all_taxes += $singleTax;
						}
					}

					$afterDiscountCutTotalAmount = $totalAmountNew - $discountNew;
					$taxNew = ($afterDiscountCutTotalAmount * ($all_taxes / 100));
					$grandTotalNew = $afterDiscountCutTotalAmount + $taxNew;

					DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->update(['total_amount' => $totalAmountNew, 'grand_total' => $grandTotalNew]);

					DB::table('washbays')->where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->delete();
				}

				DB::table('washbays')->where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->delete();
			}
		} else {
			if ($washbay_status == 'on') {
				$washbays = new Washbay;
				$washbays->service_id = $id;
				$washbays->jobcard_no = $job;
				$washbays->vehicle_id = $serviceData->vehicle_id;
				$washbays->customer_id = $serviceData->customer_id;
				$washbays->price = $washbay_charge;
				$washbays->save();

				if (!empty($invoicesData)) {
					$totalAmount = $invoicesData->total_amount;
					$grandTotal = $invoicesData->grand_total;

					$totalAmountNew = $totalAmount + $washbay_charge;
					$grandTotalNew = 0;
					$discountNew = 0;
					$taxNew = 0;
					$grandTotalOld = 0;

					$discountIs = $invoicesData->discount;
					$taxIs = $invoicesData->tax_name;

					if (!empty($discountIs)) {
						$discountNew = ($totalAmountNew * ($discountIs / 100));
					}
					$all_taxes = 0;
					if (!empty($taxIs)) {

						$taxes = explode(', ', $taxIs);
						foreach ($taxes as $tax) {
							$singleTax = preg_replace("/[^0-9,.]/", "", $tax);
							$all_taxes += $singleTax;
						}
					}

					$afterDiscountCutTotalAmount = $totalAmountNew - $discountNew;
					$taxNew = ($afterDiscountCutTotalAmount * ($all_taxes / 100));
					$grandTotalNew = $afterDiscountCutTotalAmount + $taxNew;

					DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->update(['total_amount' => $totalAmountNew, 'grand_total' => $grandTotalNew]);
				}
			}
		}

		return redirect('/quotation/list')->with('message', 'Quotation Updated Successfully');;
	}

	public function processQuotation(Request $request)
{
	// $deletedRows = $request->input('deleted_rows', []);

    // foreach ($deletedRows as $rowId) {
    //     $deletedRowId = extractRowIdFromRowId($rowId); // Extract the row ID
    //     Details::find($deletedRowId)->delete(); // Delete the row from the database
    // }
    // // Get the job_no from the Service table
    // $jobNo = DB::table('tbl_services')->where('id', $request->service_id)->value('job_no');

    // // Find all details with the matching quotation_id (job_no)
    // $details = Details::where('quotation_id', $jobNo)->get();

    // // Iterate through each detail and update specific fields
    // foreach ($details as $detail) {
    //     $key = array_search($detail->id, $request->input('product.tr_id'));

    //     // Update fields if the detail id is found in the request
    //     if ($key !== false) {
    //         $detail->quantity = $request->input('product.qty')[$key];
    //         $detail->price = $request->input('product.price')[$key];
    //         $detail->total_price = $request->input('product.total_price')[$key];
    //         $detail->product_id = $request->input('product.product_id')[$key];
    //         $detail->product_type_id = $request->input('product.Manufacturer_id')[$key];

    //         // Save the changes
    //         $detail->save();
    //     }
    // }

    // // Optionally, you can return a response or redirect

	// Get the job number from the service ID
    $jobNo = DB::table('tbl_services')->where('id', $request->service_id)->value('job_no');
    $Customername = DB::table('tbl_services')->where('id', $request->service_id)->value('customer_id');
    $branch = DB::table('tbl_services')->where('id', $request->service_id)->value('branch_id');

    // Get all existing details associated with the given job number (quotation_id)
    $existingDetails = Details::where('quotation_id', $jobNo)->get();

    // Iterate over the submitted data for each detail
    foreach ($request->product['tr_id'] as $key => $detailId) {
        // Check if this detail is an existing one or a new one
        if ($detailId != '') {
            // Update existing detail
            $detail = $existingDetails->where('id', $detailId)->first();
        } else {
            // Create a new detail
            $detail = new Details();
            $detail->quotation_id = $jobNo;
			$detail->sellman = Auth::user()->id;
            $detail->customer_id = $Customername;
            $detail->branch_id = $branch;
            // $detail->date = ;
            $characters = '0123456789';
            $code = 'SP' . substr(str_shuffle($characters), 0, 6);
            $detail->bill_no = $code;
        }

        // Populate detail fields from the submitted data
        $detail->quantity = $request->product['qty'][$key];
        $detail->price = $request->product['price'][$key];
        $detail->total_price = $request->product['total_price'][$key];
        $detail->product_id = $request->product['product_id'][$key];
        $detail->product_type_id = $request->product['Manufacturer_id'][$key];
        $detail->save();
    }

    // Optionally, you can also handle the deletion of existing details
    // For example, if an existing detail is not present in the submitted data, you may want to delete it

    // Redirect or return a response as needed

}



// sale part delete
public function sale_part_destroy(Request $request)
{
    $id = $request->id; // Corrected to 'id', not 'procuctid'

    // Update the 'soft_delete' flag instead of deleting
    $sales = DB::table('tbl_details')->where('id', $id)->update(['soft_delete' => 1]);

    // Optionally, you can return a JSON response indicating success
    return response()->json(['message' => 'Sales part deleted successfully'], 200);
}

	public function save_observation(Request $request)
	{
		dd('called');
	}
}
