<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Mail;
use Auth;
use App\User;
use App\Setting;
use Illuminate\Http\Request;

class Profilecontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//profile list
	public function index()
	{

		$profile = DB::table('users')->where('id', '=', Auth::User()->id)->first();
		$settings_data = Setting::first();

		return view('profile.list', compact('profile', 'settings_data'));
	}

	//profile update
	public function update($id, Request $request)
	{

		$usimgdtaa = DB::table('users')->where('id', '=', $id)->first();
		$email = $usimgdtaa->email;

		if ($email != $request->email) {
			$this->validate($request, [
				// 'email' => 'required|email|unique:users',
				'email' => 'required|email|custom_email|unique:users'
			]);
		}

		$firstname = $request->firstname;

		$gender = $request->gender;
		$dd = $request->dob;
		if (!empty($dd)) {
			if (getDateFormat() == 'm-d-Y') {
				$dob = date('Y-m-d', strtotime(str_replace('-', '/', $request->dob)));
			} else {
				$dob = date('Y-m-d', strtotime($request->dob));
			}
		} else {
			$dob = "";
		}
		$email = $request->email;
		$password = ($request->password);
		$mobile = $request->mobile;

		$profile = User::find($id);
		$profile->name = $firstname;
		$profile->gender = $gender;
		$profile->birth_date = $dob;
		$profile->email = $email;

		if (!empty($password)) {
			$profile->password = bcrypt($password);
		}

		$image = $request->image;
		$profile->mobile_no = $mobile;
		if (!empty($image)) {
			$file = $image;
			$filename = $file->getClientOriginalName();

			if ($usimgdtaa->role == "admin") {
				$file->move(public_path() . '/admin/', $file->getClientOriginalName());
			} elseif ($usimgdtaa->role == "Customer") {
				$file->move(public_path() . '/customer/', $file->getClientOriginalName());
			} elseif ($usimgdtaa->role == "employee") {
				$file->move(public_path() . '/employee/', $file->getClientOriginalName());
			} elseif ($usimgdtaa->role == "supportstaff") {
				$file->move(public_path() . '/supportstaff/', $file->getClientOriginalName());
			} elseif ($usimgdtaa->role == "accountant") {
				$file->move(public_path() . '/accountant/', $file->getClientOriginalName());
			} elseif ($usimgdtaa->role == "branch_admin") {
				$file->move(public_path() . '/branch_admin/', $file->getClientOriginalName());
			}
			$profile->image = $filename;
		}

		$profile->save();
		$logo = DB::table('tbl_settings')->first();
		$systemname = $logo->system_name;
		return redirect('/setting/profile')->with('message', 'Successfully Updated');
	}
}
