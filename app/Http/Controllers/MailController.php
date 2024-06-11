<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailNotification;

class Mailcontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//mail form
	public function index()
	{
		$mailformat = MailNotification::get();

		return view('mail.mail', compact('mailformat'));
	}

	//mail update
	public function emailupadte($id, Request $request)
	{
		$emailformat = MailNotification::find($id);

		$emailformat->subject = $request->subject;
		$emailformat->send_from = $request->send_from;
		$emailformat->notification_text = $request->notification_text;
		$emailformat->is_send = $request->is_send;
		$emailformat->save();

		return redirect('/mail/mail')->with('message', 'Email Template Updated Successfully');
	}

	//mail for user
	public function user()
	{
		return view('mail.user');
	}

	//mail for sales
	public function sales()
	{
		return view('mail.sales');
	}

	//mail for service
	public function services()
	{
		return view('mail.service');
	}

	//mail setting
	public function setting()
	{
		$file = base_path('.env');
		$content = file_get_contents($file);

		$configKeys = [
			'MAIL_DRIVER',
			'MAIL_HOST',
			'MAIL_PORT',
			'MAIL_USERNAME',
			'MAIL_PASSWORD',
			'MAIL_ENCRYPTION',
		];

		$configData = [];

		foreach ($configKeys as $key) {
			preg_match("/$key=(.*)/", $content, $matches);
			$configData[$key] = isset($matches[1]) ? $matches[1] : '';
		}

		return view('email_setting.list', compact('configData'));
	}

	public function settingStore(Request $request)
	{
		$file = base_path('.env');
		$content = file_get_contents($file);

		$configKeys = [
			'MAIL_DRIVER',
			'MAIL_HOST',
			'MAIL_PORT',
			'MAIL_USERNAME',
			'MAIL_PASSWORD',
			'MAIL_ENCRYPTION',
		];

		foreach ($configKeys as $key) {
			if ($request->has($key)) {
				$value = $request->input($key);
				$content = preg_replace("/$key=(.*)/", "$key=$value", $content);
			}
		}

		$status = file_put_contents($file, $content);

		return redirect('setting/email_setting/list')->with('message', 'Email Settings Updated Successfully');
	}
}
