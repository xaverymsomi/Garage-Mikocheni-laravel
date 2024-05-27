		if ($customerType === 'Individual') {
			$firstname = $request->firstname;
			$password = $request->password;
			$tin_no = $request->tin_no;
			$password = $request->password;
			$gender = $request->gender;
			$birthdate = $request->dob;
			$email = $request->email;
			$mobile = $request->mobile;
			$address = $request->address;
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
			$customer->address = $address;
			$customer->country_id = $country_id;
			$customer->state_id = $state_id;
			$customer->city_id = $city;
			$customer->tin_no = $tin_no;
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
				$vehicle = new Vehicle([
					'vehicletype_id' => $vehicleData['vehical_id'],
					'number_plate' => $vehicleData['number_plate'],
					'vehiclebrand_id' => $vehicleData['vehicabrand'],
					'modelyear' => $vehicleData['model_year'],
					'fuel_id' => $vehicleData['fueltype'],
					'modelname' => $vehicleData['modelname'],
					'engineno' => $vehicleData['engine_no'],
					'branch_id' => $vehicleData['branch'],
					'chassis_no' => $vehicleData['chassis_no'],
					'color' => $vehicleData['color'],
				]);
				$customer->vehicles()->save($vehicle);
				$vehicles = DB::table('tbl_vehicles')->orderBy('id', 'desc')->first();
					$id = $vehicles->id;
				$image = $request->vehicle_images;
					if (!empty($image)) {
					$files = $image;

					foreach ($files as $file) {
						$filename = $file->getClientOriginalName();
						$file->move(public_path() . '/vehicle/', $file->getClientOriginalName());
						$images = new tbl_vehicle_images;
						$images->vehicle_id = $id;
						$images->image = $filename;
						$images->save();
					}
				}
					
			}
		}