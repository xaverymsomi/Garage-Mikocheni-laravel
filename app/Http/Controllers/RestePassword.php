<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use DB;
use Mail;

class RestePassword extends Controller
{ 
    //password reset link
	public function forgotpassword(Request $request)
	{
		$token = "s5qvke7CVoSkN1RdVjzB3SaHntzB3Vd68ZHSwBKU";
		$email = $request->email;
		$user = DB::table('users')->where('email', '=', $email)->first();

		if ($user != '') {
			$name = $user->name;
			$pass = $user->password;

			$actual_link = $_SERVER['HTTP_HOST'];
			$startip = '0.0.0.0';
			$endip = '255.255.255.255';
			$link = url('passwords/reset/' . $token . '/' . $email);
			$email_content = "To Reset Your Password Please Click..." . $link;
			$mail_sub = "Reset Password";
			$mail_send_from = "cakephp.projects@gmail.com";
			$data = array(
				'email' => $email,
				'password' => $pass,
				'name' => $name,
				'token' => $token
			);
			
			if (($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <= $endip)) {
				
				Mail::send('home', $data, function ($message) use ($data) {
					$message->from('cakephp.projects@gmail.com', 'Reset Password');
					$message->to($data['email'])->subject("Reset Password");
				});
			} else {
				//Live format email
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
				$headers .= 'From:' . $mail_send_from . "\r\n";

				$data = mail($email, $mail_sub, $email_content, $headers);
			}

            $response = [
                'status' => true,
                'code' => 200,
                'message' => 'Link for password reset has been emailed to you. Please check your email.',
                'data' => null
            ];

            return Response::json($response, 200);

			// return redirect('/password/reset')->with('message', 'Your password reset link has been sent to your email address !');

		} else {

            $response = [
                'status' => true,
                'code' => 401,
                'message' => 'Please enter valid Email',
                'data' => null
            ];

            return Response::json($response, 401);

			// return redirect('/password/reset')->with('message', 'Email Address you have entered is not match with our records !');
		}
	}
}
 