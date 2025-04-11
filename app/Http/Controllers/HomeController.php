<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $categories =  Category::where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
        return view('home', compact('categories'));
    }


    function contact()
    {
        return view('contact');
    }
}
