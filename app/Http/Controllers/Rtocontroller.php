<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Branch;
use App\RtoTax;
use App\Vehicle;
use App\CustomField;
use App\BranchSetting;
use Illuminate\Http\Request;

class Rtocontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//rto list
	public function index()
	{
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (isAdmin(Auth::User()->role_id)) {
			$rto = RtoTax::where([['soft_delete', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'DESC')->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$rto = DB::table('tbl_rto_taxes')
				->join('tbl_sales', 'tbl_rto_taxes.vehicle_id', '=', 'tbl_sales.vehicle_id')
				->where('tbl_sales.customer_id', '=', Auth::User()->id)
				->orderBy('tbl_rto_taxes.id', 'DESC')->get()->toArray();
		} else {
			$rto = RtoTax::where([['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->orderBy('id', 'DESC')->get();
		}

		//Custom Field Data
		$tbl_custom_fields = CustomField::where([['form_name', '=', 'rto'], ['always_visable', '=', 'yes'],['soft_delete', '=', '0']])->get();

		return view('rto.list', compact('rto', 'tbl_custom_fields'));
	}

	//rto add form
	public function addrto()
	{
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
			$vehicle = DB::table("tbl_vehicles")->select('*')
				->whereNOTIn('tbl_vehicles.id', function ($query) {
					$query->select('tbl_rto_taxes.vehicle_id')->from('tbl_rto_taxes');
				})->where([['soft_delete', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$vehicle = DB::table("tbl_vehicles")->select('*')
				->whereNOTIn('tbl_vehicles.id', function ($query) {
					$query->select('tbl_rto_taxes.vehicle_id')->from('tbl_rto_taxes');
				})->where('soft_delete', '=', 0)->get()->toArray();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$vehicle = DB::table("tbl_vehicles")->select('*')
				->whereNOTIn('tbl_vehicles.id', function ($query) {
					$query->select('tbl_rto_taxes.vehicle_id')->from('tbl_rto_taxes');
				})->where([['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		}

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'rto'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('rto.add', compact('vehicle', 'tbl_custom_fields', 'branchDatas'));
	}

	//rto store
	public function store(Request $request)
	{
		$rto = new RtoTax;
		$rto->vehicle_id = $request->v_id;
		$rto->registration_tax = $request->rto_tax;
		$rto->number_plate_charge = $request->num_plate_tax;
		$rto->muncipal_road_tax = $request->mun_tax;
		$rto->branch_id = $request->branch;

		//custom field	
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
				$rtoData = $val1;
			}
			$rto->custom_field = $rtoData;
		}

		$rto->save();

		return redirect('/rto/list')->with('message', 'Compliance Submitted Successfully');
	}

	//rto delete
	public function destroy($id)
	{
		$rto = DB::table('tbl_rto_taxes')->where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/rto/list')->with('message', 'Compliance Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			$rto = DB::table('tbl_rto_taxes')->whereIn('id', $ids)->update(['soft_delete' => 1]);
		}
	}

	//rto editform
	public function edit($id)
	{
		$editid = $id;

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
			$rto = RtoTax::where([['id', $id], ['soft_delete', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->first();
			$vehicle = Vehicle::where([['soft_delete', '=', 0], ['id', $rto->vehicle_id], ['branch_id', $adminCurrentBranch->branch_id]])->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$rto = RtoTax::where('id', '=', $id)->first();
			$vehicle = Vehicle::where([['id', $rto->vehicle_id], ['soft_delete', '=', 0]])->get();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$rto = RtoTax::where([['id', $id], ['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->first();
			$vehicle = Vehicle::where([['id', $rto->vehicle_id], ['soft_delete', '=', 0], ['branch_id', $currentUser->branch_id]])->get();
		}

		//Custom Field Data
		$tbl_custom_fields = CustomField::where([['form_name', '=', 'rto'], ['always_visable', '=', 'yes'], ['soft_delete', '=', '0']])->get();

		return view('rto.edit', compact('rto', 'editid', 'vehicle', 'tbl_custom_fields', 'branchDatas'));
	}

	//rto update
	public function update($id, Request $request)
	{
		/*$this->validate($request, [  
         	'rto_tax' => 'numeric',
         	'num_plate_tax' => 'numeric',
         	'mun_tax' => 'numeric',
         	],
		 	[
		 	'rto_tax.numeric' => 'RTO tax must be digits only',
		 	'num_plate_tax.numeric' => 'Number Plate must be digits only',
		 	'mun_tax.numeric' => 'Municipal road tax must be digits only',
		]);*/

		$rto = RtoTax::find($id);
		$rto->vehicle_id = $request->v_id;
		$rto->registration_tax = $request->rto_tax;
		$rto->number_plate_charge = $request->num_plate_tax;
		$rto->muncipal_road_tax = $request->mun_tax;
		$rto->branch_id = $request->branch;

		//custom field	
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
				$rtoData = $val1;
			}
			$rto->custom_field = $rtoData;
		}

		$rto->save();

		return redirect('/rto/list')->with('message', 'Compliance Updated Successfully');
	}
}
