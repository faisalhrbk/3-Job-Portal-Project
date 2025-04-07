<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    function register()
    {
        return view('account.register');
    }


    // this method will register user, this is ajax method
    function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'confirm_password' => 'required|same:password'
        ]);
        if ($validator->passes()) {
            $user =  $request->only(['name', 'email', 'password']);
            User::create($user);
            Session()->flash('success', 'you have registered successfully');
            return response()->json([
                'status' => true,
                'message' => 'Registration successful!'
            ]);
        }
        // if ($validator->fails())
        else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    function login()
    {
        return view('account.login');
    }
    function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);
        if ($validator->passes()) {

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                
            }
        } else {
        return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
        }
    }
}
