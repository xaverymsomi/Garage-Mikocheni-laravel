<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use Mail;
use App\User;
use App\Income;
use App\Role;
use App\Service;
use App\Role_user;
use App\CustomField;
use App\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CustomerAddEditFormRequest;
use App\Vehicle;

class Customercontroller extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	//customer addform
	public function customeradd()
	{
		$country = DB::table('tbl_countries')->get()->toArray();
		$onlycustomer = DB::table('users')->where([['role', '=', 'Customer'], ['id', '=', Auth::User()->id]])->first();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		return view('customer.add', compact('country', 'onlycustomer', 'tbl_custom_fields'));
	}
	//customer store
	public function storecustomer(CustomerAddEditFormRequest $request)
	{
		//dd($request->all());
		/*$this->validate($request, [  
         'firstname' => 'regex:/^[(a-zA-Z\s)]+$/u',
		 'lastname'=>'regex:/^[(a-zA-Z\s)]+$/u',
		 'displayname'=>'regex:/^[(a-zA-Z\s)]+$/u',
		 //'mobile'=>'required|max:12|min:6|regex:/^[- +()]*[0-9][- +()0-9]*$/',
		 'mobile'=>'required|max:12|min:6|regex:/^[0-9]*$/',
		 //Solved by Mukesh [Bug list row number: 625 (New Add time also)]
         //'landlineno'=>'nullable|max:12|min:6|regex:/^[- +()]*[0-9][- +()0-9]*$/',
         'landlineno'=>'nullable|max:12|min:6|regex:/^[0-9]*$/',
		 'image' => 'image|mimes:jpg,png,jpeg',
		 'password'=>'required|min:6',
		 'password_confirmation' => 'required|same:password',
		 'company_name' => 'nullable|regex:/^[a-zA-Z][a-zA-Z\s\.]*$/',
		 ],[
			 'displayname.regex' => 'Enter valid display name',
			 'firstname.regex' => 'Enter valid first name',
			 'lastname.regex' => 'Enter valid last name',
			 'landlineno.regex' => 'Enter valid landline no',
			 'company_name.regex' => 'Enter only alphabets, space and dot',
		]);*/

		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$displayname = $request->displayname;
		$password = $request->password;
		$gender = $request->gender;
		$birthdate = $request->dob;
		$email = $request->email;
		$mobile = $request->mobile;
		$landlineno = $request->landlineno;
		$address = $request->address;
		$country_id = $request->country_id;
		$state_id = $request->state_id;
		$city = $request->city;
		$company_name = $request->company_name;
		$image = $request->image;
		$tax_id = $request->tax_id;

		$dob = null;
		if (!empty($birthdate)) {
			if (getDateFormat() == 'm-d-Y') {
				$dob = date('Y-m-d', strtotime(str_replace('-', '/', $birthdate)));
			} else {
				$dob = date('Y-m-d', strtotime($birthdate));
			}
		}

		if (!empty($email)) {
			$email = $email;
		} else {
			$email = null;
		}

		//Get user role id from Role table
		$getRoleId = Role::where('role_name', '=', 'Customer')->first();

		$customer = new User;
		$customer->name = $firstname;
		$customer->lastname = $lastname;
		$customer->display_name = $displayname;
		$customer->gender = $gender;
		$customer->birth_date = $dob;
		$customer->email = $email;
		$customer->password = bcrypt($password);
		$customer->mobile_no = $mobile;
		$customer->landline_no = $landlineno;
		$customer->address = $address;
		$customer->country_id = $country_id;
		$customer->state_id = $state_id;
		$customer->city_id = $city;
		$customer->company_name = $company_name;
		$customer->tax_id = $tax_id;
		$customer->create_by = Auth::User()->id;

		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/customer/', $file->getClientOriginalName());
			$customer->image = $filename;
		} else {
			$customer->image = 'avtar.png';
		}

		$customer->role = "Customer";
		$customer->role_id = $getRoleId->id; /*Store Role table User Role Id*/
		$customer->language = "en";
		$customer->timezone = "UTC";

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
				$customerdata = $val1;
			}
			$customer->custom_field = $customerdata;
		}
		$customer->save();

		/*For data store inside Role_user table*/
		if ($customer->save()) {
			$currentUserId = $customer->id;

			$role_user_table = new Role_user;
			$role_user_table->user_id = $currentUserId;
			$role_user_table->role_id  = $getRoleId->id;
			$role_user_table->save();
		}


		if (!is_null($email)) {
			//email format
			try {
				$logo = DB::table('tbl_settings')->first();
				$systemname = $logo->system_name;

				$emailformats = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'User_registration')->first();
				if ($emailformats->is_send == 0) {
					if ($customer->save()) {
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
							//Live format email					
							$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From:' . $mail_send_from . "\r\n";

							$data = mail($email, $mail_sub, $email_content, $headers);
						}
					}
				}
			} catch (\Exception $e) {
			}
		}

		return redirect('/customer/list')->with('message', 'Customer Submitted Successfully');
	}


	//customer list
	public function index()
	{
		if (!isAdmin(Auth::User()->role_id)) {

			if (getUsersRole(Auth::user()->role_id) == 'Customer') {
				if (Gate::allows('customer_owndata')) {
					$customer = User::where([['role', '=', 'Customer'], ['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->get();
				} else {
					$customer = User::where([['role', '=', 'Customer'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
				}
			} else {
				if (Gate::allows('customer_owndata')) {
					$customer = User::where([['role', '=', 'Customer'], ['soft_delete', 0], ['create_by', '=', Auth::User()->id]])->orderBy('id', 'DESC')->get();
				} else {
					$customer = User::where([['role', '=', 'Customer'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
				}
			}
		} else {
			$customer = User::where([['role', '=', 'Customer'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
		}

		return view('customer.list', compact('customer'));
	}

	//customer show
	public function customershow($id)
	{
		$viewid = $id;
		$userid = Auth::User()->id;
		$tbl_vehicles = Vehicle::where('customer_id', '=', $viewid)->where('soft_delete', '=', 0)->orderBy('created_at', 'desc')->take(3)->get();
		$jobCards = Service::orderBy('id', 'desc')->where([['job_no', 'like', 'J%'], ['customer_id', '=', $viewid]])->whereNotIn('quotation_modify_status', [1])->take(3)->get();
		$quotations = DB::table('tbl_services')->where([['customer_id', '=', $viewid], ['job_no', 'like', 'J%'], ['is_quotation', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->take(3)->get();
		$invoices = Invoice::where([['customer_id', '=', $viewid], ['soft_delete', '=', 0]])->where('type', '!=', 2)->orderBy('id', 'DESC')->take(3)->get();

		// dd($quotations);
		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::user()->role_id) == 'Customer') {
				$customer = User::where('id', '=', $id)->first();

				$tbl_custom_fields = CustomField::where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes']])->get();

				$freeservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'free']])
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();

				$paidservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'paid']])
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();

				$repeatjob = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_category', '=', 'repeat job']])
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();
			} elseif (getUsersRole(Auth::user()->role_id) == 'Employee') {
				$customer = DB::table('users')->where('id', '=', $id)->first();

				$tbl_custom_fields = CustomField::where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes']])->get();

				$freeservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'free']])
					->where('tbl_services.assign_to', '=', $userid)
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();

				$paidservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'paid']])
					->where('tbl_services.assign_to', '=', $userid)
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();

				$repeatjob = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_category', '=', 'repeat job']])
					->where('tbl_services.assign_to', '=', $userid)
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();
			} elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {

				$customer = User::where('id', '=', $id)->first();

				$tbl_custom_fields = CustomField::where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes']])->get();

				$freeservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'free']])
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();

				$paidservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'paid']])
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();

				$repeatjob = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_category', '=', 'repeat job']])
					->where('tbl_services.customer_id', '=', $id)
					->orderBy('tbl_services.id', 'desc')->take(5)
					->select('tbl_services.*')
					->get();
			}
		} else {
			$customer = User::where('id', '=', $id)->first();

			$tbl_custom_fields = CustomField::where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes']])->get();

			$freeservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'free']])
				->where('tbl_services.customer_id', '=', $id)
				->orderBy('tbl_services.id', 'desc')->take(5)
				->select('tbl_services.*')
				->get();

			$paidservice = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_type', '=', 'paid']])
				->where('tbl_services.customer_id', '=', $id)
				->orderBy('tbl_services.id', 'desc')->take(5)
				->select('tbl_services.*')
				->get();

			$repeatjob = Service::where([['tbl_services.done_status', '!=', 2], ['tbl_services.service_category', '=', 'repeat job']])
				->where('tbl_services.customer_id', '=', $id)
				->orderBy('tbl_services.id', 'desc')->take(5)
				->select('tbl_services.*')
				->get();
		}

		return view('customer.view', compact('invoices', 'jobCards', 'quotations', 'tbl_vehicles', 'customer', 'viewid', 'freeservice', 'paidservice', 'repeatjob', 'tbl_custom_fields'));
	}

	// free service modal
	public function free_open_model(Request $request)
	{
		//$serviceid = Input::get('f_serviceid');
		$serviceid = $request->f_serviceid;

		$tbl_services = DB::table('tbl_services')->where('id', '=', $serviceid)->first();

		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;

		$s_id = $tbl_services->sales_id;
		$sales = DB::table('tbl_sales')->where('id', '=', $s_id)->first();

		$job = DB::table('tbl_jobcard_details')->where('service_id', '=', $serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id', '=', $v_id)->first();

		$vehical = DB::table('tbl_vehicles')->where('id', '=', $v_id)->first();

		$customer = DB::table('users')->where('id', '=', $c_id)->first();
		$service_pro = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 0)
			->get()->toArray();

		$service_pro2 = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 1)->get()->toArray();

		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id', '=', $serviceid)->get()->toArray();

		$service_tax = DB::table('tbl_invoices')->where('sales_service_id', '=', $serviceid)->first();
		if (!empty($service_tax->tax_name)) {
			$service_taxes = explode(', ', $service_tax->tax_name);
		} else {
			$service_taxes = '';
		}
		$discounts = 0;
		if (!empty($service_tax->discount)) {
			$discounts = $service_tax->discount;
		}

		$logo = DB::table('tbl_settings')->first();

		$html = view('customer.freeservice')->with(compact('serviceid', 'tbl_services', 'sales', 'logo', 'job', 's_date', 'vehical', 'customer', 'service_pro', 'service_pro2', 'tbl_service_observation_points', 'service_tax', 'discounts', 'service_taxes'))->render();
		return response()->json(['success' => true, 'html' => $html]);
	}

	// paid service modal
	public function paid_open_model(Request $request)
	{
		//$serviceid = Input::get('p_serviceid');
		$serviceid = $request->p_serviceid;

		$tbl_services = DB::table('tbl_services')->where('id', '=', $serviceid)->first();

		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;

		$s_id = $tbl_services->sales_id;
		$sales = DB::table('tbl_sales')->where('id', '=', $s_id)->first();

		$job = DB::table('tbl_jobcard_details')->where('service_id', '=', $serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id', '=', $v_id)->first();

		$vehical = DB::table('tbl_vehicles')->where('id', '=', $v_id)->first();

		$customer = DB::table('users')->where('id', '=', $c_id)->first();
		$service_pro = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 0)
			->where('chargeable', '=', 1)
			->get()->toArray();

		$service_pro2 = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 1)->get()->toArray();

		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id', '=', $serviceid)->get()->toArray();

		$service_tax = DB::table('tbl_invoices')->where('sales_service_id', '=', $serviceid)->first();
		if (!empty($service_tax->tax_name)) {
			$service_taxes = explode(', ', $service_tax->tax_name);
		} else {
			$service_taxes = '';
		}
		// dd($service_tax->tax_name)
		if (!empty($service_tax->discount)) {
			$discount = $service_tax->discount;
		} else {
			$discount = null;
		}
		$logo = DB::table('tbl_settings')->first();

		$html = view('customer.paidservice')->with(compact('serviceid', 'tbl_services', 'sales', 'logo', 'job', 's_date', 'vehical', 'customer', 'service_pro', 'service_pro2', 'tbl_service_observation_points', 'service_tax', 'discount', 'service_taxes'))->render();
		return response()->json(['success' => true, 'html' => $html]);
	}

	// repeat service modal
	public function repeat_job_model(Request $request)
	{
		//$serviceid = Input::get('r_service');
		$serviceid = $request->r_service;

		$tbl_services = DB::table('tbl_services')->where('id', '=', $serviceid)->first();

		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;

		$s_id = $tbl_services->sales_id;
		$sales = DB::table('tbl_sales')->where('id', '=', $s_id)->first();

		$job = DB::table('tbl_jobcard_details')->where('service_id', '=', $serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id', '=', $v_id)->first();

		$vehical = DB::table('tbl_vehicles')->where('id', '=', $v_id)->first();

		$customer = DB::table('users')->where('id', '=', $c_id)->first();
		$service_pro = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 0)
			->get()->toArray();

		$service_pro2 = DB::table('tbl_service_pros')->where('service_id', '=', $serviceid)
			->where('type', '=', 1)->get()->toArray();

		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id', '=', $serviceid)->get()->toArray();

		$service_tax = DB::table('tbl_invoices')->where('sales_service_id', '=', $serviceid)->first();
		if (!empty($service_tax->tax_name)) {
			$service_taxes = explode(', ', $service_tax->tax_name);
		} else {
			$service_taxes = '';
		}
		if ($service_tax !== null) {

			$discount = $service_tax->discount;
		} else {
			$discount = 0;
		}

		$logo = DB::table('tbl_settings')->first();

		$html = view('customer.repeatservice')->with(compact('serviceid', 'tbl_services', 'sales', 'logo', 'job', 's_date', 'vehical', 'customer', 'service_pro', 'service_pro2', 'tbl_service_observation_points', 'service_tax', 'discount', 'service_taxes'))->render();
		return response()->json(['success' => true, 'html' => $html]);
	}

	// customer delete
	public function destroy($id)
	{

		//$customer = DB::table('users')->where('id','=',$id)->delete();
		$customer = User::where('id', '=', $id)->update(['soft_delete' => 1]);

		/*$tbl_incomes = DB::table('tbl_incomes')->where('customer_id','=',$id)->delete();
		$tbl_invoices = DB::table('tbl_invoices')->where('customer_id','=',$id)->delete();
		$tbl_jobcard_details = DB::table('tbl_jobcard_details')->where('customer_id','=',$id)->delete();
		$tbl_gatepasses = DB::table('tbl_gatepasses')->where('customer_id','=',$id)->delete();
		$tbl_sales = DB::table('tbl_sales')->where('customer_id','=',$id)->delete();
		$tbl_services = DB::table('tbl_services')->where('customer_id','=',$id)->delete();*/

		return redirect('/customer/list')->with('message', 'Customer Deleted Successfully');
	}
	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		if (!empty($ids)) {
			User::whereIn('id', $ids)->update(['soft_delete' => 1]);
		}

		return redirect('/customer/list')->with('message', 'Customer Deleted Successfully');
	}

	// customer edit
	public function customeredit($id)
	{
		$editid = $id;

		if (!isAdmin(Auth::User()->role_id)) {
			if (Gate::allows('customer_owndata')) {
				if (Auth::User()->id == $id) {
					//dd(Gate::allows('customer_owndata'), 1);
					$customer = DB::table('users')->where('id', '=', $id)->first();

					$country = DB::table('tbl_countries')->get()->toArray();
					$state = DB::table('tbl_states')->where('country_id', $customer->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $customer->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

					return view('customer.update', compact('country', 'customer', 'state', 'city', 'editid', 'tbl_custom_fields'));
				} else if (Gate::allows('customer_edit')) {
					//dd(Gate::allows('customer_edit'), 2);
					$customer = DB::table('users')->where('id', '=', $id)->first();

					$country = DB::table('tbl_countries')->get()->toArray();
					$state = DB::table('tbl_states')->where('country_id', $customer->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $customer->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

					return view('customer.update', compact('country', 'customer', 'state', 'city', 'editid', 'tbl_custom_fields'));
				} else {
					return abort('403', 'This action is unauthorized.');
				}
			} else if (Gate::allows('customer_edit')) {
				$customer = DB::table('users')->where('id', '=', $id)->first();

				$country = DB::table('tbl_countries')->get()->toArray();
				$state = DB::table('tbl_states')->where('country_id', $customer->country_id)->get()->toArray();
				$city = DB::table('tbl_cities')->where('state_id', $customer->state_id)->get()->toArray();

				$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

				return view('customer.update', compact('country', 'customer', 'state', 'city', 'editid', 'tbl_custom_fields'));
			} else {
				return abort('403', 'This action is unauthorized.');
			}
		} else {
			$customer = DB::table('users')->where('id', '=', $id)->first();

			$country = DB::table('tbl_countries')->get()->toArray();
			$state = DB::table('tbl_states')->where('country_id', $customer->country_id)->get()->toArray();
			$city = DB::table('tbl_cities')->where('state_id', $customer->state_id)->get()->toArray();

			$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

			return view('customer.update', compact('country', 'customer', 'state', 'city', 'editid', 'tbl_custom_fields'));
		}
	}

	// customer update
	public function customerupdate($id, CustomerAddEditFormRequest $request)
	{
		//dd($request->all());
		/*  $this->validate($request, [  
         'firstname' => 'regex:/^[(a-zA-Z\s)]+$/u',
		 'lastname'=>'regex:/^[(a-zA-Z\s)]+$/u',
		 'displayname'=>'regex:/^[(a-zA-Z\s)]+$/u',
		 //'mobile'=>'required|max:12|min:6|regex:/^[- +()]*[0-9][- +()0-9]*$/',
		 'mobile'=>'required|max:12|min:6|regex:/^[0-9]*$/',
		 //Solved by Mukesh [Bug list row number: 625]
         
         //'landlineno'=>'nullable|max:12|min:6|regex:/^[- +()]*[0-9][- +()0-9]*$/',
         'landlineno'=>'nullable|max:12|min:6|regex:/^[0-9]*$/',
		 'image' => 'image|mimes:jpg,png,jpeg',
		 'password'=>'nullable|min:6',
		 'password_confirmation' => 'nullable|same:password',
		'company_name' => 'nullable|regex:/^[a-zA-Z][a-zA-Z\s\.]*$/',
	      ],[
			'displayname.regex' => 'Enter valid display name',
			'firstname.regex' => 'Enter valid first name',
			'lastname.regex' => 'Enter valid last name',
			'landlineno.regex' => 'Enter valid landline no',
			'company_name.regex' => 'Enter only alphabets, space and dot',
		]);*/

		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$displayname = $request->displayname;
		$gender = $request->gender;
		$password = $request->password;
		$mobile = $request->mobile;
		$landlineno = $request->landlineno;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;
		$companyName = $request->company_name;
		$updated_email = $request->email;
		$updated_dob = $request->dob;
		$tax_id = $request->tax_id;


		$usimgdtaa = DB::table('users')->where('id', '=', $id)->first();
		$email = $usimgdtaa->email;
		if (!empty($email)) {
			if ($email != $updated_email) {
				$this->validate($request, [
					'email' => 'required|email|custom_email|unique:users'
				]);
			}
		}

		$dob = null;
		if (!empty($updated_dob)) {
			if (getDateFormat() == 'm-d-Y') {
				$dob = date('Y-m-d', strtotime(str_replace('-', '/', $updated_dob)));
			} else {
				$dob = date('Y-m-d', strtotime($updated_dob));
			}
		}

		$customer = User::find($id);
		$customer->name = $firstname;
		$customer->lastname = $lastname;
		$customer->display_name = $displayname;
		$customer->gender = $gender;
		$customer->birth_date = $dob;
		$customer->company_name = $companyName;
		$customer->email = $updated_email;

		if (!empty($password)) {
			$customer->password = bcrypt($password);
		}

		$customer->mobile_no = $mobile;
		$customer->landline_no = $landlineno;
		$customer->address = $address;
		$customer->country_id = $country;
		$customer->state_id = $state;
		$customer->city_id = $city;
		$customer->tax_id = $tax_id;

		$image = $request->image;
		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path() . '/customer/', $file->getClientOriginalName());
			$customer->image = $filename;
		}

		$customer->role = "Customer";

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
				$customerdata = $val1;
			}
			$customer->custom_field = $customerdata;
		}

		$customer->save();

		// if (!empty($updated_email)) {
		// 	//email format
		// 	$logo = DB::table('tbl_settings')->first();
		// 	$systemname = $logo->system_name;
		// 	$emailformats = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'User_registration')->first();
		// 	if ($emailformats->is_send == 0) {
		// 		if ($customer->save()) {
		// 			$emailformat = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'User_registration')->first();
		// 			$mail_format = $emailformat->notification_text;
		// 			$mail_subjects = $emailformat->subject;
		// 			$mail_send_from = $emailformat->send_from;
		// 			$search1 = array('{ system_name }');
		// 			$replace1 = array($systemname);
		// 			$mail_sub = str_replace($search1, $replace1, $mail_subjects);

		// 			$systemlink = URL::to('/');

		// 			$search = array('{ system_name }', '{ user_name }', '{ email }', '{ Password }', '{ system_link }');
		// 			$replace = array($systemname, $firstname, $email, $password, $systemlink);

		// 			$email_content = str_replace($search, $replace, $mail_format);


		// 			$actual_link = $_SERVER['HTTP_HOST'];
		// 			$startip = '0.0.0.0';
		// 			$endip = '255.255.255.255';
		// 			if (($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <= $endip)) {
		// 				//local format email					
		// 				$data = array(
		// 					'email' => $email,
		// 					'mail_sub1' => $mail_sub,
		// 					'email_content1' => $email_content,
		// 					'emailsend' => $mail_send_from,
		// 				);
		// 				$data1 = Mail::send('customer.customermail', $data, function ($message) use ($data) {

		// 					$message->from($data['emailsend'], 'noreply');
		// 					$message->to($data['email'])->subject($data['mail_sub1']);
		// 				});
		// 				//dd($data1);
		// 			} else {
		// 				//Live format email
		// 				$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// 				$headers .= 'From:' . $mail_send_from . "\r\n";
		// 				$sended = mail($email, $mail_sub, $email_content, $headers);

		// 				//dd($sended);
		// 			}
		// 		}
		// 	}
		// }

		return redirect('/customer/list')->with('message', 'Customer Updated Successfully');
	}

	//new added
	/* 31/07/2023 */
	public function customersvehicle($id)
	{
		$customer = User::where('id', '=', $id)->first();
		$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $id]])->orderBy('id', 'DESC')->get();
		foreach ($vehicles as $vehicle) {
			$lastService = Service::where([['vehicle_id', $vehicle->id], ['sales_id', '=', null]])->orderBy('service_date', 'desc')->first();
			$vehicle->lastServiceDate = $lastService ? Carbon::parse($lastService->service_date) : null;
		}

		return view('customer.customervehicle', compact('customer', 'vehicles'));
	}
	public function customersjobcard($id)
	{
		// dd($id);
		$customer = User::where('id', '=', $id)->first();
		$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $id]])->orderBy('id', 'DESC')->first();
		$services = Service::orderBy('id', 'desc')->where([['soft_delete', '=', 0], ['job_no', 'like', 'J%'], ['customer_id', '=', $id]])->whereNotIn('quotation_modify_status', [1])->get();

		return view('customer.customerjobcards', compact('customer', 'services'));
	}
	public function customersquotation($id)
	{
		$customer = User::where('id', '=', $id)->first();
		$service = DB::table('tbl_services')->where([['job_no', 'like', 'J%'], ['customer_id', '=', $id], ['is_quotation', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get();
		return view('customer.customerquotation', compact('customer', 'service'));
	}
	public function customersinvoice($id)
	{
		$customer = User::where('id', '=', $id)->first();
		$invoice = Invoice::where([['customer_id', '=', $id], ['soft_delete', '=', 0]])->where('type', '!=', 2)->orderBy('id', 'DESC')->get();
		return view('customer.customerinvoice', compact('customer', 'invoice'));
	}
	public function customerspayment($id)
	{
		$customer = User::where('id', '=', $id)->first();
		$income = Income::join('tbl_income_history_records', 'tbl_incomes.id', '=', 'tbl_income_history_records.tbl_income_id')->where([['tbl_incomes.soft_delete', 0], ['tbl_incomes.customer_id', $id]])->groupBy('tbl_income_history_records.tbl_income_id')->orderBy('tbl_incomes.id', 'DESC')->select('tbl_incomes.*', 'tbl_income_history_records.*')->get();
		return view('customer.customerpayment', compact('customer', 'income'));
	}
	public function customersmot(Request $request)
	{
		$id = $request->servicesid;
		$get_services_tbl_data = Service::where('vehicle_id', $id)->orderBy('id', 'desc')->first();

		if ($get_services_tbl_data) {
			$mot_test_status_yes_or_no = $get_services_tbl_data->mot_status;
			// dd($mot_test_status_yes_or_no);
			if ($mot_test_status_yes_or_no == 1) {
				/*Get data of 'vehicle_mot_test_reports' of checked for Mot Test*/
				$get_vehicle_mot_test_reports_data = DB::table('vehicle_mot_test_reports')->where('vehicle_id', '=', $id)->latest('date')->first();

				/*Get data of 'mot_vehicle_inspection_data' table with questions and answer_id */
				if ($get_mot_vehicle_inspection_data = DB::table('mot_vehicle_inspection')->where('vehicle_id', '=', $id)->latest('created_at')->first()) {

					$json_data = $get_mot_vehicle_inspection_data->answer_question_id;
					$answers_question_id_array = json_decode($json_data, true);
					/*question and answer in array in key sorted*/
					ksort($answers_question_id_array);
				}

				/*Get inspection_points_library for display MoT questions*/
				$get_inspection_points_library_data = DB::select('select * from inspection_points_library');
			} else {
				$mot_test_status_yes_or_no = null;
				$get_vehicle_mot_test_reports_data = null;
				$get_mot_vehicle_inspection_data = null;
				$answers_question_id_array = null;
				$get_inspection_points_library_data = null;
			}
		} else {
			$mot_test_status_yes_or_no = null;
			$get_vehicle_mot_test_reports_data = null;
			$get_mot_vehicle_inspection_data = null;
			$answers_question_id_array = null;
			$get_inspection_points_library_data = null;
		}
		// dd($get_vehicle_mot_test_reports_data);
		$html = view('customer.motdetailmodel')->with(compact('mot_test_status_yes_or_no', 'get_vehicle_mot_test_reports_data', 'get_mot_vehicle_inspection_data', 'answers_question_id_array', 'get_inspection_points_library_data'))->render();

		return response()->json(['success' => true, 'html' => $html]);
	}
}
