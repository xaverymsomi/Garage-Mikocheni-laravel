<?php

namespace App\Http\Controllers;

use DB;
use App\Vehicletype;
use App\CustomField;
use Illuminate\Http\Request;
use App\Http\Requests\VehicleTypeAddEditFormRequest;

class VehicaltypesControler extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//  get tables and compact
	public function index()
	{
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'vehicletype'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('vehicletype.add', compact('tbl_custom_fields'));
	}

	//store vehicaltypes
	public function storevehicaltypes(VehicleTypeAddEditFormRequest $request)
	{
		$vehicaltype = $request->vehicaltype;
		$count = DB::table('tbl_vehicle_types')->where('vehicle_type', '=', $vehicaltype)->count();
		if ($count == 0) {
			$vehicaltypes = new Vehicletype;
			$vehicaltypes->vehicle_type = $vehicaltype;

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
					$vehicaltypesData = $val1;
				}
				$vehicaltypes->custom_field = $vehicaltypesData;
			}
			$vehicaltypes->save();

			return redirect('/vehicletype/list')->with('message', 'Vehicle Type  Submitted Successfully');
		} else {
			$vehicleTypeRecord = DB::table('tbl_vehicle_types')->where([['soft_delete', '!=', 1], ['vehicle_type', '=', $vehicaltype]])->first();
			if (!empty($vehicleTypeRecord)) {
				return redirect('/vehicletype/vehicletypeadd')->with('message', 'Duplicate data');
			} else {
				$vehicaltypes = new Vehicletype;
				$vehicaltypes->vehicle_type = $vehicaltype;
				$vehicaltypes->save();
				return redirect('/vehicletype/list')->with('message', 'Vehicle Type  Submitted Successfully');
			}
		}
	}

	//vehicaltype list
	public function vehicaltypelist()
	{
		$vehicaltypes = Vehicletype::where('soft_delete', '=', 0)->orderBy('id', 'DESC')->get();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'vehicletype'], ['always_visable', '=', 'yes']])->get();

		return view('vehicletype.list', compact('vehicaltypes', 'tbl_custom_fields'));
	}

	//vehicaltype delete
	public function destory($id)
	{
		$vehicaltypes = DB::table('tbl_vehicle_types')->where('id', '=', $id)->update(['soft_delete' => 1]);
		$tbl_vehicles = DB::table('tbl_vehicle_brands')->where('vehicle_id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/vehicletype/list')->with('message', 'Vehicle Type Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			$vehicaltypes = DB::table('tbl_vehicle_types')->whereIn('id', $ids)->update(['soft_delete' => 1]);
			$tbl_vehicles = DB::table('tbl_vehicle_brands')->whereIn('vehicle_id', $ids)->update(['soft_delete' => 1]);
		}

		return redirect('/vehicletype/list')->with('message', 'Vehicle Type Deleted Successfully');
	}

	//vehicaltype edit form
	public function editvehicaltype($id)
	{
		$editid = $id;
		$vehicaltypes = DB::table('tbl_vehicle_types')->where('id', '=', $id)->first();

		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'vehicletype'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('/vehicletype/edit', compact('vehicaltypes', 'editid', 'tbl_custom_fields'));
	}

	//vehicaltype update
	public function updatevehicaltype(VehicleTypeAddEditFormRequest $request, $id)
	{
		$vehicaltypes1 = $request->vehicaltype;
		$count = DB::table('tbl_vehicle_types')->where([['vehicle_type', '=', $vehicaltypes1], ['id', '!=', $id]])->count();
		if ($count == 0) {
			$vehicaltypes = Vehicletype::find($id);
			$vehicaltypes->vehicle_type = $vehicaltypes1;

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
					$vehicaltypesData = $val1;
				}
				$vehicaltypes->custom_field = $vehicaltypesData;
			}
			$vehicaltypes->save();

			return redirect('vehicletype/list')->with('message', 'Vehicle Type Updated Successfully');
		} else {
			return redirect('vehicletype/list/edit/' . $id)->with('message', 'Duplicate Data');;
		}
	}
}
