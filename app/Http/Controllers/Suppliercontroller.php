<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\CustomField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SupplierAddEditFormRequest;

class Suppliercontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//supplier list 
	public function supplierlist()
	{
		if (!isAdmin(Auth::User()->role_id)) {
			if (Gate::allows('supplier_owndata')) {
				$user = User::where([['role', '=', 'Supplier'], ['soft_delete', 0], ['create_by', '=', Auth::User()->id]])->orderBy('id', 'DESC')->get();
			} else {
				$user = User::where([['role', '=', 'Supplier'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
			}
		} elseif (Auth::user()->role_id === 6) {
			if (Gate::allows('supplier_owndata')) {
				$user = User::where([['role', '=', 'Supplier'], ['soft_delete', 0], ['create_by', '=', Auth::User()->id]])->orderBy('id', 'DESC')->get();
			} else {
				$user = User::where([['role', '=', 'Supplier'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
			}
		} elseif (Auth::user()->role_id === 1) {
			
			$user = User::where([['role', '=', 'Supplier'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
		}
		$server = "http://" . $_SERVER['SERVER_NAME'] . "/garrage";

		return view('supplier.list', compact('user', 'server'));
	}

	//supplier add in user_tbl
	public function adddata(Request $request)
	{
		$supllier = new User;
		$supllier->name = $request->name;
		$supllier->save();
	}

	//supplier add form
	public function supplieradd()
	{
		$country = DB::table('tbl_countries')->get()->toArray();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'suppliers'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get();
		// dd($tbl_custom_fields);
		return view('supplier.add', compact('country', 'tbl_custom_fields'));
	}

	//supplier store
	public function storesupplier(SupplierAddEditFormRequest $request)
	{
		
		$firstname = $request->firstname;
		$gender = $request->gender;
		$email = $request->email;
		$mobile = $request->mobile;
		$address = $request->address;
		$country_id = $request->country_id;
		$state = $request->state;
		$city = $request->city;

		$user = new User;
		$user->name = $firstname;
		$user->gender = $gender;
		$user->email = $email;
		$user->mobile_no = $mobile;
		$user->address = $address;
		$user->create_by = Auth::User()->id;

		

		$user->country_id = $country_id;
		$user->state_id = $state;
		$user->city_id = $city;
		$user->role = 'Supplier';
		$user->language = "en";
		$user->timezone = "UTC";

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
				$supplierdata = $val1;
			}
			$user->custom_field = $supplierdata;
		}

		$user->save();

		return redirect('/supplier/list')->with('message', 'Supplier Submitted Successfully');
	}

	//supplier show 
	public function showsupplier($id)
	{
		$viewid = $id;
		$user = User::where([['role', '=', 'Supplier'], ['id', '=', $id], ['soft_delete', 0]])->first();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'suppliers'], ['soft_delete', 0]])->get();
		return view('supplier.show', compact('user', 'viewid', 'tbl_custom_fields'));
	}

	//supplier delete
	public function destroy($id)
	{
		$user = User::where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/supplier/list')->with('message', 'Supplier Deleted Successfully');
	}
	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			User::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}

		return redirect('/supplier/list')->with('message', 'Supplier Deleted Successfully');
	}


	//supplier edit
	public function edit($id)
	{
		$editid = $id;
		$user = User::where('id', '=', $id)->first();

		$country = DB::table('tbl_countries')->get()->toArray();
		$state = [];
		$city = [];

		if ($user != null || $user != '') {
			if ($user->country_id != null) {
				$state = DB::table('tbl_states')->where('country_id', '=', $user->country_id)->get()->toArray();
			}

			if ($user->state_id != null) {
				$city = DB::table('tbl_cities')->where('state_id', '=', $user->state_id)->get()->toArray();
			}
		}

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'suppliers'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get();


		return view('supplier.edit', compact('country', 'state', 'city', 'user', 'editid', 'tbl_custom_fields'));
	}

	//supplier update
	public function update(SupplierAddEditFormRequest $request, $id)
	{
		$usimgdtaa = DB::table('users')->where('id', '=', $id)->first();
		$email = $usimgdtaa->email;

		if ($email != $request->email) {
			$this->validate($request, [
				'email' => 'email|unique:users'
			]);
		}

		$firstname = $request->firstname;
		$gender = $request->gender;
		$email = $request->email;
		$password = $request->password;
		$mobile = $request->mobile;
		$address = $request->address;
		$country_id = $request->country_id;
		$state = $request->state;
		$city = $request->city;

		$user = User::find($id);
		$user->name = $firstname;
		$user->gender = $gender;
		$user->email = $email;
		$user->mobile_no = $mobile;
		$user->address = $address;

		

		$user->country_id = $country_id;
		$user->state_id = $state;
		$user->city_id = $city;
		$user->role = 'Supplier';
		$user->language = "en";
		$user->timezone = "UTC";

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
				$supplierdata = $val1;
			}
			$user->custom_field = $supplierdata;
		}
		$user->save();

		return redirect('/supplier/list')->with('message', 'Supplier Updated Successfully');
	}
}
