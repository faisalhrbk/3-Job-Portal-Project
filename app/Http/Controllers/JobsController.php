<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobType;
use App\Models\Category;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Mail\JobNotificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    function index(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:100',
            'category' => 'nullable|exists:categories,id',
            'jobType' => 'nullable',
            'experience' => 'nullable|string',
            'sort' => 'nullable|in:latest,oldest'
        ]);

        $query = Job::Active()->with(['jobType', 'category'])->when($validated['keyword'] ?? null, function ($q, $keyword) {
            $q->keywordSearch($keyword);
        })->when($validated['location'] ?? null, function ($q, $location) {
            $q->where('location', $location);
        })->when($validated['category'] ?? null, function ($q, $category) {
            $q->where('category_id', $category);
        })->when(!empty($validated['jobType']), function ($q) use ($validated) {
            $jobTypes = is_array($validated['jobType'])
                ? $validated['jobType']
                : explode(',', $validated['jobType']);
            $q->whereIn('job_type_id', array_filter($jobTypes, 'is_numeric'));
        })->when($validated['experience'] ?? null, function ($q, $exp) {
            $q->where('experience', $exp);
        })->orderBy('created_at', ($validated['sort'] ?? 'latest') == 'oldest' ? 'ASC' : 'DESC');

        $jobs = $query->paginate(9)->onEachSide(1);

        return view('jobs', [
            'categories' => Category::active()->get(),
            'jobTypes' => JobType::active()->get(),
            'jobs' => $jobs,
            'jobTypeArray' => !empty($validated['jobType'])
                ? (is_array($validated['jobType'])
                    ? $validated['jobType']
                    : explode(',', $validated['jobType']))
                : []
        ]);
    }



    function detail($jobId)
    {

        $job = Job::Active($jobId)->with('jobType', 'category')->findorfail($jobId);
        $jobExists =  (SavedJob::where([
            'user_id' => Auth::id(),
            'job_id' => $jobId,
        ])->exists());
        return view('jobDetail', compact('job', 'jobExists'));
    }



    function apply(Request $request)
    {
        $job = Job::find($request->id);
        if (!$job) {
            session()->flash('error', 'Job does Not Exist');
            return response()->json([
                'success' => false,
                'message' => 'This job is no longer available'
            ], 404);
        }
        //you can not apply on your own job
        $employer_id = $job->user_id;
        if ($employer_id == Auth::user()->id) {
            session()->flash('error', 'You cant apply to your own job!');
            return response()->json([
                'status' => false,
                'message' => 'You cant apply to your own job!'
            ]);
        }
        // you can't apply on a job twice
        $alreadyApplied = JobApplication::where([
            'user_id' => Auth::user()->id,
            'job_id' => $job->id,
        ])->exists();
        if ($alreadyApplied) {
            session()->flash('error', 'Already Applied to job');
            return response()->json([
                'success' => false,
                'message' => 'Already Applied to job!'
            ]);
        }

        $application = new JobApplication();
        $application->job_id = $request->id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();

        // // send notification email to employer
        // $employer = User::where('id', $employer_id)->first();
        // $mailData = [
        //     'employer' => $employer,
        //     'user' => Auth::user(),
        //     'job' => $job,
        // ];
        // Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        session()->flash('success', 'You  have Successfully Applied to to Job!');
        return response()->json(
            [
                'status' => true,
                'message' => 'you have Successfully Applied to Job!'
            ]
        );
    }

    function saveJob(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:jobs,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        //todo Check if user already saved this job
        if (SavedJob::where([
            'user_id' => Auth::id(),
            'job_id' => $request->id,
        ])->exists()) {



            return response()->json([
                session()->flash('error', 'You already Saved This Job!'),
                'status' => false,
                'message' => 'You already saved this job!'
            ]);
        }

        //todo Save the job
        SavedJob::create([
            'user_id' => Auth::id(),
            'job_id' => $request->id
        ]);

        session()->flash('success', 'Job Saved Successfully!!');
        //todo Success response
        return response()->json([
            'status' => true,
            'message' => 'Job saved successfully!'
        ], 200);
    }
}
