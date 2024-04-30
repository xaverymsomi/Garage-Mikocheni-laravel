<?php

namespace App\Http\Controllers;


use App\Holiday;
use App\BusinessHour;
use Illuminate\Http\Request;

class HoursController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	// businesshours list
	public function index()
	{
		$tbl_holidays = Holiday::ORDERBY('date', 'ASC')->get();
		$tbl_hours = BusinessHour::ORDERBY('day', 'ASC')->get();

		return view('Businesshours.list', compact('tbl_holidays', 'tbl_hours'));
	}

	// businesshours store
	public function hours(Request $request)
	{
		$day = $request->day;
		$start = $request->start;
		$to = $request->to;
		$tbl_business_hours = BusinessHour::where('day', '=', $day)->count();

		if ($start <= $to) {
			if ($tbl_business_hours == 0) {
				$tbl_business_hours = new BusinessHour;
				$tbl_business_hours->day = $day;
				$tbl_business_hours->from = $start;
				$tbl_business_hours->to = $to;
				$tbl_business_hours->save();

				return redirect('/setting/hours/list')->with('message', 'Successfully Submitted');
			} else {
				$business_hours = BusinessHour::where('day', '=', $day)->first();

				$id = $business_hours->id;
				$tbl_business_hours = BusinessHour::find($id);
				$tbl_business_hours->day = $day;
				$tbl_business_hours->from = $start;
				$tbl_business_hours->to = $to;
				$tbl_business_hours->save();

				return redirect('/setting/hours/list')->with('message', 'Business Hours Updated Successfully');
			}
		} else {
			return redirect('/setting/hours/list')->with('message1', 'Please select time which is greater than start time');
		}
	}


	// holiday store
	public function holiday(Request $request)
	{
		if (getDateFormat() == 'm-d-Y') {
			$date = date('Y-m-d', strtotime(str_replace('-', '/', $request->adddate)));
			$count = Holiday::where('date', '=', $date)->count();
			$adddate = date('Y-m-d', strtotime(str_replace('-', '/', $request->adddate)));
		} else {
			$date = date('Y-m-d', strtotime($request->adddate));
			$count = Holiday::where('date', '=', $date)->count();
			$adddate = date('Y-m-d', strtotime($request->adddate));
		}
		$addtitle = $request->addtitle;
		$adddescription = $request->adddescription;
		if ($count == 0) {
			$tbl_business_hours = new Holiday;
			$tbl_business_hours->title = $addtitle;
			$tbl_business_hours->date = $adddate;
			$tbl_business_hours->description = $adddescription;
			$tbl_business_hours->save();
			return redirect('/setting/hours/list')->with('message', 'Business Holiday Added Successfully');
		} else {
			return redirect('/setting/hours/list')->with('message1', 'Date is already inserted');
		}
	}

	// holiday delete
	public function deleteholiday($id)
	{
		$tbl_holidays = Holiday::where('id', '=', $id)->delete();
		return redirect('/setting/hours/list')->with('message', 'Business Holiday Deleted Successfully');
	}

	// business hours store
	public function deletehours($id)
	{
		$tbl_business_hours = BusinessHour::where('id', '=', $id)->delete();

		return redirect('/setting/hours/list')->with('message', 'Successfully Deleted');
	}
}
