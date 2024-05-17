<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Mail;
use App\User;
use App\Sale;
use App\Role;
use App\Branch;
use App\Service;
use App\Vehicle;
use App\Setting;
use App\Washbay;
use App\Role_user;
use App\BranchSetting;
use App\RepairCategory;
use App\JobcardDetail;
use App\tbl_service_images;
use App\tbl_service_pros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\tbl_service_observation_points;
use Illuminate\Support\Facades\URL;

class ServicesControler extends Controller
{
	//get tables and compact 
	public function __construct()
	{
		$this->middleware('auth');
	}

	//service list
	public function servicelist()
	{
		$month = date('m');
		$year = date('Y');
		$available = "";
		$servi_id = "";
		$start_date = "$year/$month/01";
		$end_date = "$year/$month/30";
		$date = array();

		$current_month = Service::whereBetween('service_date', [$start_date, $end_date])->get();
		if (!empty($current_month)) {
			foreach ($current_month as $list) {
				$date[] = $list->service_date;
			}
			$available = json_encode($date);
		}

		$ser_id_jobcard_details = JobcardDetail::get();
		foreach ($ser_id_jobcard_details as $ser_id) {
			$servi_id = $ser_id->service_id;
		}

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();

		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::user()->role_id) == 'Customer') {
				$service = Service::where([['job_no', 'like', 'RMAl-RP-24-%'], ['customer_id', '=', Auth::User()->id], ['soft_delete', '=', 0], ['is_quotation', '=', 0]])->orderBy('id', 'DESC')->get();
			} elseif (getUsersRole(Auth::user()->role_id) == 'Employee') {
				if (Gate::allows('service_owndata')) {
					$service = Service::where([['job_no', 'like', 'RMAl-RP-24-%'], ['assign_to', '=', Auth::User()->id], ['soft_delete', '=', 0], ['is_quotation', '=', 0], ['branch_id', $currentUser->branch_id]])->orderBy('id', 'DESC')->get();
				} else {
					$service = Service::where([['job_no', 'like', 'RMAl-RP-24-%'], ['soft_delete', '=', 0], ['is_quotation', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'DESC')->get();
				}
			} elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
				if (Gate::allows('service_owndata')) {
					$service = Service::where([['job_no', 'like', 'RMAl-RP-24-%'], ['soft_delete', '=', 0], ['is_quotation', '=', 0], ['branch_id', $currentUser->branch_id], ['create_by', Auth::User()->id]])->orderBy('id', 'DESC')->get();
				} else {
					$service = Service::where([['job_no', 'like', 'RMAl-RP-24-%'], ['soft_delete', '=', 0], ['is_quotation', '=', 0], ['branch_id', $adminCurrentBranch->branch_id]])->orderBy('id', 'DESC')->get();
				}
			}
		} else {
			$service = Service::where([['job_no', 'like', 'RMAl-RP-24-%'], ['soft_delete', '=', 0], ['is_quotation', '=', 0]])->orderBy('id', 'DESC')->get();
		}

		// $service = Service::where([['job_no', 'like', 'RMAl-RP-24-%'], ['soft_delete', '=', 0], ['is_quotation', '=', 0]])->orderBy('id', 'ASC')->get();

		return view('service/list', compact('service', 'available', 'current_month', 'servi_id'));
	}

	//service add form
	public function index()
	{
		$last_order = DB::table('tbl_services')->latest()->where('sales_id', '=', null)->first();

if (!empty($last_order)) {
    // Get the last jobcard number
    $lastJobcardNumber = $last_order->job_no;

    // Extract the numeric part of the jobcard number
    $lastNumber = intval(substr($lastJobcardNumber, -4));

    // Increment the last number
    $incrementedNumber = $lastNumber + 1;

    // Generate jobcard number with format RMAL-RP-24-<increment>
    $prefix = 'RMAL-RP-24-';
    $new_number = $prefix . str_pad($incrementedNumber, 4, '0', STR_PAD_LEFT);
} else {
    // If no previous jobcard found, start from 001
    $new_number = 'RMAL-RP-24-0001';
}

$code = $new_number;


		//Customer add
		$customer = DB::table('users')->where([['role', 'Customer'], ['soft_delete', 0]])->get()->toArray();
		$country = DB::table('tbl_countries')->get()->toArray();
		$onlycustomer = DB::table('users')->where([['role', '=', 'Customer'], ['id', '=', Auth::User()->id]])->first();

		//vehicle add
		$vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
		$fuel_type = DB::table('tbl_fuel_types')->where('soft_delete', '=', 0)->get()->toArray();
		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get()->toArray();

		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {

			$branchDatas = Branch::where('soft_delete', '=', 0)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::where('soft_delete', '=', 0)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0]])->get()->toArray();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->where('soft_delete', '=', 0)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		}

		$repairCategoryList = DB::table('table_repair_category')->where([['soft_delete', "=", 0]])->get()->toArray();

		return view('service.add', compact('employee', 'customer', 'code', 'country', 'onlycustomer', 'vehical_brand', 'vehical_type', 'fuel_type', 'color', 'model_name', 'tbl_custom_fields', 'branchDatas', 'repairCategoryList'));
	}

	//customer add
	public function customeradd(Request $request)
	{
		$firstname = $request->firstname;
		$gender = $request->gender;
		$email = $request->email;
		$password = $request->password;
		$mobile = $request->mobile;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;

		$dobs = $request->dob;
		if (getDateFormat() == 'm-d-Y') {
			$dob = date('Y-m-d', strtotime(str_replace('-', '/', $dobs)));
		} else {
			$dob = date('Y-m-d', strtotime($dobs));
		}

		//Get user role id from Role table
		$getRoleId = Role::where('role_name', '=', 'Customer')->first();

		$customer = new User;
		$customer->name = $firstname;
		$customer->gender = $gender;
		$customer->birth_date = $dob;
		$customer->email = $email;
		$customer->password = bcrypt($password);
		$customer->mobile_no = $mobile;
		$customer->address = $address;
		$customer->country_id = $country;
		$customer->state_id = $state;
		$customer->city_id = $city;

		$images = $request->image;
		if (!empty($images)) {
			//$file= Input::file('image');
			$file = $images;
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
		$customer->save();

		/*For data store inside Role_user table*/
		if ($customer->save()) {
			$currentUserId = $customer->id;

			$role_user_table = new Role_user;
			$role_user_table->user_id = $currentUserId;
			$role_user_table->role_id  = $getRoleId->id;
			$role_user_table->save();
		}

		$customer_fullname = $customer->name;

		return response()->json(['customerId' => $customer->id, 'customer_fullname' => $customer_fullname]);
	}

	//add vehicle 
	public function vehicleadd(Request $request)
	{
		$vehical_type = $request->vehical_id1;
		$chasicno = $request->chasicno1;
		$vehicabrand = $request->vehicabrand1;
		$modelyear = $request->modelyear1;
		$fueltype = $request->fueltype1;
		$modelname = $request->modelname1;
		$price = $request->price1;
		$domm = $request->dom1;
		$engineno = $request->engineno1;
		$numberPlate = $request->numberPlate;
		$customer_id = $request->customer_id;
		$select_branch_vehicle = $request->branch_id_vehicle;

		

		$vehical = new Vehicle;
		$vehical->vehicletype_id = $vehical_type;
		$vehical->chassisno = $chasicno;
		$vehical->vehiclebrand_id = $vehicabrand;
		$vehical->modelyear  = $modelyear;
		$vehical->fuel_id  = $fueltype;
		$vehical->modelname = $modelname;
		$vehical->price = $price;
		$vehical->engineno = $engineno;
		$vehical->number_plate = $numberPlate;
		$vehical->added_by_service = 1;
		$vehical->customer_id = $customer_id;
		$vehical->branch_id = $select_branch_vehicle;
		$vehical->save();

		$vehicles = DB::table('tbl_vehicles')->orderBy('id', 'desc')->first();
		$vehi_id = $vehicles->id;
		$model_name = $vehicles->modelname;

		echo $vehical->id;
	}

	//add repair Category
	public function addRepairCategory(Request $request)
	{
		$repairCategoryName = $request->repair_category_name;

		$repairCategories = DB::table('table_repair_category')->where('repair_category_name', '=', $repairCategoryName)->count();

		if ($repairCategories == 0) {
			$repairCategory = new RepairCategory;
			$repairCategory->repair_category_name = $repairCategoryName;
			$repairCategory->slug = $repairCategoryName;
			$repairCategory->added_by_system = 0;
			$repairCategory->soft_delete = 0;
			$repairCategory->save();
			echo $repairCategory->slug;
		} else {
			$repairCategoryRecord = DB::table('table_repair_category')->where([['soft_delete', '!=', 1], ['repair_category_name', '=', $repairCategoryName]])->first();
			if (!empty($repairCategoryRecord)) {
				return '01';
			} else {
				$repairCategory = new RepairCategory;
				$repairCategory->repair_category_name = $repairCategoryName;
				$repairCategory->slug = $repairCategoryName;
				$repairCategory->added_by_system = 0;
				$repairCategory->soft_delete = 0;
				$repairCategory->save();
				echo $repairCategory->slug;
			}
		}
	}

	// Repair Category Delete
	public function deleteRepairCategory(Request $request)
	{
		$id = $request->colorid;
		$color = DB::table('table_repair_category')->where('slug', '=', $id)->update(['soft_delete' => 1]);
	}

	//get regi. number
	public function getregistrationno(Request $request)
	{
		$vehi_id = $request->vehi_id;

		$vehicals = DB::table('tbl_sales')->where('vehicle_id', '=', $vehi_id)->first();
		if (!empty($vehicals)) {
			$reg = $vehicals->registration_no;
		} else {
			$vehicals = DB::table('tbl_vehicles')->where('id', '=', $vehi_id)->first();
			$reg = $vehicals->registration_no;
		}
		return $reg;
	}

	//get vehicle name
	public function get_vehicle_name(Request $request)
	{
		$cus_id = $request->cus_id;
		$selectedVId = $request->input('v_id');

		$vehicals = DB::table('tbl_services')->where('customer_id', '=', $cus_id)->groupBy('vehicle_id')->get()->toArray();

		$vehicle = getVehicles1($cus_id);

		// If no vehicles are available, remove previous options
		if (empty($vehicle)) {
			return;
		}

		$arr = implode(",", $vehicle);
		$option = explode(",", $arr);

		foreach ($option as $value) {
			// Split the value into number plate and vehicle model
			$parts = explode("/", $value);
		
			// Check if the parts array has at least four elements
			if (count($parts) >= 4) {
				// Extract the number plate and vehicle model
				$numberPlate = $parts[2]; // Assuming the number plate is in the third part
				$vehicleModel = $parts[1];
				
				// Check if the current option is selected
				$isSelected = ($parts[3] == $selectedVId) ? 'selected' : '';
				?>
				<option value="<?php echo $parts[3]; ?>" class="modelnms" <?php echo $isSelected; ?>>
					<?php echo "$numberPlate / $vehicleModel"; ?>
				</option>
				<?php
			} else {
				// If the parts array doesn't contain enough elements, log an error or handle it appropriately
				error_log("Invalid option value: $value");
				// Output the value for debugging
				?>
				<option value="<?php echo $selectedVId; ?>" class="modelnms">
					<?php echo "DEBUG: $value"; ?>
				</option>
				<?php
			}
		}
		
		
		
		
		
	}


	//add_jobcard store
	public function add_jobcard(Request $request)
	{
		$job_no = $request->job_no;
		$service_id = $request->service_id;
		$cus_id = $request->cust_id;
		$vehi_id = $request->vehi_id;
		// $kms = $request->kms;
		$coupan_no = $request->coupan_no;
		$product = $request->product;
		$sub_product = $request->sub_product;
		$comment = $request->comment;
		$obs_auto_id = $request->obs_id;

		$in_date = $request->in_date;
		$out_date = $request->out_date;

		if (getDateFormat() == 'm-d-Y') {
			$in_dat = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $in_date)));
			$out_dat = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $out_date)));
		} else {
			$in_dat = date('Y-m-d H:i:s', strtotime($in_date));
			$out_dat = date('Y-m-d H:i:s', strtotime($out_date));
		}

		if (!empty($product)) {
			foreach ($product as $key => $value) {
				$category = $product[$key];
				$sub = $sub_product[$key];
				$comm = $comment[$key];
				$obs_au_id = $obs_auto_id[$key];

				$tbl_service_pros = new tbl_service_pros;
				$tbl_service_pros->service_id = $service_id;
				$tbl_service_pros->category = $category;
				$tbl_service_pros->obs_point = $sub;
				$tbl_service_pros->type = 0;
				$tbl_service_pros->chargeable = 1;
				$tbl_service_pros->category_comments = $comm;
				$tbl_service_pros->tbl_service_observation_points_id = $obs_au_id;
				$tbl_service_pros->save();
			}
		}

		$tbl_jobcard_details = new JobcardDetail;
		$tbl_jobcard_details->customer_id = $cus_id;
		$tbl_jobcard_details->vehicle_id = $vehi_id;
		$tbl_jobcard_details->service_id = $service_id;
		$tbl_jobcard_details->jocard_no = $job_no;
		$tbl_jobcard_details->in_date = $in_dat;
		$tbl_jobcard_details->out_date = $out_dat;
		// $tbl_jobcard_details->kms_run = $kms;

		if (!empty($coupan_no)) {
			$tbl_jobcard_details->coupan_no = $coupan_no;
		}

		$tbl_jobcard_details->save();

		$mot_main_module_status_checked = DB::table('tbl_services')->where('id', '=', $service_id)->first();
		if ($mot_main_module_status_checked !== null) {

			$mot_main_module_status = $mot_main_module_status_checked->mot_status;
		} else {
			$mot_main_module_status = null;
		}

		$inspection_data = array();

		if ($mot_main_module_status == 1) {
			$inspection_data = $request->inspection;
			$data_for_db = json_encode($inspection_data);
			$fill_mot_vehicle_inspection = array('answer_question_id' => $data_for_db, 'vehicle_id' => $vehi_id, 'service_id' => $service_id, 'jobcard_number' => $job_no);
			$mot_vehicle_inspection_data_store = DB::table('mot_vehicle_inspection')->insert($fill_mot_vehicle_inspection);
			$get_vehicle_inspection_id = DB::table('mot_vehicle_inspection')->latest('id')->first();
			$get_vehicle_current_id = $get_vehicle_inspection_id->id;

			if (in_array('x', $inspection_data) || in_array('r', $inspection_data)) {
				$mot_test_status = 'fail';
			} else {
				$mot_test_status = 'pass';
			}

			$generateMotTestNumber = rand();
			$todayDate = date('Y-m-d');

			$fill_data_vehicle_mot_test_reports = array('vehicle_id' => $vehi_id, 'service_id' => $service_id, 'mot_vehicle_inspection_id' => $get_vehicle_current_id, 'test_status' => $mot_test_status, 'mot_test_number' => $generateMotTestNumber, 'date' => $todayDate);

			$insert_data_vehicle_mot_test_reports = DB::table('vehicle_mot_test_reports')->insert($fill_data_vehicle_mot_test_reports);
		} else {
			//echo "You have not checked MoT Module";
		}

		//email format
		try {
			$user = DB::table('users')->where('id', '=', $cus_id)->first();
			$email = $user->email;
			$firstname = $user->name;
			$logo = DB::table('tbl_settings')->first();
			$systemname = $logo->system_name;
			$servicedetails = DB::table('tbl_services')->where('job_no', '=', $job_no)->first();
			$details = $servicedetails->detail;
			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'successful_jobcard')->first();
			if ($emailformats->is_send == 0) {
				if ($tbl_jobcard_details->save()) {
					$emailformat = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'successful_jobcard')->first();
					$mail_format = $emailformat->notification_text;
					$mail_subjects = $emailformat->subject;
					$mail_send_from = $emailformat->send_from;
					$search1 = array('{ jobcard_number }');
					$replace1 = array($job_no);
					$mail_sub = str_replace($search1, $replace1, $mail_subjects);

					$search = array('{ system_name }', '{ Customer_name }', '{ jobcard_number }', '{ service_date }', '{ detail }');
					$replace = array($systemname, $firstname, $job_no, $in_dat, $details);

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
		return redirect('/jobcard/list')->with('message', 'Service Submitted Successfully');
	}


	//Service store
	public function store(Request $request)
	{
		$mot_test_status = $request->motTestStatusCheckbox;
		$job = $request->jobno;
		$vehicalname = $request->vehicalname;
		$Customername = $request->Customername;
		$details = $request->details;
		$reg_no = $request->reg_no;
		$title = $request->title;
		$AssigneTo = $request->AssigneTo;
		$service_category = $request->repair_cat;
		$ser_type = $request->service_type;
		$charge = $request->charge;
		$vehicalname = $request->vehicalname;
		$Customername = $request->Customername;
		$date = $request->date;
		$image = $request->image;

		if ($mot_test_status == "on") {
			$mot_test_status = 1;
		} else {
			$mot_test_status = 0;
		}

		$color = null;
		if (getDateFormat() == 'm-d-Y') {
			$date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));
		} else {
			$date = date('Y-m-d H:i:s', strtotime($date));
		}

		if ($ser_type == 'free') {
			$charge = "0";
		}

		if ($ser_type == 'paid') {
			$charge = $request->charge;
		}

		$available = Service::where('job_no', '=', $job)->first();

		if ($available) {
			// If record exists, update it
			$available->vehicle_id = $vehicalname;
			$available->service_date = $date;
			$available->title = $title;
			$available->assign_to = $AssigneTo;
			$available->service_category = $service_category;
			$available->charge = $charge;
			$available->customer_id = $Customername;
			$available->detail = $details;
			$available->service_type = $ser_type;
			$available->mot_status = $mot_test_status;
			$available->branch_id = $request->branch;
			$available->create_by = Auth::User()->id;

			// Update custom field
			$custom = $request->custom;
			if (!empty($custom)) {
				$custom_field_value = [];
				foreach ($custom as $key => $value) {
					if (is_array($value)) {
						$value = implode(",", $value);
					}
					$custom_field_value[$key] = $value;
				}
				$available->custom_field = json_encode($custom_field_value);
			}

			$available->save();
		} else {
			// If record doesn't exist, create a new one
			$services = new Service;
			$services->job_no = $job;
			$services->vehicle_id = $vehicalname;
			$services->service_date = $date;
			$services->title = $title;
			$services->assign_to = $AssigneTo;
			$services->service_category = $service_category;
			$services->done_status = 0;
			$services->charge = $charge;
			$services->customer_id = $Customername;
			$services->detail = $details;
			$services->service_type = $ser_type;
			$services->mot_status = $mot_test_status;
			$services->branch_id = $request->branch;
			$services->create_by = Auth::User()->id;
			
			// Save custom field
			$custom = $request->custom;
			if (!empty($custom)) {
				$custom_field_value = [];
				foreach ($custom as $key => $value) {
					if (is_array($value)) {
						$value = implode(",", $value);
					}
					$custom_field_value[$key] = $value;
				}
				$services->custom_field = json_encode($custom_field_value);
			}
			$services->save();
		}

		$get_service_id = DB::table('tbl_services')->where('job_no', '=', $job)->pluck('id')->first();

		$image = $request->image;
		if (!empty($image)) {
			$files = $image;

			foreach ($files as $file) {
				$filename = $file->getClientOriginalName();
				$file->move(public_path() . '/service/', $file->getClientOriginalName());
				$images = new tbl_service_images();
				$images->service_id = $get_service_id;
				$images->image = $filename;
				$images->save();
			}
		}

		$washbay_status = $request->washbay;

		if ($washbay_status == 'on') {
			$washbay_charge = $request->washBayCharge;

			$washbays = new Washbay;
			$washbays->service_id = $get_service_id;
			$washbays->jobcard_no = $job;
			$washbays->vehicle_id = $vehicalname;
			$washbays->customer_id = $Customername;
			$washbays->price = $washbay_charge;
			$washbays->save();
		}

		$washbay_price = Washbay::where([['jobcard_no', '=', $job], ['customer_id', '=', $Customername]])->first();


		$service_data = DB::table('tbl_services')->orderBy('id', 'DESC')->first();
		$veh_id = $service_data->vehicle_id;
		$ser_id = $service_data->id;
		$cus_id = $service_data->customer_id;
		$counpan_no = [];
		$job_card_data = DB::table('tbl_jobcard_details')->where([['customer_id', '=', $cus_id], ['vehicle_id', '=', $veh_id]])->get()->toArray();
		if (!empty($job_card_data)) {
			foreach ($job_card_data as $job_card_datas) {
				$counpan_no[] = $job_card_datas->coupan_no;
			}

			$free_coupan = DB::table('tbl_services')->where([['customer_id', '=', $Customername], ['service_type', '=', 'free'], ['vehicle_id', '=', $vehicalname], ['job_no', 'like', 'C%']])->get()->toArray();
		} else {
			$free_coupan = DB::table('tbl_services')->where([['customer_id', '=', $Customername], ['service_type', '=', 'free'], ['vehicle_id', '=', $vehicalname], ['job_no', 'like', 'C%']])->whereNotIn('job_no', $counpan_no)->get()->toArray();
		}

		$sale_date = DB::table('tbl_sales')->where('vehicle_id', '=', $veh_id)->first();
		if (!empty($sale_date)) {
			$color_id = $sale_date->color_id;
			$color = DB::table('tbl_colors')->where('id', '=', $color_id)->first();
		}
		$num_plate = $request->number_plate;
		// $vehical = DB::table('tbl_vehicles')->where('number_plate', 'like', "%$num_plate")->first();
		$vehical = DB::table('tbl_vehicles')->where('id', '=', "$veh_id")->first();
		$obs_point = DB::table('tbl_service_observation_points')->where([['services_id', '=', $ser_id], ['review', '=', 1]])->get()->toArray();

		$sale_regi = DB::table('tbl_sales')->where('vehicle_id', '=', $vehicalname)->first();
		if (!empty($sale_regi)) {
			DB::update("update tbl_sales set registration_no = '$reg_no' where vehicle_id = $vehicalname");
		} else {
			DB::update("update tbl_vehicles set registration_no = '$reg_no' where id = $vehicalname");
		}

		$logo = DB::table('tbl_settings')->first();
		$inspection_points_library_data = DB::table('inspection_points_library')->get();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		$names = null;
		if (isAdmin(Auth::User()->role_id)) {
			$tbl_checkout_categories = DB::table('tbl_checkout_categories')->where([['vehicle_id', '=', $veh_id], ['soft_delete', '=', 0]])->orWhere('vehicle_id', '=', 0)->where('branch_id', '=', $adminCurrentBranch->branch_id)->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$tbl_checkout_categories = DB::table('tbl_checkout_categories')->where([['vehicle_id', '=', $veh_id], ['soft_delete', '=', 0]])->orWhere('vehicle_id', '=', 0)->get()->toArray();
		} else {
			$tbl_checkout_categories = DB::table('tbl_checkout_categories')->where([['vehicle_id', '=', $veh_id], ['soft_delete', '=', 0]])->orWhere('vehicle_id', '=', 0)->where('branch_id', '=', $currentUser->branch_id)->get()->toArray();
		}
		return view('service/jobcard_form', compact('service_data', 'vehical', 'tbl_checkout_categories', 'sale_date', 'color', 'obs_point', 'free_coupan', 'logo', 'inspection_points_library_data', 'washbay_price'));
	}

	//select checkpoints
	public function select_checkpt(Request $request)
	{
		$value = $request->value;
		$id = $request->id;
		$service_id = $request->service_id;

		$datas = DB::table('tbl_service_observation_points')->where([['services_id', '=', $service_id], ['observation_points_id', '=', $id]])->first();

		if (!empty($datas)) {
			$review = $datas->review;
			if ($review == 1) {
				DB::update("update tbl_service_observation_points set review = 0 where services_id='$service_id' and observation_points_id='$id'");
			} else {
				DB::update("update tbl_service_observation_points set review = 1 where services_id='$service_id' and observation_points_id='$id'");
			}
		} else {
			$data = new tbl_service_observation_points;
			$data->services_id = $service_id;
			$data->observation_points_id = $id;
			$data->review = $value;
			$data->save();
		}
	}

	//get obs. points
	public function Get_Observation_Pts(Request $request)
	{
		$s_id = $request->service_id;

		$product = DB::table('tbl_products')->get();
		$data = DB::table('tbl_points')
			->join('tbl_service_observation_points', 'tbl_service_observation_points.observation_points_id', '=', 'tbl_points.id')
			->where([['tbl_service_observation_points.services_id', '=', $s_id], ['review', '=', 1]])
			->select('tbl_points.*', 'tbl_service_observation_points.id')
			->get()->toArray();
		$html = view('service.observationpoin')->with(compact('s_id', 'product', 'data'))->render();
		return response()->json(['success' => true, 'html' => $html]);
	}

	//service delete
	public function destory($id)
	{
		$service1 = DB::table('tbl_jobcard_details')->where('service_id', '=', $id)->first();
		$tbl_invoices1 = DB::table('tbl_invoices')->where('sales_service_id', '=', $id)->first();

		if (!empty($tbl_invoices1)) {
			$in_id = $tbl_invoices1->id;

			$tbl_invoices = DB::table('tbl_invoices')->where('id', '=', $in_id)->first();
			$invoice_no = $tbl_invoices->invoice_number;
			$incomes_id = DB::table('tbl_incomes')->where('invoice_number', '=', $invoice_no)->first();

			if (!empty($incomes_id)) {
				$incomeid = $incomes_id->id;
			}
		}

		if (!empty($service1)) {
			$jobid = $service1->jocard_no;
			$tbl_gatepasses = DB::table('tbl_gatepasses')->where('jobcard_id', '=', $jobid)->delete();
		}

		$tbl_jobcard_details = DB::table('tbl_jobcard_details')->where('service_id', '=', $id)->update(['soft_delete' => 1]);
		$tbl_service_pros = DB::table('tbl_service_pros')->where('service_id', '=', $id)->update(['soft_delete' => 1]);
		$tbl_services = DB::table('tbl_services')->where('id', '=', $id)->update(['soft_delete' => 1]);

		return redirect('/service/list')->with('message', 'Service Deleted Successfully');
	}

	public function destroyMultiple(Request $request)
	{
		$ids = $request->input('ids');

		foreach ($ids as $id) {
			$this->destory($id);
		}

		return response()->json(['message' => 'Successfully deleted selected purchase records']);
	}

	//service edit
	public function serviceedit($id)
	{
		$vehical = DB::table('tbl_vehicles')->where('soft_delete', '=', 0)->get()->toArray();
		$customer = DB::table('users')->where([['role', 'Customer'], ['soft_delete', 0]])->get()->toArray();
		$service = DB::table('tbl_services')->where('id', '=', $id)->first();
		$cus_id = $service->customer_id;
		$vah_id = $service->vehicle_id;
		$tbl_sales = DB::table('tbl_sales')->where('vehicle_id', $vah_id)->first();
		$images1 = DB::table('tbl_service_images')->where('service_id', '=', $id)->get()->toArray();

		if (!empty($tbl_sales)) {
			$regi = DB::table('tbl_sales')->where('customer_id', $cus_id)->first();
		} else {
			$regi = DB::table('tbl_vehicles')->where('id', $vah_id)->first();
		}

		if (!empty($regi)) {
			$regi_no = $regi->registration_no;
		} else {
			$regi_no = null;
		}

		$washbay_data = Washbay::where('service_id', '=', $id)->first();
		$washbayPrice = null;
		if (!empty($washbay_data)) {
			$washbayPrice = $washbay_data->price;
		}

		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0]])->get()->toArray();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		}

		$repairCategoryList = DB::table('table_repair_category')->where([['soft_delete', "=", 0]])->get()->toArray();

		return view('service/edit', compact('service', 'vehical', 'employee', 'customer', 'regi_no', 'tbl_custom_fields', 'washbayPrice', 'branchDatas', 'repairCategoryList', 'images1'));
	}

	//service update
	public function serviceupdate(Request $request, $id)
	{
		$job = $request->jobno;
		$vehicalname = $request->vehicalname;
		$title = $request->title;
		$AssigneTo = $request->AssigneTo;
		$service_category = $request->repair_cat;
		$donestatus = $request->donestatus;
		$ser_type = $request->service_type;
		$Customername = $request->Customername;
		$details = $request->details;
		$date = $request->date;
		$mot_test_status = $request->motTestStatusCheckbox;
		$charge = $request->charge;

		if (getDateFormat() == 'm-d-Y') {
			$date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));
		} else {
			$date = date('Y-m-d H:i:s', strtotime($date));
		}

		

		if ($mot_test_status == "") {
			$mot_test_status = 0;
		}

		$services = Service::find($id);
		$services->job_no = $job;
		$services->service_date = $date;
		$services->title = $title;
		$services->assign_to = $AssigneTo;
		$services->service_category = $service_category;
		$services->charge = $charge;
		$services->mot_status = $mot_test_status;
		$services->branch_id = $request->branch;

		$tblservice = DB::table('tbl_services')->where('id', '=', $id)->first();
		$status = $tblservice->done_status;
		if ($status == 0) {
			$services->done_status = 0;
		} elseif ($status == 1) {
			$services->done_status = 1;
		} elseif ($status == 2) {
			$services->done_status = 2;
		}

		$services->detail = $details;
		$services->service_type = $ser_type;

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
				$serviceData = $val1;
			}
			$services->custom_field = $serviceData;
		}
		$services->save();

		$files = $request->image;
		if (!empty($files)) {
			foreach ($files as $file) {
				//if(Input::hasFile('image'))
				if ($files) {
					$filename = $file->getClientOriginalName();
					$file->move(public_path() . '/service/', $file->getClientOriginalName());
					$images = new tbl_service_images;
					$images->service_id = $id;
					$images->image = $filename;
					$images->save();
				}
			}
		}

		$washbay_status = $request->washbay;
		$washbay_charge = $request->washBayCharge;
		$washbay_data = Washbay::where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->first();

		$invoicesData = DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->first();
		$serviceData = DB::table('tbl_services')->where('id', '=', $id)->first();

		if (!empty($washbay_data)) {
			if ($washbay_status == 'on') {
				if (!empty($invoicesData)) {
					if ($washbay_charge != $washbay_data->price) {
						$totalAmount = $invoicesData->total_amount;
						$grandTotal = $invoicesData->grand_total;

						$totalAmountNew = ($totalAmount - $washbay_data->price) + $washbay_charge;
						$grandTotalNew = 0;
						$discountNew = 0;
						$taxNew = 0;
						$grandTotalOld = 0;

						$discountIs = $invoicesData->discount;
						$taxIs = $invoicesData->tax_name;

						if (!empty($discountIs)) {
							$discountNew = ($totalAmountNew * ($discountIs / 100));
						}

						$all_taxes = 0;
						if (!empty($taxIs)) {

							$taxes = explode(', ', $taxIs);
							foreach ($taxes as $tax) {
								$singleTax = preg_replace("/[^0-9,.]/", "", $tax);
								$all_taxes += $singleTax;
							}
						}

						$afterDiscountCutTotalAmount = $totalAmountNew - $discountNew;
						$taxNew = ($afterDiscountCutTotalAmount * ($all_taxes / 100));
						$grandTotalNew = $afterDiscountCutTotalAmount + $taxNew;

						DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->update(['total_amount' => $totalAmountNew, 'grand_total' => $grandTotalNew]);

						Washbay::where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->update(['price' => $washbay_charge]);
					}
				} else {
					Washbay::where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->update(['price' => $washbay_charge]);
				}
			} else {
				if (!empty($invoicesData)) {
					$totalAmount = $invoicesData->total_amount;
					$grandTotal = $invoicesData->grand_total;

					$totalAmountNew = $totalAmount - $washbay_data->price;
					$grandTotalNew = 0;
					$discountNew = 0;
					$taxNew = 0;
					$grandTotalOld = 0;

					$discountIs = $invoicesData->discount;
					$taxIs = $invoicesData->tax_name;

					if (!empty($discountIs)) {
						$discountNew = ($totalAmountNew * ($discountIs / 100));
					}

					$all_taxes = 0;
					if (!empty($taxIs)) {

						$taxes = explode(', ', $taxIs);
						foreach ($taxes as $tax) {
							$singleTax = preg_replace("/[^0-9,.]/", "", $tax);
							$all_taxes += $singleTax;
						}
					}

					$afterDiscountCutTotalAmount = $totalAmountNew - $discountNew;
					$taxNew = ($afterDiscountCutTotalAmount * ($all_taxes / 100));
					$grandTotalNew = $afterDiscountCutTotalAmount + $taxNew;

					DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->update(['total_amount' => $totalAmountNew, 'grand_total' => $grandTotalNew]);

					DB::table('washbays')->where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->delete();
				}

				DB::table('washbays')->where([['service_id', '=', $id], ['jobcard_no', '=', $job]])->delete();
			}
		} else {
			if ($washbay_status == 'on') {
				$washbays = new Washbay;
				$washbays->service_id = $id;
				$washbays->jobcard_no = $job;
				$washbays->vehicle_id = $serviceData->vehicle_id;
				$washbays->customer_id = $serviceData->customer_id;
				$washbays->price = $washbay_charge;
				$washbays->save();

				if (!empty($invoicesData)) {
					$totalAmount = $invoicesData->total_amount;
					$grandTotal = $invoicesData->grand_total;

					$totalAmountNew = $totalAmount + $washbay_charge;
					$grandTotalNew = 0;
					$discountNew = 0;
					$taxNew = 0;
					$grandTotalOld = 0;

					$discountIs = $invoicesData->discount;
					$taxIs = $invoicesData->tax_name;

					if (!empty($discountIs)) {
						$discountNew = ($totalAmountNew * ($discountIs / 100));
					}

					$all_taxes = 0;
					if (!empty($taxIs)) {

						$taxes = explode(', ', $taxIs);
						foreach ($taxes as $tax) {
							$singleTax = preg_replace("/[^0-9,.]/", "", $tax);
							$all_taxes += $singleTax;
						}
					}

					$afterDiscountCutTotalAmount = $totalAmountNew - $discountNew;
					$taxNew = ($afterDiscountCutTotalAmount * ($all_taxes / 100));
					$grandTotalNew = $afterDiscountCutTotalAmount + $taxNew;

					DB::table('tbl_invoices')->where([['sales_service_id', '=', $id], ['job_card', '=', $job], ['type', '=', 0]])->update(['total_amount' => $totalAmountNew, 'grand_total' => $grandTotalNew]);
				}
			}
		}

		return redirect('/service/list')->with('message', 'Service Updated Successfully');;
	}

	//get used coupon data
	public function Used_Coupon_Data(Request $request)
	{
		$cpn_no = $request->coupon_no;

		$used_cpn_data = DB::table('tbl_jobcard_details')->where('coupan_no', $cpn_no)->first();
		$status = $used_cpn_data->done_status;
		$jb_no = $used_cpn_data->jocard_no;

		$vhi_no = DB::table('tbl_services')->where('job_no', $cpn_no)->first();
		$vehi_name = $vhi_no->vehicle_id;
		$regi = DB::table('tbl_sales')->where('vehicle_id', $vehi_name)->first();
		$ser_tab = DB::table('tbl_services')->where('job_no', $jb_no)->first();
		$logo = DB::table('tbl_settings')->first();

		if (!empty($used_cpn_data)) {
			$service_id = $used_cpn_data->service_id;
			$cus_id = $used_cpn_data->customer_id;
			$custo_info = DB::table('users')->where('id', $cus_id)->first();
			$mob = $custo_info->mobile_no;
			$city = $custo_info->city_id;
			$state = $custo_info->state_id;
			$country = $custo_info->country_id;

			$all_data = DB::table('tbl_service_pros')->where([['service_id', $service_id], ['type', '=', 0]])->get()->toArray();
			$all_data2 = DB::table('tbl_service_pros')->where([['service_id', $service_id], ['type', '=', 1]])->get()->toArray();
		}

		$html = view('service.couponmodel')->with(compact('service_id', 'custo_info', 'logo', 'mob', 'custo_info', 'status', 'vehi_name', 'regi', 'city', 'state', 'country', 'all_data', 'all_data2', 'used_cpn_data', 'vhi_no', 'ser_tab', 'cpn_no'))->render();
		return response()->json(['success' => true, 'html' => $html]);
	}

	//service modal view
	public function serviceview(Request $request)
	{
		$ser_id = $request->servicesid;
		$vhi_no = Service::where('id', $ser_id)->first();
		$vehi_name = $vhi_no->vehicle_id;
		$cus_id = $vhi_no->customer_id;

		$tbl_sales = Sale::where('vehicle_id', $vehi_name)->first();
		if (!empty($tbl_sales)) {
			$regi = Sale::where('vehicle_id', $vehi_name)->first();
		} else {
			$regi = Vehicle::where('id', $vehi_name)->first();
		}

		$logo = Setting::first();
		$custo_info = User::where('id', $cus_id)->first();

		$used_cpn_data = JobcardDetail::where('service_id', $ser_id)->first();

		$service_id = $status = $all_data = $all_data2 = null;
		if (!empty($used_cpn_data)) {
			$status = $used_cpn_data->done_status;
			$service_id = $used_cpn_data->service_id;

			$all_data = DB::table('tbl_service_pros')->where([['service_id', $service_id], ['type', '=', 0]])->get()->toArray();
			$all_data2 = DB::table('tbl_service_pros')->where([['service_id', $service_id], ['type', '=', 1]])->get()->toArray();
		}

		//For Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes']])->get()->toArray();

		$washbay_data = Washbay::where('service_id', '=', $ser_id)->first();

		$html = view('service.servicemodel')->with(compact('service_id', 'custo_info', 'logo', 'custo_info', 'status', 'vehi_name', 'regi', 'all_data', 'all_data2', 'used_cpn_data', 'vhi_no', 'tbl_custom_fields', 'washbay_data'))->render();

		return response()->json(['success' => true, 'html' => $html]);
	}

	/*For get customer name by auto searchable select box*/
	public function get_customer_name(Request $request)
	{
		$customer_name = [];

		if ($request->has('q')) {
			$search = $request->q;
			$customer_name = User::select("id", "name")
				->where('role', '=', 'Customer')
				->where('name', 'LIKE', "%$search%")
				->get();
		}

		return response()->json($customer_name);
	}

	public function free_service(Request $request)
	{
		$vehi_id = $request->vehi_id;
		$cust_id = $request->customer_id;
		$free_coupan = DB::table('tbl_services')->where([['customer_id', '=', $cust_id], ['service_type', '=', 'free'], ['vehicle_id', '=', $vehi_id], ['job_no', 'like', 'C%']])->get()->toArray();
		// dd($free_coupan);

		$coupan = [];

		foreach ($free_coupan as $coupon) {
			$usedData = getUsedCoupon($coupon->customer_id, $coupon->vehicle_id, $coupon->job_no);
			if (!$usedData) {
				// Coupon is unused, store it in the $coupan array
				$coupan[] = $coupon;
			}
		}
		// dd($coupan);
		return response()->json($coupan);
	}
	//get images
	public function getImages(Request $request)
	{
		//$image_id = Input::get('image_id');
		$image_id = $request->image_id;
		$idi = $image_id + 1;
	?>
		<tr id="image_id_<?php echo $idi; ?>">
			<td>
				<input type="file" id="tax_<?php echo $idi; ?>" name="image[]" class="form-control dropify tax" data-max-file-size="5M">
				<div class="dropify-preview">
					<span class="dropify-render"></span>
					<div class="dropify-infos">
						<div class="dropify-infos-inner">
							<p class="dropify-filename">
								<span class="file-icon"></span>
								<span class="dropify-filename-inner"></span>
							</p>
						</div>
					</div>
				</div>
			</td>
			<td>
				<span class="trash_accounts" data-id="<?php echo $idi; ?>"><i class="fa fa-trash"></i> Delete</span>
			</td>
		</tr>
		<script>
			$(document).ready(function() {
				// Basic
				$('.dropify').dropify();

				// Translated
				$('.dropify-fr').dropify({
					messages: {
						default: 'Glissez-déposez un fichier ici ou cliquez',
						replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
						remove: 'Supprimer',
						error: 'Désolé, le fichier trop volumineux'
					}
				});

				// Used events
				var drEvent = $('#input-file-events').dropify();

				drEvent.on('dropify.beforeClear', function(event, element) {
					return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
				});

				drEvent.on('dropify.afterClear', function(event, element) {
					alert('File deleted');
				});

				drEvent.on('dropify.errors', function(event, element) {
					console.log('Has Errors');
				});

				var drDestroy = $('#input-file-to-destroy').dropify();
				drDestroy = drDestroy.data('dropify')
				$('#toggleDropify').on('click', function(e) {
					e.preventDefault();
					if (drDestroy.isDropified()) {
						drDestroy.destroy();
					} else {
						drDestroy.init();
					}
				})
			});
		</script>
<?php
	}

	//delete images
	public function deleteImages(Request $request)
	{
		//$id=Input::get('delete_image');
		$id = $request->delete_image;
		$image = DB::table('tbl_service_images')->where('id', '=', $id)->delete();
	}

	public function view($id)
	{
		$vehical = DB::table('tbl_vehicles')->where('soft_delete', '=', 0)->get()->toArray();
		$service = DB::table('tbl_services')->where('id', '=', $id)->first();
		$job_card_data = JobcardDetail::where('service_id', $id)->first();
		$cus_id = $service->customer_id;
		$customer = DB::table('users')->where([['id', '=', $cus_id], ['soft_delete', 0]])->first();
		$vah_id = $service->vehicle_id;
		$tbl_sales = DB::table('tbl_sales')->where('vehicle_id', $vah_id)->first();
		$images1 = DB::table('tbl_service_images')->where('service_id', '=', $id)->get()->toArray();

		if (!empty($tbl_sales)) {
			$regi = DB::table('tbl_sales')->where('customer_id', $cus_id)->first();
		} else {
			$regi = DB::table('tbl_vehicles')->where('id', $vah_id)->first();
		}

		if (!empty($regi)) {
			$regi_no = $regi->registration_no;
		} else {
			$regi_no = null;
		}

		$washbay_data = Washbay::where('service_id', '=', $id)->first();
		$washbayPrice = null;
		if (!empty($washbay_data)) {
			$washbayPrice = $washbay_data->price;
		}

		//Custom Field Data
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'service'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$currentUser = User::where([['soft_delete', 0], ['id', '=', Auth::User()->id]])->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', '=', 1)->first();
		if (isAdmin(Auth::User()->role_id)) {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $adminCurrentBranch->branch_id]])->get()->toArray();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0]])->get()->toArray();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role', 'employee'], ['soft_delete', 0], ['branch_id', $currentUser->branch_id]])->get()->toArray();
		}

		$repairCategoryList = DB::table('table_repair_category')->where([['soft_delete', "=", 0]])->get()->toArray();


		$image = DB::table('tbl_service_images')->where('service_id', '=', $id)->get()->toArray();
		if (!empty($image)) {
			foreach ($image as $images) {
				$image_name[] = URL::to('/public/service/' . $images->image);
			}
		} else {
			$image_name[] = URL::to('/public/vehicle/avtar.png');
		}
		$available = json_encode($image_name);

		$available1 = json_decode($available, true);
		$washbay_data = Washbay::where('service_id', '=', $id)->first();
		$all_data = DB::table('tbl_service_pros')->where([['service_id', $id], ['type', '=', 0]])->get()->toArray();
		$all_data2 = DB::table('tbl_service_pros')->where([['service_id', $id], ['type', '=', 1]])->get()->toArray();
		
		return view('/service/view', compact('service', 'vehical', 'employee', 'customer', 'regi_no', 'tbl_custom_fields', 'washbayPrice', 'branchDatas', 'repairCategoryList', 'available1', 'job_card_data', 'washbay_data', 'all_data', 'all_data2'));	
	}
}
