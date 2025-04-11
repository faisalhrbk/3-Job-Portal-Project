<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    // ye jobs page dekhyega
    function index(){
return view('jobs');
    }
}
