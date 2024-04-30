<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\tbl_observation_types;

class ObservationTypecontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//observation type list
	public function index()
	{
		$o_type_point = DB::table('tbl_observation_types')->get()->toArray();
		return view('observation_type.list', compact('o_type_point'));
	}

	//observation type form
	public function addobservation()
	{
		return view('observation_type.add');
	}

	//observation type store
	public function store(Request $request)
	{
		$o_point = new tbl_observation_types;
		$o_point->type = $request->o_type;
		$o_point->save();
		return redirect('/observation_type/list')->with('message', 'Checkpoint Submitted Successfully');
	}

	//observation type delete
	public function destroy($id)
	{
		$o_type_point = DB::table('tbl_observation_types')->where('id', '=', $id)->delete();
		return redirect('/observation_type/list')->with('message', 'Checkpoint Deleted Successfully');
	}

	//observation type edit
	public function edit($id)
	{
		$editid = $id;
		$o_type_point = DB::table('tbl_observation_types')->where('id', '=', $id)->first();
		return view('observation_type.edit', compact('o_type_point', 'editid'));
	}

	//observation type update
	public function update($id, Request $request)
	{
		$o_point = tbl_observation_types::find($id);
		$o_point->type = $request->o_type;
		$o_point->save();
		return redirect('/observation_type/list')->with('message', 'Checkpoint Updated Successfully');
	}
}
