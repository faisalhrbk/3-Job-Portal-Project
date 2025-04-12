<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $categories =  Category::where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
        $newCategories =  Category::where('status', 1)->orderBy('name', 'ASC')->get();
        $featuredJobs = Job::where('status', 1)->where('isFeatured', 1)->with('jobType')->orderBy('created_at', 'DESC')->take(6)->get();
        $latestJobs = Job::where('status', 1)->orderBy('created_at', 'DESC')->with('jobType')->take(6)->get();
        return view('home', compact('categories', 'featuredJobs', 'latestJobs', 'newCategories'));
    }


    function contact()
    {
        return view('contact');
    }
}
