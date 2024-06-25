<?php

namespace App\Http\Controllers;

use DB;
use App\Color;
use App\CustomField;
use Illuminate\Http\Request;

class Colorcontroller extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	//color list
	public function index()
	{
		$color = Color::where('soft_delete', '=', 0)->orderBy('id', 'DESC')->get();

		//Custom Field Data
		$tbl_custom_fields = CustomField::where([['form_name', '=', 'color'], ['always_visable', '=', 'yes']])->get();

		return view('color.list', compact('color', 'tbl_custom_fields'));
	}

	//color addform
	public function addcolor()
	{
		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'color'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('color.add', compact('tbl_custom_fields'));
	}

	//color store
	public function store(Request $request)
	{
		$color = $request->color;
		$color_code = $request->c_name;

		$count = DB::table('tbl_colors')->where('color', '=', $color)->count();
		if ($count == 0) {
			$colors = new Color;
			$colors->color = $color;
			$colors->color_code = $color_code;
			
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
					$colorsData = $val1;
				}
				$colors->custom_field = $colorsData;
			}
			$colors->save();

			return redirect('/color/list')->with('message', 'Color Submitted Successfully');
		} else {
			$colorRecord = DB::table('tbl_colors')->where([['soft_delete', '!=', 1], ['color', '=', $color]])->first();
			if (!empty($colorRecord)) {
				return redirect('/color/add')->with('message', 'Duplicate Data');
			} else {
				$colors = new Color;
				$colors->color = $color;
				$colors->save();
				return redirect('/color/list')->with('message', 'Color Submitted Successfully');
			}
		}
	}

	//color delete
	public function destroy($id)
	{
		$vehicle_colors = DB::table('tbl_vehicle_colors')->where('color', $id)->count();
		if ($vehicle_colors > 0) {
			return redirect('/color/list')->with('message', 'This color is used with a vehicle record. So you can not delete it.');
		}

		//$colors = DB::table('tbl_colors')->where('id','=',$id)->delete();
		$colors = DB::table('tbl_colors')->where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/color/list')->with('message', 'Color Deleted Successfully');
	}
	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		foreach ($ids as $id) {
			$this->destroy($id);
		}

		return response()->json(['message' => 'Successfully deleted selected purchase records']);
	}

	//color edit
	public function edit($id)
	{
		$editid = $id;
		$colors = DB::table('tbl_colors')->where('id', '=', $id)->first();

		//Custom Field Data
		//$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','color'],['always_visable','=','yes']])->get()->toArray();
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'color'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('color.edit', compact('colors', 'editid', 'tbl_custom_fields'));
	}

	//color update
	public function update($id, Request $request)
	{
		$color = Color::find($id);
		//$colors = Input::get('color');
		$colors = $request->color;
		$color_code = $request->c_name;

		$count = DB::table('tbl_colors')->where([['color', '=', $colors], ['id', '!=', $id]])->count();
		if ($count == 0) {
			$color->color = $colors;
			$color->color_code = $color_code;

			//custom field
			//$custom = Input::get('custom');
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
					$colorData = $val1;
				}
				$color->custom_field = $colorData;
			}
			$color->save();

			return redirect('/color/list')->with('message', 'Color Updated Successfully');
		} else {
			return redirect('/color/list/edit/' . $id)->with('message', 'Duplicate Data');
		}
	}
}
