<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobType;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;


class AccountController extends Controller
{

    function register()
    {
        return view('account.register');
    }


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

            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->route('account.profile');
            } else {
                return redirect()->back()->with('error', 'Either Email/password is incorrect');
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
        }
    }


    function profile()
    {
        $userId = Auth::user()->id;
        $user = User::findorfail($userId);
        return view('account.profile', compact('user'));
    }


    function updateProfile(Request $request)
    {
        // dd($request);

        // ! for email uniqueness
        //todo unique:table,column,expect,id
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:20',
            'email' => 'required|email|unique:users,email,' . $userId . ',id',
        ]);

        if ($validator->passes()) {
            $user = User::find($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->mobile  = $request->mobile;
            $user->save();
            session()->flash('success', 'Profile Updated Successfully');
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    function updateProfilePic(Request $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'image' => 'required|image'
        ]);

        if ($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id . '-' . time() . '.' . $ext;
            $image->move(public_path('profile_pic'), $imageName);
            User::where('id', $id)->update(['image' => $imageName]);

            //! creating small thumbnail for profile
            $srcPath =  public_path('profile_pic/' . $imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($srcPath);
            $image->cover(150, 150);
            $image->toPng()->save(public_path('profile_pic/thumb/' . $imageName));
            session()->flash('success', 'profile picture update successfully');


            //delete old profile pic
            File::delete(public_path('profile_pic/' . Auth::user()->image));
            File::delete(public_path('profile_pic/thumb/' . Auth::user()->image));

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    function createJob()
    {
        $jobTypes = JobType::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        return view('account.job.create', compact('categories', 'jobTypes'));
    }


    function saveJob(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:10|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|min:3|max:50',
        ];
        $validator = Validator::make($request->all(), $rules);

        // dd($rules);
        if ($validator->passes()) {
            $job = new Job();
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->save();
            session()->flash('success', 'Job Added Successfully');
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }


    function myJobs()
    {
        $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->paginate(10);
        return view('account.job.myJobs', compact('jobs'));
    }


    function editJob(Request $request, $id)
    {
        $jobTypes = JobType::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id,
        ])->first();
        if ($job == null) {
            abort(404);
        }
        return view('account.job.edit', compact('categories', 'jobTypes', 'job'));
    }


    function updateJob(Request $request, $jobId)
    {
        $rules = [
            'title' => 'required|string|min:10|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|min:3|max:50',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $job = Job::findorfail($jobId);
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->user_id = Auth::user()->id;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->save();
            session()->flash('success', 'Job Added Successfully');
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }


    function deleteJob($jobId){
     
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
