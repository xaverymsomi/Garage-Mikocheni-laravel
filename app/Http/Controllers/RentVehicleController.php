<?php

namespace App\Http\Controllers;

use App\User;
use App\RentVehicle;
use App\BranchSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentVehicleController extends Controller
{
    // List of Company vehicles
    public function index(){

        $list_vehicle = RentVehicle::where('status', '=', 'available')->get();
        $currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		// if (!isAdmin(Auth::User()->role_id)) {
		// 	if (getUsersRole(Auth::user()->role_id) == 'Customer') {
		// 		if (Gate::allows('quotation_owndata')) {
		// 			$service = DB::table('tbl_services')->where([['customer_id', '=', Auth::User()->id], ['is_quotation', '=', 1], ['quotation_modify_status', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
		// 		} else {
		// 			$service = DB::table('tbl_services')->where([['is_quotation', '=', 1], ['quotation_modify_status', '=', 1], ['branch_id', $adminCurrentBranch->branch_id], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
		// 		}
		// 	} elseif (getUsersRole(Auth::user()->role_id) == 'Employee' || getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
		// 		if (Gate::allows('quotation_owndata')) {
		// 			$service = DB::table('tbl_services')->where([['create_by', '=', Auth::User()->id], ['is_quotation', '=', 1], ['quotation_modify_status', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
		// 		} else {
		// 			$service = DB::table('tbl_services')->where([['is_quotation', '=', 1], ['quotation_modify_status', '=', 1], ['branch_id', $adminCurrentBranch->branch_id], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get()->toArray();
		// 		}
		// 	}
		// } else {
		// 	$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['is_quotation', '=', 1], ['quotation_modify_status', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'ASC')->get()->toArray();
		// }
		return view('rents.vehiclelist');

    }

    // List rented vehicles 
    public function list_vehicle(){

    }

}
