<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'email' => 'required|email',
            // 'password' => 'required|confirmed',
            'password' => 'required|same:confirm_password|min:3',
            'confirm_password' => 'required'

        ]);

        // if ($validator->passes()) {
        // } else {
        //     return   response()->json([
        //         'status' => false,
        //         'errors' => $validator->errors(),
        //     ]);
        // }
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Ab yahan tum user create kar sakti ho ya sirf success message bhejo
        return response()->json([
            'status' => true,
            'message' => 'Registration successful!'
        ]);
    }
    
    function login() {}
}
