<?php

namespace App\Http\Controllers;

use DB;
use App\Branch;
use App\CustomField;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchAddEditFormRequest;

class BranchController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//Branch list
	public function branchList()
	{
		$branchDatas = Branch::where([['id', '!=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get();

		return view('branch.list', compact('branchDatas'));
	}

	//Branch addform
	public function addBranch()
	{
		$country = DB::table('tbl_countries')->get()->toArray();

		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'branch'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('branch.add', compact('country', 'tbl_custom_fields'));
	}

	//Branch store
	public function store(StoreBranchAddEditFormRequest $request)
	{
		$branchname = $request->branchname;
		$contactnumber = $request->contactnumber;
		$email = $request->email;
		$address = $request->address;
		$image = $request->image;
		$country_id = $request->country_id;
		$state_id = $request->state_id;
		$city = $request->city;

		$branch = new Branch;
		$branch->branch_name = $branchname;
		$branch->contact_number = $contactnumber;
		$branch->branch_email = $email;
		$branch->branch_address = $address;
		$branch->country_id = $country_id;
		$branch->state_id = $state_id;
		$branch->city_id = $city;

		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/img/branch/', $file->getClientOriginalName());
			$branch->branch_image = $filename;
		} else {
			$branch->branch_image = 'avtar.png';
		}

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
				$branchData = $val1;
			}
			$branch->custom_field = $branchData;
		}

		$branch->save();

		return redirect('/branch/list')->with('message', 'Branch Submitted Successfully');
	}


	//Branch Show/View
	public function showBranch($id)
	{

		$branchData = Branch::where('id', '=', $id)->first();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'branch'], ['always_visable', '=', 'yes']])->get();

		return view('branch.show', compact('branchData', 'tbl_custom_fields'));
	}


	//Branch delete
	public function destroy($id)
	{
		$branch = Branch::where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/branch/list')->with('message', 'Branch Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			$branch = Branch::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}
	}

	//Branch edit
	public function edit($id)
	{
		$branchData = Branch::where('id', '=', $id)->first();

		$country = DB::table('tbl_countries')->get()->toArray();
		$state = DB::table('tbl_states')->where('country_id', $branchData->country_id)->get()->toArray();
		$city = DB::table('tbl_cities')->where('state_id', $branchData->state_id)->get()->toArray();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'branch'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('branch.edit', compact('branchData', 'tbl_custom_fields', 'country', 'state', 'city'));
	}

	//Branch update
	public function update($id, StoreBranchAddEditFormRequest $request)
	{

		$branchname = $request->branchname;
		$contactnumber = $request->contactnumber;
		$email = $request->email;
		$address = $request->address;
		$image = $request->image;
		$country_id = $request->country_id;
		$state_id = $request->state_id;
		$city = $request->city;


		$branch = Branch::find($id);
		$branch->branch_name = $branchname;
		$branch->contact_number = $contactnumber;
		$branch->branch_email = $email;
		$branch->branch_address = $address;
		$branch->country_id = $country_id;
		$branch->state_id = $state_id;
		$branch->city_id = $city;

		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/img/branch/', $file->getClientOriginalName());
			$branch->branch_image = $filename;
		}

		//Custom field
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
				$branchData = $val1;
			}
			$branch->custom_field = $branchData;
		}

		$branch->save();

		return redirect('/branch/list')->with('message', 'Branch Updated Successfully');
	}
}
