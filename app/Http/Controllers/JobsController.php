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
        // search using location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location', $request->location);
        }
        // search using category
        if (!empty($request->category)) {
            $jobs = $jobs->where('category_id', $request->category);
        }
        //search using jobType
        $jobTypeArray = [];
        if (!empty($request->jobType)) {
            $jobTypeArray = explode(',', $request->jobType);
            $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
        }
        //exp
        if (!empty($request->experience)) {
            $jobs = $jobs->where('experience', $request->experience);
        }
        //for dat query



        $jobs = $jobs->with(['jobType', 'category']);

        //for sorting jobs by date
        $jobs = $jobs->orderBy(
            'created_at',
            $request->sort == 'oldest' ? 'ASC' : 'DESC'
        );
        $jobs = $jobs->paginate(9)->onEachSide(1);

        return view('jobs', compact('categories', 'jobTypes', 'jobs', 'jobTypeArray'));
    }
}
