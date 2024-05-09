<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Mpdf\Mpdf;
use Auth;
use App\User;
use App\Service;
use App\Setting;
use App\Gatepass;
use App\BranchSetting;
use App\Vehicle;
use Illuminate\Http\Request;
use Mpdf\Output\Destination;

class Getpasscontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//gatepass list
	public function index()
	{
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::User()->role_id) == "Customer") {
				$gatepass = Service::join('tbl_gatepasses', 'tbl_services.job_no', '=', 'tbl_gatepasses.jobcard_id')
					->where('tbl_services.customer_id', Auth::User()->id)
					->orderby('tbl_gatepasses.id', 'DESC')->get();
			} elseif (getUsersRole(Auth::User()->role_id) == "Employee") {
				$gatepass = Service::join('tbl_gatepasses', 'tbl_services.job_no', '=', 'tbl_gatepasses.jobcard_id')
					->where([['tbl_services.assign_to', Auth::User()->id], ['tbl_services.branch_id', $currentUser->branch_id]])
					->orderby('tbl_gatepasses.id', 'DESC')->get();
			} elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
				$gatepass = Service::join('tbl_gatepasses', 'tbl_services.job_no', '=', 'tbl_gatepasses.jobcard_id')
					->where('tbl_services.branch_id', $currentUser->branch_id)
					->orderby('tbl_gatepasses.id', 'DESC')->get();
			}
		} else {
			$gatepass = Service::join('tbl_gatepasses', 'tbl_services.job_no', '=', 'tbl_gatepasses.jobcard_id')
				->where('tbl_services.branch_id', $adminCurrentBranch->branch_id)
				->orderby('tbl_gatepasses.id', 'DESC')->get();
		}

		return view('gatepass.list', compact('gatepass'));
	}

	//gatepass add form
	public function addgatepass()
	{
		$characters = '0123456789';
		$code =  'G' . '' . substr(str_shuffle($characters), 0, 6);

		$customer = DB::table('users')->where('role', '=', 'Customer')->get()->toArray();
		$vehicle = DB::table('tbl_vehicles')->get()->toArray();

		$getpass = DB::table('tbl_gatepasses')->get()->toArray();

		$job_no = array();

		foreach ($getpass as $getpas) {
			$job_no[] = $getpas->jobcard_id;
		}


		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$jobno = Service::join('tbl_invoices', 'tbl_services.job_no', '=', 'tbl_invoices.job_card')
				->where('tbl_invoices.job_card', 'like', 'RMAL-RP-24-%')
				->where('tbl_services.branch_id', '=', $adminCurrentBranch->branch_id)
				->whereNotIn('tbl_invoices.job_card', $job_no)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$jobno = DB::table('tbl_invoices')->where('job_card', 'like', 'RMAL-RP-24-%')->whereNotIn('job_card', $job_no)->get()->toArray();
		} else {
			$jobno = Service::join('tbl_invoices', 'tbl_services.job_no', '=', 'tbl_invoices.job_card')
				->where('tbl_invoices.job_card', 'like', 'RMAL-RP-24-%')
				->where('tbl_services.branch_id', '=', $currentUser->branch_id)
				->whereNotIn('tbl_invoices.job_card', $job_no)->get();
		}

		return view('gatepass.gatepass', compact('customer', 'vehicle', 'code', 'jobno'));
	}

	//gatepass data to show for customer
	public function gatedata(Request $request)
	{
		$jobcard = $request->jobcard;

		$gatepass = DB::select("SELECT * FROM `tbl_services` 
        		INNER JOIN users ON tbl_services.customer_id = users.id 
        		INNER JOIN tbl_vehicles ON tbl_services.vehicle_id = tbl_vehicles.id 
				INNER JOIN tbl_jobcard_details ON tbl_services.id = tbl_jobcard_details.service_id 
				INNER JOIN tbl_vehicle_types ON tbl_vehicles.vehicletype_id = tbl_vehicle_types.id where tbl_services.job_no='$jobcard'");

		$getdata = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($gatepass), ENT_NOQUOTES));
		echo $getdata;
	}

	//gatepass store
	public function store(Request $request)
	{
		$jobcard = $request->jobcard;
		if (getDateFormat() == 'm-d-Y') {
			$out_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->out_date)));
		} else {
			$out_date = date('Y-m-d H:i:s', strtotime($request->out_date));
		}
		$jobservice = DB::table('tbl_services')->where('job_no', '=', $jobcard)->first();
		$c_id = $jobservice->customer_id;
		$v_id = $jobservice->vehicle_id;

		$gatepass = new Gatepass;
		$gatepass->jobcard_id = $jobcard;
		$gatepass->gatepass_no = $request->gatepass_no;
		$gatepass->customer_id = $c_id;
		$gatepass->vehicle_id = $v_id;
		$gatepass->service_out_date = $out_date;
		$gatepass->ser_pro_status = 1;
		$gatepass->create_by = Auth::user()->id;
		$gatepass->save();
		return redirect('/gatepass/list')->with('message', 'Gatepass Submitted Successfully');
	}

	//gatepass delete
	public function delete($id)
	{
		$gatepass = DB::table('tbl_gatepasses')->where('id', '=', $id)->delete();
		return redirect('/gatepass/list')->with('message', 'Gatepass Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			$gatepass = DB::table('tbl_gatepasses')->whereIn('id', $ids)->delete();
		}
	}

	//gatepass edit
	public function edit($id)
	{

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$jobno = Service::join('tbl_invoices', 'tbl_services.job_no', '=', 'tbl_invoices.job_card')
				->where('tbl_invoices.job_card', 'like', 'RMAL-RP-24-%')
				->where('tbl_services.branch_id', '=', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$jobno = DB::table('tbl_invoices')->where('job_card', 'like', 'RMAL-RP-24-%')->get()->toArray();
		} else {
			$jobno = Service::join('tbl_invoices', 'tbl_services.job_no', '=', 'tbl_invoices.job_card')
				->where('tbl_invoices.job_card', 'like', 'RMAL-RP-24-%')
				->where('tbl_services.branch_id', '=', $currentUser->branch_id)->get();
		}

		$gatepass = DB::table('tbl_services')
			->join('users', 'tbl_services.customer_id', '=', 'users.id')
			->join('tbl_vehicles', 'tbl_services.vehicle_id', '=', 'tbl_vehicles.id')
			->join('tbl_jobcard_details', 'tbl_services.id', '=', 'tbl_jobcard_details.service_id')
			->join('tbl_vehicle_types', 'tbl_vehicles.vehicletype_id', '=', 'tbl_vehicle_types.id')
			->join('tbl_gatepasses', 'tbl_services.job_no', '=', 'tbl_gatepasses.jobcard_id')
			->where('tbl_gatepasses.id', '=', $id)->first();


		return view('gatepass.edit', compact('gatepass', 'jobno'));
	}

	//gatepass update
	public function upadte(Request $request, $id)
	{
		$jobcard = $request->jobcard;
		if (getDateFormat() == 'm-d-Y') {
			$out_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->out_date)));
		} else {
			$out_date = date('Y-m-d H:i:s', strtotime($request->out_date));
		}
		$jobservice = DB::table('tbl_services')->where('job_no', '=', $jobcard)->first();
		$c_id = $jobservice->customer_id;
		$v_id = $jobservice->vehicle_id;

		$gatepass = Gatepass::find($id);
		$gatepass->jobcard_id = $jobcard;
		$gatepass->gatepass_no = $request->gatepass_no;
		$gatepass->customer_id = $c_id;
		$gatepass->vehicle_id = $v_id;

		$gatepass->service_out_date = $out_date;
		$gatepass->ser_pro_status = 1;
		$gatepass->create_by = Auth::user()->id;
		$gatepass->save();
		return redirect('/gatepass/list')->with('message', 'Gatepass Updated Successfully');
	}

	//gatepass pdf generate for download
	public function gatepassPDF($id, Request $request)
	{
		$getpassid = $id;

		$getpassdata = Gatepass::join('users', 'users.id', '=', 'tbl_gatepasses.customer_id')
			->join('tbl_vehicles', 'tbl_gatepasses.vehicle_id', '=', 'tbl_vehicles.id')
			->join('tbl_services', 'tbl_gatepasses.jobcard_id', '=', 'tbl_services.job_no')
			->select('tbl_gatepasses.*', 'tbl_services.service_date', 'tbl_vehicles.number_plate', 'tbl_vehicles.modelname', 'tbl_vehicles.vehicletype_id', 'tbl_vehicles.chassisno', 'tbl_vehicles.odometerreading', 'users.name', 'users.lastname')
			->where('jobcard_id', $getpassid)->first();

		$vehicle = Vehicle::where('id', '=', $getpassdata->vehicle_id)->first();
		$job = DB::table('tbl_jobcard_details')->where('jocard_no', '=', $getpassid)->first();
		$setting = Setting::first();

		// $pdf = PDF::loadView('gatepass.gatepasspdf', compact('getpassid', 'getpassdata', 'setting', 'vehicle', 'job'));

		// return $pdf->download('GATEPASS#' . $getpassid . '.pdf');

		$logo = Setting::first();

		$mpdf = new Mpdf();

		// Get the HTML content from the view
		$html = view('gatepass.gatepasspdf', compact('logo', 'getpassid', 'getpassdata', 'setting', 'vehicle', 'job'));

		// Write HTML content to the PDF
		$mpdf->autoLangToFont = true;
		$mpdf->autoScriptToLang = true;
		$mpdf->WriteHTML($html);

		$filename = 'GATEPASS-' . $getpassid . '.pdf';

		$filePath = public_path('pdf/sales/') . $filename;

		$mpdf->Output($filePath, Destination::FILE);
		// Check if page_action is set to 'mobile_app'
		if ($request->input('page_action') === 'mobile_app') {
			$filePath = 'public/pdf/sales/' . $filename;
			$gatepass = URL::to($filePath);
			return redirect($gatepass);
		} else {
			return response()->download($filePath, $filename);
		}
	}

	//gatepass modal 
	public function gatepassview(Request $request)
	{
		$getpassid = $request->getpassid;
		$page_action = $request->page_action;

		$getpassdata = Gatepass::join('users', 'users.id', '=', 'tbl_gatepasses.customer_id')
			->join('tbl_vehicles', 'tbl_gatepasses.vehicle_id', '=', 'tbl_vehicles.id')
			->join('tbl_services', 'tbl_gatepasses.jobcard_id', '=', 'tbl_services.job_no')
			->select('tbl_gatepasses.*', 'tbl_services.service_date', 'tbl_vehicles.number_plate', 'tbl_vehicles.modelname', 'tbl_vehicles.vehicletype_id', 'tbl_vehicles.chassisno', 'tbl_vehicles.odometerreading', 'users.name', 'users.lastname')
			->where('jobcard_id', $getpassid)->first();

		$vehicle = Vehicle::where('id', '=', $getpassdata->vehicle_id)->first();
		$job = DB::table('tbl_jobcard_details')->where('jocard_no', '=', $getpassid)->first();
		$setting = Setting::first();

		$html = view('gatepass.getpassmodel')->with(compact('page_action', 'getpassid', 'getpassdata', 'setting', 'vehicle', 'job'))->render();

		return response()->json(['success' => true, 'html' => $html]);
	}
}
