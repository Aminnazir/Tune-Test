<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Response;
use IlluminateSupportFacadesValidator;
use IlluminateFoundationBusDispatchesJobs;
use IlluminateFoundationValidationValidatesRequests;
use IlluminateFoundationAuthAccessAuthorizesRequests;
use IlluminateFoundationAuthAccessAuthorizesResources;
use IlluminateHtmlHtmlServiceProvider;

class LoginController extends Controller
{
    public function showLogin()
    {
        // Form View
        return view('pages.login');
    }

    public function doLogout()
    {
        Auth::logout(); // logging out user
        return Redirect::to('login'); // redirection to login screen
    }

    public function doLogin(Request $request)
    {
        // Creating Rules for Email and Password
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required');


        $validator = Validator::make($request->all() , $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails())
        {
            return Redirect::to('login')->withErrors($validator); // send back all errors to the login form
        }
        else
        {
            // create our user data for the authentication
            $userdata = array(
                'email' => $request->input('email') ,
                'password' => $request->input('password')
            );

            if ($user = User::where('email', $request->input('email'))->first())
            {
                // attempt to do the login
                if (Auth::attempt($userdata))
                {
                    return Redirect::to('home');
                }
            }

                return Redirect::to('login')->withErrors(['error' => 'Invalid login credential']);
        }
    }
}
