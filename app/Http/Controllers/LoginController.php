<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {

            Auth::login($user);

            // return redirect()->route('dashboard');

            $response = [
                'status' => true,
                'code' => 200,
                'message' => 'Login Successfully',
                'data' => [
                    'Id' => $user->id,
                    'Name' => $user->name,
                    'Role' => $user->role,
                    'image' => $user->image ? url('public/admin/' . $user->image) : null,
                ]
            ];

            return Response::json($response, 200);
        }

        $response = [
            'status' => false,
            'code' => 401,
            'message' => 'Invalid credentials',
            'data' => null
        ];

        return Response::json($response, 401);

        // return redirect()->back();
    }
}
