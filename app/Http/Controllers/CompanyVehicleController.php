<?php

namespace App\Http\Controllers;

use Log;
use App\Sale;
use App\User;
use App\Branch;
use App\Product;
use App\SalePart;
use Carbon\Carbon;
use App\CustomField;
use App\Vehicletype;
use App\Vehiclebrand;
use App\BranchSetting;
use App\CompanyVehicle;
use App\tbl_vehicle_images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CompanyVehicleController extends Controller
{
    public function index()
    {
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::latest()->get();

		if (!isAdmin(Auth::User()->role_id)) {

			$product = CompanyVehicle::where('Added_by', Auth::user()->id)->latest()->orderBy('id', 'DESC')->get();
			
		} else {
			$product = CompanyVehicle::latest()->orderBy('id', 'DESC')->get();;
		}

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'company_vehicle'], ['soft_delete', 0], ['always_visable', '=', 'yes']])->get();

		return view('company_vehicle.list', compact('product', 'tbl_custom_fields'));
	}

	public function index1()
	{
		
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::user()->role_id) == 'Customer') {

				$sales = Sale::groupby('bill_no')->where('customer_id', '=', Auth::User()->id)->orderBy('id', 'DESC')->get();

				// $sales = Sale::where('vehicle_id', '!=', '<>')->groupby('bill_no')->where('customer_id', '=', Auth::User()->id)->orderBy('id', 'DESC')->get();

			} elseif (getUsersRole(Auth::user()->role_id) == 'Employee') {
				$sales = Sale::where([['branch_id', $currentUser->branch_id]])->groupby('bill_no')->where('product_id', '!=', '<>')->orderBy('id', 'DESC')->get();
			} elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {


				$sales = Sale::where('branch_id', '=', $currentUser->branch_id)->groupby('bill_no')->orderBy('id', 'DESC')->get();
			} else {
				$sales = Sale::where('branch_id', '=', $currentUser->branch_id)->groupby('bill_no')->orderBy('id', 'DESC')->get();
			}
		} else {
			$sales = Sale::groupby('bill_no')->orderBy('id', 'DESC')->get();

				// $sales = Sale::where('vehicle_id', '!=', '<>')->where('branch_id', '=', $currentUser->branch_id)->groupby('bill_no')->orderBy('id', 'DESC')->get();
			} 

		return view('sales_part.vehicle_list', compact('sales'));
	}

	
	

    public function addVehicle()
    {
		$characters = '0123456789';
		$code =  'VEHICLE' . '' . substr(str_shuffle($characters), 0, 6);

		// $vehicle_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		$vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		// dd($vehical_type);
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
		$fuel_type = DB::table('tbl_fuel_types')->where('soft_delete', '=', 0)->get()->toArray();
		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get()->toArray();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'company_vehicle'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (Auth::User()->role_id === 1) {
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
		} elseif (Auth::User()->role_id === 6) {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}
        $vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		
		// $vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();

		// Return the view for adding a new company vehicle
        return view('company_vehicle.add', compact('vehical_type','fuel_type','model_name', 'vehical_brand', 'code','color', 'tbl_custom_fields', 'branchDatas'));
    }


	//Add vehical type
	public function vehicaltypeadd(Request $request)
	{
		$vehical_type = $request->vehical_type;
		$count = DB::table('tbl_vehicle_types')->where('vehicle_type', '=', $vehical_type)->count();

		if ($count == 0) {
			$vehicaltype = new Vehicletype;
			$vehicaltype->vehicle_type = $vehical_type;
			$vehicaltype->save();
			echo $vehicaltype->id;
		} else {
			$vehicleTypeRecord = DB::table('tbl_vehicle_types')->where([['soft_delete', '!=', 1], ['vehicle_type', '=', $vehical_type]])->first();
			if (!empty($vehicleTypeRecord)) {
				return '01';
			} else {
				$vehicaltype = new Vehicletype;
				$vehicaltype->vehicle_type = $vehical_type;
				$vehicaltype->save();
				echo $vehicaltype->id;
			}
		}
	}

	// Add vehical brand
	public function vehicalbrandadd(Request $request)
	{
		$vehical_id = $request->vehical_id;
		$vehical_brand1 = $request->vehical_brand;

		$count = DB::table('tbl_vehicle_brands')->where([['vehicle_id', '=', $vehical_id], ['vehicle_brand', '=', $vehical_brand1]])->count();

		if ($count == 0) {
			$vehical_brand = new Vehiclebrand;
			$vehical_brand->vehicle_id = $vehical_id;
			$vehical_brand->vehicle_brand = $vehical_brand1;
			$vehical_brand->save();
			echo $vehical_brand->id;
		} else {
			$vehicleBrandRecord = DB::table('tbl_vehicle_brands')->where([['soft_delete', '!=', 1], ['vehicle_brand', '=', $vehical_brand1], ['vehicle_id', '=', $vehical_id]])->first();
			if (!empty($vehicleBrandRecord)) {
				return '01';
			} else {
				$vehical_brand = new Vehiclebrand;
				$vehical_brand->vehicle_id = $vehical_id;
				$vehical_brand->vehicle_brand = $vehical_brand1;
				$vehical_brand->save();
				echo $vehical_brand->id;
			}
		}
	}

    public function store(Request $request)
    {
        $p_date = $request->p_date;
		$p_no = $request->p_no;
		$name = $request->name;
		$p_type = $request->p_type;
		$price = $request->price;
		$quantity = $request->quantity;
		$warranty = $request->warranty;

		$dealer_price = $request->dealer_price;

		if (getDateFormat() == 'm-d-Y') {
			$dates = date('Y-m-d', strtotime(str_replace('-', '/', $p_date)));
		} else {
			$dates = date('Y-m-d', strtotime($p_date));
		}

		$vehicle = new CompanyVehicle;
		$vehicle->code = $p_no;
		$vehicle->DateAdded = $dates;

		if (!empty($request->image)) {
			$file = $request->image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/companyvehicle/', $file->getClientOriginalName());
			$vehicle->image = $filename;

		} else {
			$vehicle->image = 'avtar.png';
		}

		$vehicle->name = $name;
		$vehicle->vehicle_brand = $request->vehicabrand;
		$vehicle->manufacturer = $p_type;
		$vehicle->price = $price;
		$vehicle->warranty = $warranty;
		$vehicle->quantity = $quantity;
		$vehicle->branch_id = $request->branch;

		$vehicle->quantity = $request->quantity;



		$vehicle->year = $request->modelyear;
		$vehicle->dealer_price = $dealer_price;

		$vehicle->Added_by = Auth::User()->id;

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
				$productData = $val1;
			}
			$vehicle->custom_field = $productData;
		}

		$vehicle->save();

		return redirect('/company_vehicle/list')->with('message', 'Vehicle Submitted Successfully');
	
    }

    public function edit($id)
    {

		$characters = '0123456789';
		$code =  'VEHICLE' . '' . substr(str_shuffle($characters), 0, 6);

		$vehicle_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'company_vehicle'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (Auth::User()->role_id === 1) {
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
		} elseif (Auth::User()->role_id === 6) {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}
        $vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();

		$company_vehicle = CompanyVehicle::where('id', '=', $id)->latest()->first();

		// Return the view for adding a new company vehicle
        return view('company_vehicle.edit', compact('vehical_type', 'vehical_brand', 'code', 'tbl_custom_fields', 'branchDatas','company_vehicle'));
    }

	public function sell($id)
    {
		$characters = '0123456789';
		$code =  'VH' . '' . substr(str_shuffle($characters), 0, 6);

		$customer = DB::table('users')->where([['role', '=', 'Customer'], ['soft_delete', '=', 0]])->get()->toArray();
		// $taxes = DB::table('tbl_account_tax_rates')->where('soft_delete', '=', 0)->get()->toArray();
		// $payment = DB::table('tbl_payments')->where('soft_delete', '=', 0)->get()->toArray();

		
		$tbl_custom_fields = CustomField::where([['form_name', '=', 'company_vehicle'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (Auth::User()->role_id === 1) {
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$employee = DB::table('users')->where('role', '=', 'Employee')->where('soft_delete', '=', 0)->get()->toArray();
			$branchDatas = Branch::get();
		} elseif (Auth::User()->role_id === 1) {
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		} else {
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}
        		
		$company_vehicle = CompanyVehicle::where('id', '=', $id)->latest()->first();

        // Return the view for editing a company vehicle
        return view('company_vehicle.sell', compact('employee','code','company_vehicle', 'tbl_custom_fields','customer', 'branchDatas'));
    }

    public function sellupdate(Request $request, $id)
    {
		$company_vehicle = CompanyVehicle::where('id', '=', $id)->latest()->first();
        $this->validate($request, [
			'quantity' => 'numeric',
			// 'price' => 'numeric',
		]);

		$qty = $request->quantity;
		if (getDateFormat() == 'm-d-Y') {
			$s_date = date('Y-m-d', strtotime(str_replace('-', '/', $request->date)));
		} else {
			$s_date = date('Y-m-d', strtotime($request->date));
		}

		$sales = new Sale;
		$sales->customer_id = $request->cus_name;
		$sales->bill_no = $request->bill_no;
		$sales->date = $s_date;
		$sales->quantity = $qty;
		$sales->price = $company_vehicle->Price;
		$sales->total_price = $qty * $company_vehicle->Price;
		$sales->salesmanname = $request->salesmanname;
		$sales->branch_id = $request->branch;
		//custom field save
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
				$salesPartData = $val1;
			}
			$sales->custom_field = $salesPartData;
		}

		// CompanyVehicle::updated()
		$vehicle = CompanyVehicle::find($request->id);
        if ($vehicle) {
            $quaantity = $vehicle->quantity - $request->quantity;
			$vehicle->quantity = $quaantity;
            $vehicle->save();
        }
		$sales->save();
		return redirect('/company_vehicle/list')->with('message', 'Part Sell Submitted Successfully');
		
    }
	

	public function update(Request $request, $id)
    {
        $p_date = $request->p_date;
		$p_no = $request->p_no;
		$name = $request->name;
		$p_type = $request->p_type;
		$price = $request->price;
		$warranty = $request->warranty;

		$dealer_price = $request->dealer_price;

		if (getDateFormat() == 'm-d-Y') {
			$dates = date('Y-m-d', strtotime(str_replace('-', '/', $p_date)));
		} else {
			$dates = date('Y-m-d', strtotime($p_date));
		}

		$vehicle = CompanyVehicle::find($id);;
		$vehicle->code = $p_no;
		$vehicle->DateAdded = $dates;

		if (!empty($request->image)) {
			$file = $request->image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/companyvehicle/', $file->getClientOriginalName());
			$vehicle->image = $filename;
		} else {
			$vehicle->image = 'avtar.png';
		}

		$vehicle->name = $name;
		$vehicle->vehicle_brand = $request->vehicabrand;
		$vehicle->manufacturer = $p_type;
		$vehicle->price = $price;
		$vehicle->warranty = $warranty;
		$vehicle->branch_id = $request->branch;
		$vehicle->quantity = $request->quantity;

		$vehicle->year = $request->modelyear;
		$vehicle->dealer_price = $dealer_price;

		$vehicle->Added_by = Auth::User()->id;

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
				$productData = $val1;
			}
			$vehicle->custom_field = $productData;
		}

		$vehicle->save();

		return redirect('/company_vehicle/list')->with('message', 'Vehicle Submitted Successfully');
	

        // Return the view for editing a company vehicle
        return view('company_vehicle.edit', compact('id'));
    }

    // public function update(Request $request, $id)
    // {
    //     // Handle updating the company vehicle
    //     // Validation and updating logic here
    // }

    public function destroy($id)
    {

        
		//$customer = DB::table('users')->where('id','=',$id)->delete();
		$delete = CompanyVehicle::where('id', '=', $id)->delete();

		return redirect('/company_vehicle/list')->with('message', 'Vehicle Deleted Successfully');
		
    }

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			CompanyVehicle::whereIn('id', $ids)->delete();
		}

		return redirect('/company_vehicle/list')->with('message', 'Vehicle Deleted Successfully');
	}

        // Handle deleting the company vehicle
        // Deleting logic here
    


	//sales add form
	public function addsales()
	{
		$characters = '0123456789';

		$code =  'VH' . '' . substr(str_shuffle($characters), 0, 6);

		$code =  'SP' . '' . substr(str_shuffle($characters), 0, 6);


		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$customer = DB::table('users')->where([['role', '=', 'Customer'], ['soft_delete', '=', 0]])->get()->toArray();
		$taxes = DB::table('tbl_account_tax_rates')->where('soft_delete', '=', 0)->get()->toArray();
		$payment = DB::table('tbl_payments')->where('soft_delete', '=', 0)->get()->toArray();


		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (Auth::User()->role_id === 1) {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->where([['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->where([['soft_delete', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();

			// $brand = DB::table('')->where([['Status', '=', 'available']])->get()->toArray();
			$manufacture_name = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where('role', '=', 'Employee')->where('soft_delete', '=', 0)->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->where([['soft_delete', '=', 0]])->get()->toArray();

			// $brand = DB::table('')->where([['Status', '=', 'available']])->get()->toArray();
			$manufacture_name = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		} elseif (Auth::User()->role_id === 6) {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->where([['branch_id', $currentUser->branch_id]])->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->where([['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();

			// $brand = DB::table('')->where([['Status', '=', 'available']])->get()->toArray();
			$manufacture_name = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->where([['branch_id', $currentUser->branch_id]])->get()->toArray();

			$brand = DB::table('tbl_company_vehicles')->where([['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();

			// $brand = DB::table('')->where([['Status', '=', 'available']])->get()->toArray();
			$manufacture_name = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		}


		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'company_vehicle'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('sales_part.vehicleadd', compact('customer', 'employee', 'code', 'color', 'taxes', 'payment', 'brand', 'manufacture_name', 'tbl_custom_fields', 'branchDatas'));
	}


	
	
	public function getVehicleDetails(Request $request)
    {
        $vehicleId = $request->input('vehicle_id');

        // Fetch the vehicle details from the database based on the vehicle ID
        $vehicle = CompanyVehicle::find($vehicleId);

        // Return the vehicle details as JSON response
        return response()->json($vehicle);
    }	
	
	

	public function getCompanyVehicles(Request $request) {
		$vehicle_type_id = $request->id;
		$vehicles = DB::table('tbl_company_vehicles')
					  ->where('manufacturer', $vehicle_type_id)
					  ->pluck('name', 'id');
		return response()->json($vehicles);
	}
	
	public function getAvailableProduct(Request $request) {
		$product_id = $request->product_id;
		$vehicle = DB::table('tbl_company_vehicles')
					 ->where('id', $product_id)
					 ->first(['price', 'quantity']); // Assuming 'price' and 'available_qty' are the column names
	
		return response()->json($vehicle);
	}
	
	public function getManufacturers()
	{
		$manufacturers = DB::table('tbl_vehicle_types')
						   ->where('soft_delete', 0)
						   ->get();
	
		return response()->json($manufacturers);
	}
}