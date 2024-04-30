<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Mail;
use Auth;
use App\User;
use App\Sale;
use App\Role;
use App\Branch;
use App\Service;
use App\Role_user;
use App\CustomField;
use App\BranchSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AccountantAddEditFormRequest;

class Accountantcontroller extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	//accountant list
	public function index()
	{
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (!isAdmin(Auth::User()->role_id)) {

			if (getUsersRole(Auth::user()->role_id) == 'Accountant') {
				if (Gate::allows('accountant_owndata')) {
					$accountant = User::where([['role', 'accountant'], ['soft_delete', 0], ['id', Auth::User()->id]])->orderBy('id', 'DESC')->get();
				} else {
					$accountant = User::where([['role', '=', 'accountant'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'DESC')->get();
				}
			} else {
				if (Gate::allows('accountant_owndata')) {
					$accountant = User::where([['role', '=', 'accountant'], ['soft_delete', 0], ['create_by', Auth::User()->id], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'DESC')->get();
				} else {
					$accountant = User::where([['role', '=', 'accountant'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'DESC')->get();
				}
			}
		} else {
			$accountant = User::where([['role', '=', 'accountant'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'DESC')->get();
		}

		return view('accountant.list', compact('accountant'));
	}

	//accountant addform
	public function accountantadd()
	{
		$country = DB::table('tbl_countries')->get()->toArray();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'accountant'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (isAdmin(Auth::User()->role_id)) {

			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}

		return view('accountant.add', compact('country', 'tbl_custom_fields', 'branchDatas'));
	}


	//accountant store
	public function storeaccountant(AccountantAddEditFormRequest $request)
	{
		//dd($request->all());

		$dobs = $request->dob;
		$dob = null;
		if (!empty($dobs)) {
			if (getDateFormat() == 'm-d-Y') {
				$dob = date('Y-m-d', strtotime(str_replace('-', '/', $dobs)));
			} else {
				$dob = date('Y-m-d', strtotime($dobs));
			}
		}

		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$displayname = $request->displayname;
		$gender = $request->gender;
		$email = $request->email;
		$password = $request->password;
		$mobile = $request->mobile;
		$landlineno = $request->landlineno;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;
		$image = $request->image;

		//Get user role id from Role table
		$getRoleId = Role::where('role_name', '=', 'Accountant')->first();

		$accountant = new User;
		$accountant->name = $firstname;
		$accountant->lastname = $lastname;
		$accountant->display_name = $displayname;
		$accountant->gender = $gender;
		$accountant->birth_date = $dob;
		$accountant->email = $email;
		$accountant->password = bcrypt($password);
		$accountant->mobile_no = $mobile;
		$accountant->landline_no = $landlineno;
		$accountant->address = $address;
		$accountant->country_id = $country;
		$accountant->state_id = $state;
		$accountant->city_id = $city;
		$accountant->branch_id = $request->branch;
		$accountant->create_by = Auth::User()->id;

		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/accountant/', $file->getClientOriginalName());
			$accountant->image = $filename;
		} else {
			$accountant->image = 'avtar.png';
		}

		$accountant->role = "accountant";
		$accountant->role_id = $getRoleId->id; /*Store Role table User Role Id*/
		$accountant->timezone = "UTC";
		$accountant->language = "en";

		//custom field	
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
				$accountantData = $val1;
			}
			$accountant->custom_field = $accountantData;
		}

		$accountant->save();

		if ($accountant->save()) {
			$currentUserId = $accountant->id;

			$role_user_table = new Role_user;
			$role_user_table->user_id = $currentUserId;
			$role_user_table->role_id  = $getRoleId->id;
			$role_user_table->save();
		}

		//email format
		try {
			$logo = DB::table('tbl_settings')->first();
			$systemname = $logo->system_name;
			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'User_registration')->first();
			if ($emailformats->is_send == 0) {
				if ($accountant->save()) {
					$emailformat = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'User_registration')->first();
					$mail_format = $emailformat->notification_text;
					$mail_subjects = $emailformat->subject;
					$mail_send_from = $emailformat->send_from;
					$search1 = array('{ system_name }');
					$replace1 = array($systemname);
					$mail_sub = str_replace($search1, $replace1, $mail_subjects);
					$systemlink = URL::to('/');
					$search = array('{ system_name }', '{ user_name }', '{ email }', '{ Password }', '{ system_link }');
					$replace = array($systemname, $firstname, $email, $password, $systemlink);

					$email_content = str_replace($search, $replace, $mail_format);
					$actual_link = $_SERVER['HTTP_HOST'];
					$startip = '0.0.0.0';
					$endip = '255.255.255.255';

					$data = array(
						'email' => $email,
						'mail_sub1' => $mail_sub,
						'email_content1' => $email_content,
						'emailsend' => $mail_send_from,
					);

					if (($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <= $endip)) {
						//local format email
						$data1 = Mail::send('customer.customermail', $data, function ($message) use ($data) {

							$message->from($data['emailsend'], 'noreply');
							$message->to($data['email'])->subject($data['mail_sub1']);
						});
					} else {
						//live format email					
						$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:' . $mail_send_from . "\r\n";

						$data = mail($email, $mail_sub, $email_content, $headers);
					}
				}
			}
		} catch (\Exception $e) {
		}

		return redirect('/accountant/list')->with('message', 'Accountant Submitted Successfully');
	}


	//accountant show
	public function accountantshow($id)
	{
		$viewid = $id;

		$accountant = User::where('id', '=', $id)->first();

		$service = Service::where([['customer_id', '=', $id], ['done_status', '=', '1']])->get();

		$servic = Service::where([['customer_id', '=', $id], ['done_status', '=', '2']])->get();

		$sales = Sale::where('customer_id', '=', $id)->get();

		$taxes = DB::table('tbl_sales_taxes')->where('sales_id', '=', $id)->get()->toArray();

		$tbl_custom_fields = CustomField::where([['form_name', '=', 'accountant'], ['always_visable', '=', 'yes']])->get();

		return view('accountant.view', compact('accountant', 'viewid', 'sales', 'service', 'servic', 'tbl_custom_fields'));
	}

	//accountant delete
	public function destory($id)
	{
		//$accountant = DB::table('users')->where('id','=',$id)->delete();
		$supportstaff = User::where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/accountant/list')->with('message', 'Accountant Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			User::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}

		return redirect('/accountant/list')->with('message', 'Accountant Deleted Successfully');
	}

	//accountant edit
	public function accountantedit($id)
	{
		$editid = $id;
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();

		if (!isAdmin(Auth::User()->role_id)) {
			if (Gate::allows('accountant_owndata')) {
				if (Auth::User()->id == $id) {
					$country = DB::table('tbl_countries')->get()->toArray();
					$accountant = DB::table('users')->where('id', '=', $id)->first();
					$state = DB::table('tbl_states')->where('country_id', $accountant->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $accountant->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'accountant'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

					$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();

					return view('accountant.update', compact('country', 'accountant', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
				} else if (Gate::allows('accountant_edit')) {
					$country = DB::table('tbl_countries')->get()->toArray();
					$accountant = DB::table('users')->where('id', '=', $id)->first();
					$state = DB::table('tbl_states')->where('country_id', $accountant->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $accountant->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'accountant'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

					$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();

					return view('accountant.update', compact('country', 'accountant', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
				} else {
					return abort('403', 'This action is unauthorized.');
				}
			} else if (Gate::allows('accountant_edit')) {
				$country = DB::table('tbl_countries')->get()->toArray();
				$accountant = DB::table('users')->where('id', '=', $id)->first();
				$state = DB::table('tbl_states')->where('country_id', $accountant->country_id)->get()->toArray();
				$city = DB::table('tbl_cities')->where('state_id', $accountant->state_id)->get()->toArray();

				$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'accountant'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

				if (getUsersRole(Auth::User()->role_id) == "Customer") {
					$branchDatas = Branch::get();
				} else {
					$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
				}

				return view('accountant.update', compact('country', 'accountant', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
			} else {
				return abort('403', 'This action is unauthorized.');
			}
		} else {
			$country = DB::table('tbl_countries')->get()->toArray();
			$accountant = DB::table('users')->where('id', '=', $id)->first();
			$state = DB::table('tbl_states')->where('country_id', $accountant->country_id)->get()->toArray();
			$city = DB::table('tbl_cities')->where('state_id', $accountant->state_id)->get()->toArray();
			$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'accountant'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();
			$branchDatas = Branch::get();

			return view('accountant.update', compact('country', 'accountant', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
		}
	}

	//accountant update
	public function accountantupdate($id, AccountantAddEditFormRequest $request)
	{
		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$displayname = $request->displayname;
		$gender = $request->gender;
		$emails = $request->email;
		$password = $request->password;
		$mobile = $request->mobile;
		$landlineno = $request->landlineno;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;
		$birth_date = $request->dob;

		$usimgdtaa = DB::table('users')->where('id', '=', $id)->first();
		$email = $usimgdtaa->email;

		if ($email != $emails) {
			$this->validate($request, [
				'email' => 'required|email|custom_email|unique:users'
			]);
		}

		$dob = null;
		if (!empty($birth_date)) {
			if (getDateFormat() == 'm-d-Y') {
				$dob = date('Y-m-d', strtotime(str_replace('-', '/', $birth_date)));
			} else {
				$dob = date('Y-m-d', strtotime($birth_date));
			}
		}

		$accountant = User::find($id);
		$accountant->name = $firstname;
		$accountant->lastname = $lastname;
		$accountant->display_name = $displayname;
		$accountant->gender = $gender;
		$accountant->birth_date = $dob;
		$accountant->email = $email;

		if (!empty($password)) {
			$accountant->password = bcrypt($password);
		}

		$accountant->mobile_no = $mobile;
		$accountant->landline_no = $landlineno;
		$accountant->address = $address;
		$accountant->country_id = $country;
		$accountant->state_id = $state;
		$accountant->city_id = $city;
		$accountant->branch_id = $request->branch;

		$image = $request->image;
		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/accountant/', $file->getClientOriginalName());
			$accountant->image = $filename;
		}

		$accountant->role = "accountant";

		//custom field	
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
				$accountantData = $val1;
			}
			$accountant->custom_field = $accountantData;
		}
		$accountant->save();
		return redirect('/accountant/list')->with('message', 'Accountant Updated Successfully');
	}
}
