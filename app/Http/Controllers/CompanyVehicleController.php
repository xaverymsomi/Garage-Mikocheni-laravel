<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use App\BranchSetting;
use App\CompanyVehicle;
use Carbon\Carbon;
use App\tbl_vehicle_images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CompanyVehicleController extends Controller
{
    public function index()
    {
        $currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::User()->role_id) == 'Customer') {
				$vehical = CompanyVehicle::where([['soft_delete', '=', 0], ['Added_by', '=', Auth::User()->name]])->orderBy('id', 'DESC')->get();
			} elseif (getUsersRole(Auth::User()->role_id) == 'Employee') {
				$vehical = CompanyVehicle::where([['soft_delete', 0], ['branch', $currentUser->branch_id]])->orderBy('id', 'DESC')->get();
			} elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {

				$vehical = CompanyVehicle::where([['soft_delete', 0], ['branch', $currentUser->branch_id]])->orderBy('id', 'DESC')->get();
			}
		} else {
			$vehical = CompanyVehicle::where([['Status','=', 'available']])->orderBy('id', 'DESC')->get();
		}
        // Return the view for listing company vehicles
        return view('company_vehicle.list', compact('vehical'));
    }
	public function index1()
    {
        $currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::User()->role_id) == 'Customer') {
				$vehical = CompanyVehicle::where([['soft_delete', '=', 0], ['Added_by', '=', Auth::User()->name]])->orderBy('id', 'DESC')->get();
			} elseif (getUsersRole(Auth::User()->role_id) == 'Employee') {
				$vehical = CompanyVehicle::where([['soft_delete', 0], ['branch', $currentUser->branch_id]])->orderBy('id', 'DESC')->get();
			} elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {

				$vehical = CompanyVehicle::where([['soft_delete', 0], ['branch', $currentUser->branch_id]])->orderBy('id', 'DESC')->get();
			}
		} else {
			$vehical = CompanyVehicle::where([['Status','=', 'available']])->orderBy('id', 'DESC')->get();
		}
        // Return the view for listing company vehicles
        return view('sales_part.vehicle_list', compact('vehical'));
    }

    public function addVehicle()
    {
        $vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		// dd($vehical_type);
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
		
		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get()->toArray();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'vehicle'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}

		// $customer = DB::table('users')->where([['role', 'Customer']])->latest()->value('id');

        // Return the view for adding a new company vehicle
        return view('company_vehicle.add', compact('vehical_type', 'vehical_brand', 'model_name', 'tbl_custom_fields', 'branchDatas'));
    }

    public function store(Request $request)
    {
        // Handle storing the new company vehicle
        // Validation and saving logic here
        $user = $request->added_by;
        // $user_id = Auth::user()->id;
		$manufacture = $request->vehical_id;
		$vehicabrand = $request->vehicabrand;
		$modelyear = $request->modelyear;
		$branch = $request->branch;
		$modelname = $request->modelname;
		$price = $request->price;
		$conditions = $request->conditions;
		$transmission = $request->transmission;
		$Warranty = $request->Warranty;
		$quantity = $request->quantity;
        $Notes = $request->description;

		

		$company_vehicle = new CompanyVehicle;
		$company_vehicle->Added_by = $user;
		$company_vehicle->manufacturer = $manufacture;
		$company_vehicle->vehicle_brand = $vehicabrand;
		$company_vehicle->Model = $modelname;
		$company_vehicle->Year = $modelyear;
		$company_vehicle->branch = $branch;
		$company_vehicle->Price = $price;
		$company_vehicle->quantity  = $quantity;
        $company_vehicle->Status  = 'available';
        $company_vehicle->DateAdded  = Carbon::now();
		$company_vehicle->Conditions = $conditions;
		$company_vehicle->Transmission = $transmission;
		$company_vehicle->Warranty = $Warranty;
		$company_vehicle->Notes = $Notes;
		$company_vehicle->Total_price = $price * $quantity;

		//custom field save	
		//$custom=Input::get('custom');
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
				$vehicleData = $val1;
			}
			$company_vehicle->custom_field = $vehicleData;
		}
		$company_vehicle->save();
        $company_vehicle = DB::table('tbl_company_vehicles')->orderBy('id', 'desc')->first();
		$id = $company_vehicle->id;
		
		

		$image = $request->image;
		if (!empty($image)) {
			$files = $image;

			foreach ($files as $file) {
				$filename = $file->getClientOriginalName();
				$file->move(public_path() . '/companyVehicle/', $file->getClientOriginalName());
				$images = new tbl_vehicle_images;
				$images->vehicle_id = $id;
				$images->image = $filename;
				$images->save();
			}
		}

		
		return redirect('/company_vehicle/list')->with('message', 'Vehicle Submitted Successfully');
	
    }

    public function edit($id)
    {
        // Return the view for editing a company vehicle
        return view('company_vehicle.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Handle updating the company vehicle
        // Validation and updating logic here
    }

    public function destroy($id)
    {
        // Handle deleting the company vehicle
        // Deleting logic here
    }

    public function view()
    {
        // Return the modal view for company vehicles
        return view('company_vehicle.modal');
    }

    public function getModelName()
    {
        // Logic to get model names
    }

    public function getProductName()
    {
        // Logic to get product names
    }

    public function destroyProduct()
    {
        // Logic to destroy a product
    }

    public function getAvailableVehicle()
    {
        // Logic to get available vehicle quantity
    }

	//sales add form
	public function addsales()
	{
		$characters = '0123456789';
		$code =  'SP' . '' . substr(str_shuffle($characters), 0, 6);

		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$customer = DB::table('users')->where([['role', '=', 'Customer'], ['soft_delete', '=', 0]])->get()->toArray();
		$taxes = DB::table('tbl_account_tax_rates')->where('soft_delete', '=', 0)->get()->toArray();
		$payment = DB::table('tbl_payments')->where('soft_delete', '=', 0)->get()->toArray();


		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (isAdmin(Auth::User()->role_id)) {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
			$brand = DB::table('tbl_company_vehicles')->where([['Status', '=', 'available']])->get()->toArray();
			$manufacture_name = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where('role', '=', 'Employee')->where('soft_delete', '=', 0)->get()->toArray();
			$brand = DB::table('tbl_company_vehicles')->where([['Status', '=', 'available']])->get()->toArray();
			$manufacture_name = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'Employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
			$brand = DB::table('tbl_company_vehicles')->where([['Status', '=', 'available']])->get()->toArray();
			$manufacture_name = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		}


		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'salepart'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('sales_part.vehicleadd', compact('customer', 'employee', 'code', 'color', 'taxes', 'payment', 'brand', 'manufacture_name', 'tbl_custom_fields', 'branchDatas'));
	}
}
