<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    function index(Request $request)
    {
        $categories = Category::where('status', '1')->get();
        $jobTypes = JobType::where('status', '1')->get();

        //! Here Goes Queries
        $jobs = Job::where('status', 1);
        // search using keyword
        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function ($query) use ($request) {
                $query->orWhere('title', 'like', '%' . $request->keyword . '%');
                $query->orWhere('keyWords', 'like', '%' . $request->keyword . '%');
            });
        }
        $jobs = $jobs->with('jobType')->orderBy('created_at', 'DESC')->paginate(9);

        return view('jobs', compact('categories', 'jobTypes', 'jobs'));
    }
}
