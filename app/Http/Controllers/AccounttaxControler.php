<?php

namespace App\Http\Controllers;

use App\AccountTaxRate;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountTaxRatesRequest;

class AccounttaxControler extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//taxrates addform
	public function index()
	{
		return view('taxrates.add');
	}

	//taxrates store
	public function store(StoreAccountTaxRatesRequest $request)
	{
		$taxrate = $request->taxrate;
		$tax = $request->tax;
		$taxNumber = $request->tax_number;
		$count = AccountTaxRate::where([['taxname', '=', $taxrate], ['soft_delete', '=', 0]])->count();
		if ($count == 0) {
			$account = new AccountTaxRate;
			$account->taxname = $taxrate;
			$account->tax = $tax;
			$account->tax_number = $taxNumber;
			$account->save();
			return redirect('/taxrates/list')->with('message', 'Tax Submitted Successfully');
		} else {
			$TaxRecord = AccountTaxRate::where([['soft_delete', '!=', 1], ['taxname', '=', $taxrate]])->first();
			if (!empty($TaxRecord)) {
				return redirect('/taxrates/add')->with('message', 'Duplicate Data');
			} else {
				$TaxRecord = new AccountTaxRate;
				$TaxRecord->taxname = $taxrate;
				$TaxRecord->tax = $tax;
				$TaxRecord->tax_number = $taxNumber;
				$TaxRecord->save();
				return redirect('/taxrates/list')->with('message', 'Tax Submitted Successfully');
			}
		}
	}

	//taxrates list
	public function taxlist()
	{
		$account = AccountTaxRate::where('soft_delete', '=', 0)->orderBy('id', 'DESC')->get();

		return view('/taxrates/list', compact('account'));
	}

	//taxrates delete
	public function destory($id)
	{
		$account = AccountTaxRate::where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/taxrates/list')->with('message', 'Tax Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			$account = AccountTaxRate::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}
	}

	//taxrates edit
	public function accountedit($id)
	{
		$editid = $id;
		$account = AccountTaxRate::where('id', '=', $id)->first();

		return view('/taxrates/edit', compact('account', 'editid'));
	}

	//taxrates update
	public function updateaccount(StoreAccountTaxRatesRequest $request, $id)
	{
		$taxrate = $request->taxrate;
		$tax = $request->tax;
		$taxNumber = $request->tax_number;
		$count = AccountTaxRate::where([['taxname', '=', $taxrate], ['id', '!=', $id]])->count();
		if ($count == 0) {
			$account = AccountTaxRate::find($id);
			$account->taxname = $taxrate;
			$account->tax = $tax;
			$account->tax_number = $taxNumber;
			
			$account->save();
			return redirect('/taxrates/list')->with('message', 'Tax Updated Successfully');
		} else {
			return redirect('/taxrates/list/edit/' . $id)->with('message', 'Duplicate Data');
		}
	}
}
