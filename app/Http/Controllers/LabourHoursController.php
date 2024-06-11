<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Labours;

class LabourHoursController extends Controller
{
    public function list()
    {

        $o_type_point = DB::table('tbl_labours')->get()->toArray();
        return view('labour.list', compact('o_type_point'));
    }

    public function add()
    {
        $library = DB::table('tbl_products')->get()->toArray();
        $body_type = DB::table('tbl_vehicle_types')->get()->toArray();
        $model_name = DB::table('tbl_vehicles')->get()->toArray();

        return view('labour.add', compact('library', 'body_type', 'model_name'));
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $vehicleType = $request->vehicleType;
        $modelName = $request->modelName;
        $time = $request->hours;

        $newData = new Labours;
        $newData->name = $name;
        $newData->vehicleType = $vehicleType;
        $newData->modelName = $modelName;
        $newData->hours = $time;

        $newData->save();
        return redirect('/labor_hour/list');

        // dd($request->all());
    }

    public function edit($id)
    {
        $editid = $id;
        $o_type_point = DB::table('tbl_labours')->where('id', '=', $id)->first();

        $library = DB::table('tbl_products')->get()->toArray();
        $body_type = DB::table('tbl_vehicle_types')->get()->toArray();
        $model_name = DB::table('tbl_vehicles')->get()->toArray();

        return view('labour.edit', compact('o_type_point', 'editid', 'library', 'body_type', 'model_name'));
    }

    public function update(Request $request, $id)
    {
        // Find the Labours object by id
        $o_point = Labours::find($id);
    
        // Check if the object is found
        if ($o_point) {
            // Assign new values from the request
            $o_point->name = $request->name;
            $o_point->hours = $request->hours;
            $o_point->modelName = $request->modelName;
            $o_point->vehicleType = $request->vehicleType;
            
            // Save the updated object to the database
            $o_point->save();
    
            // Redirect to the list page with a success message
            return redirect('/labor_hour/list')->with('success', 'Labour updated successfully!');
        } else {
            // If no object is found, redirect back with an error message
            return redirect()->back()->withErrors('Labour not found.');
        }
    }
    public function delete($id)
	{
		$o_type_point = DB::table('tbl_labours')->where('id', '=', $id)->delete();
		return redirect('/labor_hour/list')->with('message', 'Checkpoint Deleted Successfully');
	}    
}
