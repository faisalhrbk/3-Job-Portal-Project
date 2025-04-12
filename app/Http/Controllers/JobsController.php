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
        $validated = $request->validate([
            'keyword' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:100',
            'category' => 'nullable|exists:categories,id',
            'jobType' => 'nullable',
            'experience' => 'nullable|string',
            'sort' => 'nullable|in:latest,oldest'
        ]);

        $query = Job::Active()
            ->with(['jobType', 'category'])
            ->when($validated['keyword'] ?? null, function ($q, $keyword) {
                $q->keywordSearch($keyword);
            })
            ->when($validated['location'] ?? null, function ($q, $location) {
                $q->where('location', $location);
            })
            ->when($validated['category'] ?? null, function ($q, $category) {
                $q->where('category_id', $category);
            })
            ->when(!empty($validated['jobType']), function ($q) use ($validated) {
                $jobTypes = is_array($validated['jobType'])
                    ? $validated['jobType']
                    : explode(',', $validated['jobType']);
                $q->whereIn('job_type_id', array_filter($jobTypes, 'is_numeric'));
            })
            ->when($validated['experience'] ?? null, function ($q, $exp) {
                $q->where('experience', $exp);
            })
            ->orderBy('created_at', ($validated['sort'] ?? 'latest') == 'oldest' ? 'ASC' : 'DESC');

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
    
        return view('jobDetail', compact('job'));
    }
}
