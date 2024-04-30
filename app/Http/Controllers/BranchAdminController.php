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
use App\Http\Requests\StoreBranchAdminAddEditRequest;

class BranchAdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//Branch Admin list
	public function index()
	{
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (isAdmin(Auth::User()->role_id)) {
			$branchadmins = User::where([['role', '=', 'branch_admin'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
			$branchadmins = User::where([['role', '=', 'branch_admin'], ['soft_delete', 0], ['id', Auth::User()->id]])->orderBy('id', 'DESC')->get();
		} else {
			$branchadmins = User::where([['role', '=', 'branch_admin'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
		}

		return view('branch_admin.list', compact('branchadmins'));
	}


	//Branch Admin add form
	public function addBranchAdmin()
	{
		$country = DB::table('tbl_countries')->get()->toArray();
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'branch_admin'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		$branchDatas = Branch::get();

		return view('branch_admin.add', compact('country', 'tbl_custom_fields', 'branchDatas'));
	}


	//Branch Admin store
	public function storeBranchAdmin(StoreBranchAdminAddEditRequest $request)
	{
		//dd($request->all());
		$email = $request->email;
		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$displayname = $request->displayname;
		$gender = $request->gender;
		$birthdate = $request->dob;
		$password = $request->password;
		$mobile = $request->mobile;
		$landlineno = $request->landlineno;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;

		$dob = null;
		if (!empty($birthdate)) {
			if (getDateFormat() == 'm-d-Y') {
				$dob = date('Y-m-d', strtotime(str_replace('-', '/', $birthdate)));
			} else {
				$dob = date('Y-m-d', strtotime($birthdate));
			}
		}

		//Get user role id from Role table
		$getRoleId = Role::where('role_name', '=', 'Branch Admin')->first();

		$branchadmin = new User;
		$branchadmin->name = $firstname;
		$branchadmin->lastname = $lastname;
		$branchadmin->display_name = $displayname;
		$branchadmin->gender = $gender;
		$branchadmin->birth_date = $dob;
		$branchadmin->email = $email;
		$branchadmin->password = bcrypt($password);
		$branchadmin->mobile_no = $mobile;
		$branchadmin->landline_no = $landlineno;
		$branchadmin->address = $address;
		$branchadmin->country_id = $country;
		$branchadmin->state_id = $state;
		$branchadmin->city_id = $city;
		$branchadmin->branch_id = $request->branch;
		$branchadmin->create_by = Auth::User()->id;

		$image = $request->image;
		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/branch_admin/', $file->getClientOriginalName());
			$branchadmin->image = $filename;
		} else {
			$branchadmin->image = 'avtar.png';
		}

		$branchadmin->role_id = $getRoleId->id; /*Store Role table User Role Id*/

		$branchadmin->role = "branch_admin";
		$branchadmin->language = "en";
		$branchadmin->timezone = "UTC";

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
				$branchadminData = $val1;
			}
			$branchadmin->custom_field = $branchadminData;
		}
		$branchadmin->save();

		if ($branchadmin->save()) {
			$currentUserId = $branchadmin->id;

			$role_user_table = new Role_user;
			$role_user_table->user_id = $currentUserId;
			$role_user_table->role_id = $getRoleId->id;
			$role_user_table->save();
		}

		//email format
		try {
			$logo = DB::table('tbl_settings')->first();
			$systemname = $logo->system_name;
			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'User_registration')->first();
			if ($emailformats->is_send == 0) {
				if ($branchadmin->save()) {
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
		return redirect('/branchadmin/list')->with('message', 'Branch Admin Submitted Successfully');
	}


	//Branch Admin show
	public function branchAdmminShow($id)
	{
		$viewid = $id;
		$branchadmin = User::where('id', '=', $id)->first();
		$service = Service::where([['customer_id', '=', $id], ['done_status', '=', '1']])->get();
		$servic = Service::where([['customer_id', '=', $id], ['done_status', '=', '2']])->get();
		$sales = Sale::where('customer_id', '=', $id)->get();
		$taxes = DB::table('tbl_sales_taxes')->where('sales_id', '=', $id)->get()->toArray();
		$tbl_custom_fields = CustomField::where([['form_name', '=', 'branch_admin'], ['always_visable', '=', 'yes']])->get();

		return view('branch_admin.view', compact('branchadmin', 'viewid', 'sales', 'service', 'servic', 'tbl_custom_fields'));
	}


	//Branch Admin edit
	public function branchAdminEdit($id)
	{

		$editid = $id;
		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();

		if (!isAdmin(Auth::User()->role_id)) {
			if (Gate::allows('branchAdmin_owndata')) {
				if (Auth::User()->id == $id) {
					$country = DB::table('tbl_countries')->get()->toArray();
					$branchadmin = DB::table('users')->where('id', '=', $id)->first();

					$state = DB::table('tbl_states')->where('country_id', $branchadmin->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $branchadmin->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'branch_admin'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

					$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();

					return view('branch_admin.update', compact('country', 'branchadmin', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
				} else if (Gate::allows('branchAdmin_edit')) {
					$country = DB::table('tbl_countries')->get()->toArray();
					$branchadmin = DB::table('users')->where('id', '=', $id)->first();

					$state = DB::table('tbl_states')->where('country_id', $branchadmin->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $branchadmin->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'branch_admin'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

					$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();

					return view('branch_admin.update', compact('country', 'branchadmin', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
				} else {
					return abort('403', 'This action is unauthorized.');
				}
			} else if (Gate::allows('branchAdmin_edit')) {
				$country = DB::table('tbl_countries')->get()->toArray();
				$branchadmin = DB::table('users')->where('id', '=', $id)->first();

				$state = DB::table('tbl_states')->where('country_id', $branchadmin->country_id)->get()->toArray();
				$city = DB::table('tbl_cities')->where('state_id', $branchadmin->state_id)->get()->toArray();

				$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'branch_admin'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

				if (getUsersRole(Auth::User()->role_id) == "Customer") {
					$branchDatas = Branch::get();
				} else {
					$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
				}

				return view('branch_admin.update', compact('country', 'branchadmin', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
			} else {
				return abort('403', 'This action is unauthorized.');
			}
		} else {
			$country = DB::table('tbl_countries')->get()->toArray();
			$branchadmin = DB::table('users')->where('id', '=', $id)->first();
			$state = DB::table('tbl_states')->where('country_id', $branchadmin->country_id)->get()->toArray();
			$city = DB::table('tbl_cities')->where('state_id', $branchadmin->state_id)->get()->toArray();
			$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'branch_admin'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();
			$branchDatas = Branch::get();

			return view('branch_admin.update', compact('country', 'branchadmin', 'state', 'city', 'editid', 'tbl_custom_fields', 'branchDatas'));
		}
	}


	//Branch Admin update
	public function branchAdminUpdate($id, StoreBranchAdminAddEditRequest $request)
	{
		$usimgdtaa = DB::table('users')->where('id', '=', $id)->first();
		$email = $usimgdtaa->email;

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
		$birtDate = $request->dob;

		$dob = null;
		if (!empty($birtDate)) {
			if (getDateFormat() == 'm-d-Y') {
				$dob = date('Y-m-d', strtotime(str_replace('-', '/', $birtDate)));
			} else {
				$dob = date('Y-m-d', strtotime($birtDate));
			}
		}

		$branchadmin = User::find($id);
		$branchadmin->name = $firstname;
		$branchadmin->lastname = $lastname;
		$branchadmin->display_name = $displayname;
		$branchadmin->gender = $gender;
		$branchadmin->birth_date = $dob;
		$branchadmin->email = $email;

		if (!empty($password)) {
			$branchadmin->password = bcrypt($password);
		}

		$branchadmin->mobile_no = $mobile;
		$branchadmin->landline_no = $landlineno;
		$branchadmin->address = $address;
		$branchadmin->country_id = $country;
		$branchadmin->state_id = $state;
		$branchadmin->city_id = $city;
		$branchadmin->branch_id = $request->branch;

		$image = $request->image;
		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/branch_admin/', $file->getClientOriginalName());
			$branchadmin->image = $filename;
		}
		$branchadmin->role = "branch_admin";

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
				$branchadminData = $val1;
			}
			$branchadmin->custom_field = $branchadminData;
		}
		$branchadmin->save();

		return redirect('/branchadmin/list')->with('message', 'Branch Admin Updated Successfully');
	}


	//Branch Admin delete
	public function destroy($id)
	{
		$branchadmin = User::where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/branchadmin/list')->with('message', 'Branch Admin Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			User::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}

		return redirect('/customer/list')->with('message', 'Branch Admin Deleted Successfully');
	}
}
