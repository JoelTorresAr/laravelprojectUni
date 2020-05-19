<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        //Attemp to log the user in
        if(Auth::guard('admin')->attempt([
            'username'      => $request->username,
            'password'   => $request->password
        ],$request->remember)){
            // if succesful, then redirect to their intendd location
            return redirect()->intended(route('admin.dashboard'));
        }
        //if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username','remember'));
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username'    => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
