<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Stock;
use App\Setting;
use App\Product;
use App\SalePart;
use App\BranchSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Stockcontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//stock list
	public function index()
	{

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$stock = Product::join('tbl_stock_records', 'tbl_products.id', '=', 'tbl_stock_records.product_id')
				->where('tbl_stock_records.branch_id', '=', $adminCurrentBranch->branch_id)
				->orderBy('tbl_stock_records.id', 'DESC')->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$stock = Product::join('tbl_stock_records', 'tbl_products.id', '=', 'tbl_stock_records.product_id')
				->orderBy('tbl_stock_records.id', 'DESC')->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Accountant') {
			if (Gate::allows('stock_owndata')) {
				$stock = Product::join('tbl_stock_records', 'tbl_products.id', '=', 'tbl_stock_records.product_id')
					->where('tbl_products.create_by', '=', Auth::User()->id)
					->orderBy('tbl_stock_records.id', 'DESC')->get();
			} else {
				$stock = Product::join('tbl_stock_records', 'tbl_products.id', '=', 'tbl_stock_records.product_id')
					->where('tbl_stock_records.branch_id', '=', $currentUser->branch_id)
					->orderBy('tbl_stock_records.id', 'DESC')->get();
			}
		} else {
			$stock = Product::join('tbl_stock_records', 'tbl_products.id', '=', 'tbl_stock_records.product_id')
				->where('tbl_stock_records.branch_id', '=', $currentUser->branch_id)
				->orderBy('tbl_stock_records.id', 'DESC')->get();
		}
		return view('stoke.list', compact('stock'));
	}

	//stock edit
	public function edit($id)
	{
		$product = DB::table('tbl_products')->get()->toArray();
		$stock = DB::table('tbl_stock_records')->where('id', '=', $id)->first();
		return view('stoke.edit', compact('product', 'stock'));
	}

	//stock update 
	public function update($id, Request $request)
	{
		$stocks = DB::table('tbl_stock_records')->where('id', '=', $id)->first();
		$oldstock = $stocks->no_of_stoke;
		$newstock = $request->qty;

		$stock = Stock::find($id);
		$stock->product_id = $request->product;
		$stock->no_of_stoke = $newstock;
		$stock->save();
		return redirect('stoke/list')->with('message', 'Successfully Updated');
	}

	//stock modal view
	public function stockview(Request $request)
	{
		$stockid = $request->stockid;
		$logo = Setting::first();

		$stockdata = Stock::join('tbl_products', 'tbl_stock_records.product_id', '=', 'tbl_products.id')
			->join('tbl_purchase_history_records', 'tbl_products.id', '=', 'tbl_purchase_history_records.product_id')
			->join('tbl_purchases', 'tbl_purchase_history_records.purchase_id', '=', 'tbl_purchases.id')
			->where('tbl_stock_records.id', '=', $stockid)
			->orderBy('tbl_purchases.date', 'DESC')
			->get();

		$currentstock = Stock::where('id', '=', $stockid)->first();

		$cell_stock = "";
		$p_id = $currentstock->product_id;
		$product = Product::find($p_id);

		if ($product->category == 1) {
			$cellstock = SalePart::where('product_id', '=', $p_id)->get();
			$celltotal = 0;

			foreach ($cellstock as $cellstocks) {
				$cell_stock = $cellstocks->quantity;
				$celltotal += $cell_stock;
			}

			$product_service_stocks = DB::table('tbl_service_pros')->where('product_id', '=', $p_id)->get()->toArray();
			$product_service_stocks_total = 0;

			foreach ($product_service_stocks as $product_service_stock) {
				$service_stock = $product_service_stock->quantity;
				$product_service_stocks_total += $service_stock;
			}
		} else {
			$cellstock = DB::table('tbl_service_pros')->where('product_id', '=', $p_id)->get()->toArray();
			$celltotal = 0;
			foreach ($cellstock as $cellstocks) {
				$cell_stock = $cellstocks->quantity;
				$celltotal += $cell_stock;
			}

			$product_service_stocks = DB::table('tbl_service_pros')->where('product_id', '=', $p_id)->get()->toArray();
			$product_service_stocks_total = 0;

			foreach ($product_service_stocks as $product_service_stock) {
				$service_stock = $product_service_stock->quantity;
				$product_service_stocks_total += $service_stock;
			}
		}

		$sale_service_stock = $product_service_stocks_total + $celltotal;
		// dd($stockid, $currentstock->no_of_stoke, $celltotal, $product_service_stocks_total);
		$html = view('stoke.stokemodel')->with(compact('stockid', 'stockdata', 'logo', 'currentstock', 'p_id', 'cellstock', 'cell_stock', 'celltotal', 'product_service_stocks_total', 'sale_service_stock', 'product'))->render();

		return response()->json(['success' => true, 'html' => $html]);
	}

	//manage stock modal
	public function managestock(Request $request)
	{
		$stockid = $request->stockid;
		$logo = Setting::first();

		$stockdata = Stock::join('tbl_products', 'tbl_stock_records.product_id', '=', 'tbl_products.id')
			->join('tbl_purchase_history_records', 'tbl_products.id', '=', 'tbl_purchase_history_records.product_id')
			->join('tbl_purchases', 'tbl_purchase_history_records.purchase_id', '=', 'tbl_purchases.id')
			->where('tbl_stock_records.id', '=', $stockid)
			->orderBy('tbl_purchases.date', 'DESC')
			->get();

		$currentstock = Stock::where('id', '=', $stockid)->first();
		$p_id = $currentstock->product_id;
		$product = Product::find($p_id);
		$quantity = getStockCurrent($currentstock->product_id);


		// dd($product);
		$html = view('stoke.managestoke')->with(compact('stockdata', 'logo', 'product', 'quantity', 'p_id'))->render();

		return response()->json(['success' => true, 'html' => $html]);
	}

	public function addStock(Request $request)
	{
		$p_id = $request->product_id;
		$stocks = DB::table('tbl_stock_records')->where('id', '=', $p_id)->first();
		$newstock = $request->quantity;

		// Get Sale stock
		$saleParts = SalePart::where('product_id', '=', $p_id)->get();
		$salePartsTotalQuantity = $saleParts->sum('quantity');

		// Get service stock
		$productServiceStocks = DB::table('tbl_service_pros')->where('product_id', '=', $p_id)->get();
		$productServiceStocksTotalQuantity = $productServiceStocks->sum('quantity');

		// Calculate total stock
		$totalStockQuantity = $newstock + $salePartsTotalQuantity + $productServiceStocksTotalQuantity;

		$stock = Stock::where('product_id', '=', $p_id)->first();
		$stock->product_id = $request->product_id;
		$stock->no_of_stoke = $totalStockQuantity;
		$stock->save();
		return redirect('stoke/list')->with('message', 'Stock Updated Successfully');
	}
}
