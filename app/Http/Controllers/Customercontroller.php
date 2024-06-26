<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\tbl_vehicle_discription_records;
use App\tbl_vehicle_images;
use App\tbl_vehicle_colors;
use App\Branch;
use App\Income;
use App\Invoice;
use App\Service;
use App\Vehicle;
use Carbon\Carbon;
use App\CustomField;
use App\BranchSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CustomerAddEditFormRequest;
use App\Role_user;

class Customercontroller extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	
	public function getFilteredModelNames(Request $request)
	{
		$brand_id = $request->input('brand_id');  // Get the brand ID from the request
		$vehicleType_id = $request->input('vehicleType_id');  // Get the vehicle type ID from the request
	
		$model_names = DB::table('tbl_model_names')
			->join('tbl_vehicle_brands', 'tbl_vehicle_brands.id', '=', 'tbl_model_names.brand_id')
			->join('tbl_vehicle_types', 'tbl_vehicle_types.id', '=', 'tbl_model_names.vehicleType_id')
			->where('tbl_model_names.brand_id', $brand_id)
			->where('tbl_model_names.vehicleType_id', $vehicleType_id)
			->select('tbl_model_names.model_name')
			->get();
	
		return response()->json(['model_names' => $model_names]);
	}

	public function getAnotherVehicle(Request $request)
{
    $row_id = $request->input('row_id');
    $country = DB::table('tbl_countries')->get()->toArray();
		$onlycustomer = DB::table('users')->where([['role', '=', 'Customer'], ['id', '=', Auth::User()->id]])->first();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		// dd($vehical_type);
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
		$fuel_type = DB::table('tbl_fuel_types')->where('soft_delete', '=', 0)->get()->toArray();
		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get()->toArray();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'vehicle'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

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

		$customer = DB::table('users')->where([['role', 'Customer'], ['soft_delete', 0]])->get()->toArray();
		
    	$html = view('customer.vehicle_form', compact('row_id', 'country', 'onlycustomer', 'tbl_custom_fields','customer', 'vehical_type', 'vehical_brand', 'fuel_type', 'color', 'model_name', 'tbl_custom_fields', 'branchDatas'))->render();

    return response()->json(['html' => $html]);
}

	// In CustomerController.php
	public function searchByName(Request $request) {
		$query = $request->search;
		$nida = $request->nida;
		$Customername = $request->Customername;
		$rogue_id = $request->rogue_id;
		
	
		if ($nida) {
			$customer = DB::table('users')->where('role', 'Customer')->where('nida_no', '=', $nida)->latest()->first();
			$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();
			foreach ($vehicles as $vehicle) {
				$lastService = Service::where([['vehicle_id', $vehicle->id], ['sales_id', '=', null]])->orderBy('service_date', 'desc')->first();
				$vehicle->lastServiceDate = $lastService ? Carbon::parse($lastService->service_date) : null;
			}
			$tbl_vehicles = Vehicle::where('customer_id', '=', $customer->id)->where('soft_delete', '=', 0)->orderBy('created_at', 'desc')->take(3)->get();

		} elseif ($Customername) {
			$customer = DB::table('users')->where('role', 'Customer')->where('id', '=', $Customername)->first();
			$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();
			foreach ($vehicles as $vehicle) {
				$lastService = Service::where([['vehicle_id', $vehicle->id], ['sales_id', '=', null]])->orderBy('service_date', 'desc')->first();
				$vehicle->lastServiceDate = $lastService ? Carbon::parse($lastService->service_date) : null;
			}
			$tbl_vehicles = Vehicle::where('customer_id', '=', $customer->id)->where('soft_delete', '=', 0)->orderBy('created_at', 'desc')->take(3)->get();

		} elseif ($rogue_id) {
			// Add your logic here for rogue_id
			$customer = DB::table('users')->where('role', 'Customer')->where('ifs_code', '=', $rogue_id)->latest()->first();
			$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();
			foreach ($vehicles as $vehicle) {
				$lastService = Service::where([['vehicle_id', $vehicle->id], ['sales_id', '=', null]])->orderBy('service_date', 'desc')->first();
				$vehicle->lastServiceDate = $lastService ? Carbon::parse($lastService->service_date) : null;
			}
			$tbl_vehicles = Vehicle::where('customer_id', '=', $customer->id)->where('soft_delete', '=', 0)->orderBy('created_at', 'desc')->take(3)->get();


		} else {
			$customer = DB::table('users')->where('role', 'Customer')->where('email', '=', $query)->latest()->first();
			$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();
			foreach ($vehicles as $vehicle) {
				$lastService = Service::where([['vehicle_id', $vehicle->id], ['sales_id', '=', null]])->orderBy('service_date', 'desc')->first();
				$vehicle->lastServiceDate = $lastService ? Carbon::parse($lastService->service_date) : null;
			}
			$tbl_vehicles = Vehicle::where('customer_id', '=', $customer->id)->where('soft_delete', '=', 0)->orderBy('created_at', 'desc')->take(3)->get();


		}
	
		// Fetch common data
		$vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get();
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get();
		$fuel_type = DB::table('tbl_fuel_types')->where('soft_delete', '=', 0)->get();
		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get();
		$model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get();
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([
			['form_name', '=', 'vehicle'], 
			['always_visable', '=', 'yes'], 
			['soft_delete', '=', 0]
		])->get();
		
		$currentUser = User::where('soft_delete', 0)->where('id', Auth::User()->id)->orderBy('id', 'DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id', 1)->first();
	
		if (Auth::User()->role_id === 1) {
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		} elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
		} elseif (Auth::User()->role_id === 6) {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		} else {
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}
	

		return view('customer.search_results', compact('customer', 'vehical_type', 'vehical_brand', 'fuel_type', 'color', 'model_name', 'tbl_custom_fields', 'branchDatas', 'tbl_vehicles','vehicles'));

	}
	


	//customer addform
	public function customer_vehicle()
	{
		$country = DB::table('tbl_countries')->get()->toArray();
		$onlycustomer = DB::table('users')->where([['role', '=', 'Customer'], ['id', '=', Auth::User()->id]])->first();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

		$vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
		// dd($vehical_type);
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
		$fuel_type = DB::table('tbl_fuel_types')->where('soft_delete', '=', 0)->get()->toArray();
		$color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
		$model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get()->toArray();

		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'vehicle'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

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

		$customer = DB::table('users')->where([['role', 'Customer'], ['soft_delete', 0]])->get()->toArray();
		

		return view('customer.customer_vehicle', compact('country', 'onlycustomer', 'tbl_custom_fields','customer', 'vehical_type', 'vehical_brand', 'fuel_type', 'color', 'model_name', 'tbl_custom_fields', 'branchDatas'));
	}


	//customer store
	public function storecustomer(CustomerAddEditFormRequest $request)
	{
	
		$customerType = $request->customer_type;

		$vehicla = $request->input('vehicles');
        $branchData = $vehicla[0]['branch'];

		if ($customerType === 'individual') {
			$firstname = $request->firstname;
			$password = $request->password;
			$tin_no = $request->tin_no;
			$nida_no= $request->nida_no;
			$password = $request->password;
			$gender = $request->gender;
			$birthdate = $request->dob;
			$email = $request->email;
			$mobile = $request->mobile;

			$address = $request->customer_address;
			$country_id = $request->country_id;
			$state_id = $request->state_id;
			$city = $request->city;
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
			$customer->gender = $gender;
			$customer->birth_date = $dob;
			$customer->email = $email;
			$customer->password = bcrypt($password);
			$customer->mobile_no = $mobile;

			$customer->address = $request->customer_address;
			$customer->country_id = $country_id;
			$customer->state_id = $state_id;
			$customer->city_id = $city;
			$customer->tin_no = $tin_no;
			$customer->nida_no = $nida_no;

			$customer->branch_id = $branchData;
			$customer->create_by = Auth::User()->id;

			if (!empty($request->driving)) {
				$file = $request->driving;
				$filename = $file->getClientOriginalName();
				$file->move(public_path() . '/customer/', $file->getClientOriginalName());
				$customer->driving = $filename;
			} else {
				$customer->Driving = 'drive.png';
			}

			if (!empty($request->nida)) {
				$file = $request->nida;
				$filename = $file->getClientOriginalName();
				$file->move(public_path() . '/customer/', $file->getClientOriginalName());
				$customer->nida = $filename;
			} else {
				$customer->nida = 'NIDA.jpg';
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
			// Save vehicle information
			$vehicles = $request->input('vehicles');
			foreach ($vehicles as $vehicleData) {
				$vehicle = new Vehicle;
				$vehicle->vehicletype_id = $vehicleData['vehical_id'];
				$vehicle->number_plate = $vehicleData['number_plate'];
				$vehicle->vehiclebrand_id = $vehicleData['vehicabrand'];
				$vehicle->modelyear = $vehicleData['model_year'];
				$vehicle->fuel_id = $vehicleData['fueltype'];
				$vehicle->modelname = $vehicleData['modelname'];
				$vehicle->chassisno = $vehicleData['chassis_no'];
				$vehicle->engineno = $vehicleData['engine_no'];
				$vehicle->branch_id = $vehicleData['branch'];
				$vehicle->color = $vehicleData['color'];
				$vehicle->customer_id = $customer->id; // Assign customer ID to the vehicle
	
				$vehicle->save();
	
				// Retrieve the last inserted vehicle to get its ID
				$lastVehicle = DB::table('tbl_vehicles')->orderBy('id', 'desc')->first();
				$vehicleId = $lastVehicle->id;
	
				// Handle vehicle images
				$vehicleImages = $request->file('vehicle_images');
				if (!empty($vehicleImages)) {
					foreach ($vehicleImages as $image) {
						$filename = $image->getClientOriginalName();
						$image->move(public_path() . '/vehicle/', $filename);
	
						$vehicleImage = new tbl_vehicle_images;
						$vehicleImage->vehicle_id = $vehicleId;
						$vehicleImage->image = $filename;
						$vehicleImage->save();
					}
				}
			}
			return redirect('/customer/list')->with('message', 'Customer Submitted Successfully');
		
		}
		elseif ($customerType === 'corporate') {
			// dd($request->all());

			$vehicla = $request->input('vehicles');
        	$branchData = $vehicla[0]['branch'];
			$firstname = $request->firstname;
			$person = $request->person;
			$password = $request->password;
			$password = $request->password;
			$email = $request->email;
			$mobile = $request->mobile;
			$nida_no= $request->nida_no;
			$tin_no = $request->tin_no;

			$address = $request->customer_address;

			$country_id = $request->country_id;
			$state_id = $request->state_id;
			$city = $request->city;

			//Get user role id from Role table
			$getRoleId = Role::where('role_name', '=', 'Customer')->first();

			$customer = new User;

			$customer->name = $firstname;
			$customer->email = $email;
			$customer->password = bcrypt($password);
			$customer->mobile_no = $mobile;
			$customer->address = $request->customer_address;
			$customer->country_id = $country_id;
			$customer->state_id = $state_id;
			$customer->city_id = $city;
			$customer->tin_no = $tin_no;
			$customer->nida_no = $nida_no;

			$customer->branch_id = $branchData;
			$customer->create_by = Auth::User()->id;
			$customer->contact_person = $person;

			// Handle file uploads for corporate customers
			
			if (!empty($request->tin_certificate)) {
				$file = $request->tin_certificate;
				$filename = $file->getClientOriginalName();
				$file->move(public_path() . '/customer/', $file->getClientOriginalName());
				$customer->tin_certificate = $filename;
			}
			
			if (!empty($request->incorporation)) {
				$file = $request->incorporation;
				$filename = $file->getClientOriginalName();
				$file->move(public_path() . '/customer/', $file->getClientOriginalName());
				$customer->certificate_of_incorporation = $filename;
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
		// Save vehicle information
		$vehicles = $request->input('vehicles');
		foreach ($vehicles as $vehicleData) {
			$vehicle = new Vehicle;
			$vehicle->vehicletype_id = $vehicleData['vehical_id'];
			$vehicle->number_plate = $vehicleData['number_plate'];
			$vehicle->vehiclebrand_id = $vehicleData['vehicabrand'];
			$vehicle->modelyear = $vehicleData['model_year'];
			$vehicle->fuel_id = $vehicleData['fueltype'];
			$vehicle->modelname = $vehicleData['modelname'];
			$vehicle->chassisno = $vehicleData['chassis_no'];
			$vehicle->engineno = $vehicleData['engine_no'];
			$vehicle->branch_id = $vehicleData['branch'];
			$vehicle->color = $vehicleData['color'];
			$vehicle->customer_id = $customer->id; // Assign customer ID to the vehicle

			$vehicle->save();

			// Retrieve the last inserted vehicle to get its ID
			$lastVehicle = DB::table('tbl_vehicles')->orderBy('id', 'desc')->first();
			$vehicleId = $lastVehicle->id;

			// Handle vehicle images
			$vehicleImages = $request->file('vehicle_images');
			if (!empty($vehicleImages)) {
				foreach ($vehicleImages as $image) {
					$filename = $image->getClientOriginalName();
					$image->move(public_path() . '/vehicle/', $filename);

					$vehicleImage = new tbl_vehicle_images;
					$vehicleImage->vehicle_id = $vehicleId;
					$vehicleImage->image = $filename;
					$vehicleImage->save();
				}
			}
		}
		return redirect('/customer/list')->with('message', 'Customer Submitted Successfully');
	
	}
		
	}

			//customer list
	public function index()
	{

		if (Auth::user()->role_id === 1) {
			$customer = User::where([['role', '=', 'Customer'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();
		} elseif (Auth::user()->role_id === 6) {

			$customer = User::where('branch_id', '=', 2)->where([['role', '=', 'Customer'], ['soft_delete', 0]])->orderBy('id', 'DESC')->get();

		}else {
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
		}

		return view('customer.list', compact('customer'));
	}


	//customer show
	public function customershow($id)
	{
		$viewid = $id;
		$userid = Auth::User()->id;
		$tbl_vehicles = Vehicle::where('customer_id', '=', $viewid)->where('soft_delete', '=', 0)->orderBy('created_at', 'desc')->take(3)->get();

		$jobCards = Service::orderBy('id', 'desc')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['customer_id', '=', $viewid]])->whereNotIn('quotation_modify_status', [1])->take(3)->get();

		$quotations = DB::table('tbl_services')->where([['customer_id', '=', $viewid], ['job_no', 'like', 'RMAL-RP-24-%'], ['is_quotation', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->take(3)->get();
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
					$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();

					$country = DB::table('tbl_countries')->get()->toArray();
					$state = DB::table('tbl_states')->where('country_id', $customer->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $customer->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

					return view('customer.update', compact('country', 'customer', 'state', 'city', 'editid', 'tbl_custom_fields'));
				} else if (Gate::allows('customer_edit')) {
					//dd(Gate::allows('customer_edit'), 2);
					$customer = DB::table('users')->where('id', '=', $id)->first();
             		$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();
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
				$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();
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
			$vehicles = Vehicle::where([['soft_delete', '=', 0], ['customer_id', '=', $customer->id]])->orderBy('id', 'DESC')->get();

			$country = DB::table('tbl_countries')->get()->toArray();
			$state = DB::table('tbl_states')->where('country_id', $customer->country_id)->get()->toArray();
			$city = DB::table('tbl_cities')->where('state_id', $customer->state_id)->get()->toArray();

			$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name', '=', 'customer'], ['always_visable', '=', 'yes'], ['soft_delete', '=', 0]])->get()->toArray();

			return view('customer.update', compact('vehicles','country', 'customer', 'state', 'city', 'editid', 'tbl_custom_fields'));
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
		$gender = $request->gender;
		$password = $request->password;
		$mobile = $request->mobile;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;
		$updated_email = $request->email;
		$updated_dob = $request->dob;


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
		$customer->gender = $gender;
		$customer->birth_date = $dob;
		$customer->email = $updated_email;

		if (!empty($password)) {
			$customer->password = bcrypt($password);
		}

		$customer->mobile_no = $mobile;
		$customer->address = $address;
		$customer->country_id = $country;
		$customer->state_id = $state;
		$customer->city_id = $city;

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
		$services = Service::orderBy('id', 'desc')->where([['soft_delete', '=', 0], ['job_no', 'like', 'RMAL-RP-24-%'], ['customer_id', '=', $id]])->whereNotIn('quotation_modify_status', [1])->get();

		return view('customer.customerjobcards', compact('customer', 'services'));
	}
	public function customersquotation($id)
	{
		$customer = User::where('id', '=', $id)->first();
		$service = DB::table('tbl_services')->where([['job_no', 'like', 'RMAL-RP-24-%'], ['customer_id', '=', $id], ['is_quotation', '=', 1], ['soft_delete', '=', 0]])->orderBy('id', 'DESC')->get();
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

	public function getModels($makeId, $bodyTypeId)
{
    // Fetch models based on makeId and bodyTypeId
    $models = DB::table('tbl_model_names')->where('brand_id', $makeId)
        ->where('vehicleType_id', $bodyTypeId)
        ->pluck('model_name', 'id');

    // Return the models as JSON response
    return response()->json(['models' => $models]);
}
}
