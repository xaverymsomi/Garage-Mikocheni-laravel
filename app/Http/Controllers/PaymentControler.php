<?php

namespace App\Http\Controllers;

use DB;
use App\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentMethodRequest;

class PaymentControler extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//payment add form
	public function index()
	{
		return view('payment.add');
	}

	//payment store
	public function paymentstore(StorePaymentMethodRequest $request)
	{

		$paymenttype = $request->payment;
		$count = PaymentMethod::where('payment', '=', $paymenttype)->count();

		if ($count == 0) {
			$payment = new PaymentMethod;
			$payment->payment = $paymenttype;
			$payment->save();
			return redirect('payment/list')->with('message', 'Payment Method Submitted Successfully');
		} else {
			$PaymentRecord = DB::table('tbl_payments')->where([['soft_delete', '!=', 1], ['payment', '=', $paymenttype]])->first();
			if (!empty($PaymentRecord)) {
				return redirect('/payment/add')->with('message', 'Duplicate Data');
			} else {
				$PaymentRecord = new PaymentMethod;
				$PaymentRecord->payment = $paymenttype;
				$PaymentRecord->payment = $paymenttype;
				$PaymentRecord->save();
				return redirect('/payment/list')->with('message', 'Payment Method Submitted Successfully');
			}
		}
	}

	//payment list
	public function paymentlist()
	{
		$payment_methods = PaymentMethod::where('soft_delete', '=', 0)->orderBy('id', 'DESC')->get();

		return view('payment.list', compact('payment_methods'));
	}

	//payment delete
	public function destory($id)
	{
		$payment_methods = PaymentMethod::where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/payment/list')->with('message', 'Payment Method Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			$payment_methods = PaymentMethod::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}
	}

	//payment edit
	public function editpayment($id)
	{
		$editid = $id;
		$payment_methods = PaymentMethod::where('id', '=', $id)->first();

		return view('payment.edit', compact('payment_methods', 'editid'));
	}

	//payment update
	public function updatepayment(StorePaymentMethodRequest $request, $id)
	{
		$paymenttype = $request->payment;
		$count = PaymentMethod::where([['payment', '=', $paymenttype], ['id', '!=', $id]])->count();

		if ($count == 0) {
			$payment = PaymentMethod::find($id);
			$payment->payment = $paymenttype;
			$payment->save();
			return redirect('payment/list')->with('message', 'Payment Method Updated Successfully');
		} else {
			return redirect('payment/list/edit/' . $id)->with('message', 'Duplicate Data');
		}
	}
}
