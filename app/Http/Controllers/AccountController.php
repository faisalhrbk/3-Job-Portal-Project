<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    function register() {
        return view('account.register');
    }
    function login() {}
}
