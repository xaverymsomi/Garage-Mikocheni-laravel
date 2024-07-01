<?php

namespace App\Http\Controllers;

use App\User;
use App\tbl_receipt_history;
use App\Service;
use App\BranchSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReceiptController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function list()
	{
		
		$service = DB::table('tbl_receipt_history')->orderBy('id', 'ASC')->get()->toArray();


		return view('receipts/list', compact('service'));
	}

    public function addReceipt(){
      
		$characters = '0123456789';
		$code =  'RECEIPT:' . '' . substr(str_shuffle($characters), 0, 6);

		$customer = DB::table('users')->where('role', '=', 'Customer')->get()->toArray();
		$payment_mode = DB::table('tbl_payments')->get()->toArray();
		$collecting_bank = DB::table('collecting_bank')->get()->toArray();
		$insuer = DB::table('tbl_insuers_banks')->get()->toArray();
		$currencies = DB::table('currencies')->get()->toArray();

		$getpass = DB::table('tbl_gatepasses')->get()->toArray();

		$job_no = array();

		foreach ($getpass as $getpas) {
			$job_no[] = $getpas->jobcard_id;
		}


		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (Auth::User()->role_id === 1) {
			$jobno = Service::join('tbl_invoices', 'tbl_services.job_no', '=', 'tbl_invoices.job_card')
				->where('tbl_invoices.job_card', 'like', 'RMAL-RP-24-%')
				->where('tbl_services.branch_id', '=', $adminCurrentBranch->branch_id)
				->whereNotIn('tbl_invoices.job_card', $job_no)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$jobno = DB::table('tbl_invoices')->where('job_card', 'like', 'RMAL-RP-24-%')->whereNotIn('job_card', $job_no)->get()->toArray();
		} elseif (Auth::User()->role_id === 6) {
			$jobno = Service::join('tbl_invoices', 'tbl_services.job_no', '=', 'tbl_invoices.job_card')
				->where('tbl_invoices.job_card', 'like', 'RMAL-RP-24-%')
				->where('tbl_services.branch_id', '=', $currentUser->branch_id)
				->whereNotIn('tbl_invoices.job_card', $job_no)->get();
		} else {
			$jobno = Service::join('tbl_invoices', 'tbl_services.job_no', '=', 'tbl_invoices.job_card')
				->where('tbl_invoices.job_card', 'like', 'RMAL-RP-24-%')
				->where('tbl_services.branch_id', '=', $currentUser->branch_id)
				->whereNotIn('tbl_invoices.job_card', $job_no)->get();
		}

		return view('receipts.add', compact('code','customer', 'payment_mode', 'jobno', 'collecting_bank', 'insuer', 'currencies'));
	
    }

	public function store(Request $request)
	{
		
		$invoice_amount = $request->invoice_amount;
		$customer = $request->Customername;
		$email = $request->email;
		$receiveamount = $request->receiveamount;
		$exchange_rate = $request->exchange_rate;
		$equivalent = $request->equivalent;
		$out_date = $request->out_date;


		$newData = new tbl_receipt_history;
		$newData->mode = $request->mode;
		$newData->reference_no = $request->reference_no;
		$newData->amount = $receiveamount;
		$newData->collecting_bank = $request->collecting_bank;
		$newData->quotation_number = $request->jobcard;
		$newData->received_date = $out_date;
		$newData->added_by = Auth::user()->name;
		$newData->insuer_bank = $request->insuer;
		$newData->equivalent = $equivalent;
		$newData->invoice_amount = $invoice_amount;
		$newData->customer = $customer;
		$newData->email = $email;
		$newData->exchange_rate = $exchange_rate;


		// dd($request)
		$newData->save();

		return redirect('/receipt/list');

	}

}
