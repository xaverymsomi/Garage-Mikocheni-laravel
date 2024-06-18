<?php

namespace App\Http\Controllers;

use App\User;
use App\tbl_product_types;
use App\Color;
use App\tbl_product_units;
use App\Branch;
use App\Product;
use Mpdf\Tag\Input;
use App\CustomField;
use App\BranchSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductAddEditFormRequest;

class Productcontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//product list
	public function index()
	{
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();


		if (Auth::user()->role_id === 1) {
			$product = Product::where([
				['soft_delete', '=', 0],
				['quantity', '>', 0],
				['branch_id', '=', $adminCurrentBranch] // Add condition to filter out products with quantity > 0
			])->orderBy('id', 'DESC')->get();
		} elseif (Auth::user()->role_id === 6) {
			$product = Product::where([
				['soft_delete', '=', 0],
				['quantity', '>', 0],
				['branch_id', '=', 2] // Add condition to filter out products with quantity > 0
			])->orderBy('id', 'DESC')->get();
		} else {

			if (Gate::allows('product_owndata')) {

				$product = Product::where([
					['soft_delete', 0],
					['create_by', Auth::User()->id],
					['quantity', '>', 0] // Add condition to filter out products with quantity > 0
				])->orderBy('id', 'DESC')->get();
			} else {
				$product = Product::where([
					['soft_delete', '=', 0],
					['quantity', '>', 0] // Add condition to filter out products with quantity > 0
				])->orderBy('id', 'DESC')->get();
			}

		}


		$tbl_custom_fields = CustomField::where([['form_name', '=', 'product'], ['soft_delete', 0], ['always_visable', '=', 'yes']])->get();

		return view('product.list', compact('product', 'tbl_custom_fields'));
	}

	//product list

	// public function indexid($id)
	// {
	// 	$product = Product::where([['id', '=', $id], ['soft_delete', '=', 0]])->get();

	// 	return view('product.list', compact('product'));
	// }


	//product add form
	public function addproduct()
	{
		$characters = '0123456789';
		$code =  'PR' . '' . substr(str_shuffle($characters), 0, 6);

		$color = Color::where('soft_delete', '=', 0)->get();
		$product = DB::table('tbl_product_types')->where('soft_delete', '=', 0)->get()->toArray();
		$supplier = User::where([['role', '=', 'Supplier'], ['soft_delete', '=', 0]])->get();
		$unitproduct = DB::table('tbl_product_units')->get()->toArray();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'product'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (Auth::User()->role_id === 1) {
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
		} elseif (Auth::User()->role_id === 6) {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}

		return view('product.add', compact('supplier', 'product', 'color', 'code', 'unitproduct', 'tbl_custom_fields', 'branchDatas'));
	}

	//Add product type
	public function addproducttype(Request $request)
	{
		//$product = Input::get('product_type');
		$product = $request->product_type;
		$product_get = DB::table('tbl_product_types')->where('type', '=', $product)->count();
		if ($product_get == 0) {
			$product_type = new tbl_product_types;
			$product_type->type = $product;
			$product_type->save();
			return $product_type->id;
		} else {
			$productName = DB::table('tbl_product_types')->where([['soft_delete', '!=', 1], ['type', '=', $product]])->first();
			if (!empty($productName)) {
				return '01';
			} else {
				$product_type = new tbl_product_types;
				$product_type->type = $product;
				$product_type->save();
				echo $product_type->id;
			}
		}
	}

	//add Product color
	public function coloradd(Request $request)
	{
		$color_name = $request->c_name;
		$color_code = $request->c_code;
		$colors = DB::table('tbl_colors')->where('color', '=', $color_name)->count();

		if ($colors == 0) {
			$color = new Color;
			$color->color = $color_name;
			$color->color_code = $color_code;
			$color->save();
			echo $color->id;
		} else {
			$colorRecord = DB::table('tbl_colors')->where([['soft_delete', '!=', 1], ['color', '=', $color_name]])->first();
			if (!empty($colorRecord)) {
				return '01';
			} else {
				$color = new Color;
				$color->color = $color_name;
				$color->color_code = $color_code;
				$color->save();
				echo $color->id;
			}
		}
	}

	//delete Product Color
	public function colordelete(Request $request)
	{
		$id = $request->colorid;

		$color = DB::table('tbl_colors')->where('id', '=', $id)->update(['soft_delete' => 1]);
	}

	//add Product unit
	public function unitadd(Request $request)
	{
		$unitname = $request->unit_measurement;

		$uintcount = DB::table('tbl_product_units')->where('name', '=', $unitname)->count();
		if ($uintcount == 0) {
			$product_unit = new tbl_product_units;
			$product_unit->name = $unitname;
			$product_unit->save();
			echo $product_unit->id;
		} else {
			return '01';
		}
	}

	//delete Product Unit
	public function unitdelete(Request $request)
	{
		$unitid = $request->unitid;

		$productunit = DB::table('tbl_product_units')->where('id', '=', $unitid)->delete();
	}

	// product store
	public function store(ProductAddEditFormRequest $request)
	{
		$p_date = $request->p_date;
		$p_no = $request->p_no;
		$name = $request->name;
		$p_type = $request->p_type;
		$color = $request->color;
		$price = $request->price;
		$quantity = $request->quantity;
		$sup_id = $request->sup_id;
		$warranty = $request->warranty;
		$unit = $request->unit;

		$part_no = $request->part_no;
		$auto_maker_parts_no = $request->auto_maker_parts_no;
		$model_application = $request->model_application;
		$dealer_price = $request->dealer_price;

		if (getDateFormat() == 'm-d-Y') {
			$dates = date('Y-m-d', strtotime(str_replace('-', '/', $p_date)));
		} else {
			$dates = date('Y-m-d', strtotime($p_date));
		}

		$product = new Product;
		$product->product_no = $p_no;
		$product->product_date = $dates;

		if (!empty($request->image)) {
			$file = $request->image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/product/', $file->getClientOriginalName());
			$product->product_image = $filename;
		} else {
			$product->product_image = 'avtar.png';
		}

		$product->name = $name;
		$product->quantity = $quantity;
		$product->product_type_id = $p_type;
		$product->color_id = $color;
		$product->price = $price;
		$product->supplier_id = $sup_id;
		$product->warranty = $warranty;
		$product->category = 1; //1=Part
		$product->unit = $unit;
		$product->branch_id = $request->branch;

		$product->part_no = $part_no;
		$product->auto_maker_parts_no = $auto_maker_parts_no;
		$product->model_application = $model_application;
		$product->dealer_price = $dealer_price;

		$product->create_by = Auth::User()->id;

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
				$productData = $val1;
			}
			$product->custom_field = $productData;
		}

		$product->save();

		return redirect('/product/list')->with('message', 'Product Submitted Successfully');
	}

	//product delete
	public function destroy($id)
	{
		$product = Product::where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/product/list')->with('message', 'Product Deleted Successfully');
	}
	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			Product::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}

		return redirect('/product/list')->with('message', 'Product Deleted Successfully');
	}

	//product edit
	public function edit($id)
	{
		$editid = $id;
		$color = Color::where('soft_delete', '=', 0)->get();
		$product_type = DB::table('tbl_product_types')->where('soft_delete', '=', 0)->get()->toArray();

		$supplier = User::where([['role', '=', 'Supplier'], ['soft_delete', '=', 0]])->get();
		
		// $supplier = User::where('role', '=', 'Supplier')->where('soft_delete', '=', 0)->get();

		$unitproduct = DB::table('tbl_product_units')->get()->toArray();

		//Custom Field Data
		$tbl_custom_fields = CustomField::where([['form_name', '=', 'product'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (Auth::User()->role_id === 1) {
			$branchDatas = Branch::where('id', '=', $adminCurrentBranch->branch_id)->get();
			$product = Product::where([['id', $id], ['branch_id', $adminCurrentBranch->branch_id]])->first();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$product = Product::where('id', '=', $id)->first();
		} elseif (Auth::User()->role_id === 6) {
			$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();
			$product = Product::where([['id', $id], ['branch_id', $currentUser->branch_id]])->first();
		} else {
			$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();
			$product = Product::where([['id', $id], ['branch_id', $currentUser->branch_id]])->first();
		}

		return view('product.edit', compact('editid', 'color', 'product_type', 'supplier', 'product', 'unitproduct', 'tbl_custom_fields', 'branchDatas'));
	}

	//product update
	public function update(Request $request, $id)
	{
		$p_date = $request->p_date;
		$p_no = $request->p_no;
		$name = $request->name;
		$p_type = $request->p_type;
		$color = $request->color;
		$price = $request->price;
		$quantity = $request->quantity;
		$sup_id = $request->sup_id;
		$warranty = $request->warranty;
		$unit = $request->unit;

		$part_no = $request->part_no;
		$auto_maker_parts_no = $request->auto_maker_parts_no;
		$model_application = $request->model_application;
		$dealer_price = $request->dealer_price;



		if (getDateFormat() == 'm-d-Y') {
			$dates = date('Y-m-d', strtotime(str_replace('-', '/', $p_date)));
		} else {
			$dates = date('Y-m-d', strtotime($p_date));
		}

		$product = Product::find($id);
		$product->product_no = $p_no;
		$product->product_date = $dates;


		if (!empty($request->image)) {
			$file = $request->image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/product/', $file->getClientOriginalName());
			$product->product_image = $filename;
		}


		$product->name = $name;
		$product->product_type_id = $p_type;
		$product->color_id = $color;
		$product->price = $price;
		$product->quantity = $quantity;
		$product->supplier_id = $sup_id;
		$product->warranty = $warranty;
		$product->category = 1; //1=Part
		$product->unit = $unit;
		$product->branch_id = $request->branch;

		$product->part_no = $part_no;
		$product->auto_maker_parts_no = $auto_maker_parts_no;
		$product->model_application = $model_application;
		$product->dealer_price = $dealer_price;


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
				$productData = $val1;
			}
			$product->custom_field = $productData;
		}

		$product->save();

		return redirect('/product/list')->with('message', 'Product Updated Successfully');
	}

	//product delete
	public function deleteproducttype(Request $request)
	{
		$id = $request->ptypeid;

		DB::table('tbl_product_types')->where('id', '=', $id)->update(['soft_delete' => 1]);
		Product::where('product_type_id', '=', $id)->update(['soft_delete' => 1]);
	}
}
