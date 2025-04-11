@extends('layouts.app')

@section('main')
    <section class="section-3 bg-2 py-5">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="">Latest</option>
                            <option value="">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="" name="searchForm" id="searchForm">
                    <div class="card border-0 p-4 shadow">
                        <div class="mb-4">
                            <h2>Keywords</h2>
                            <input type="text" name="keyword" id="keyword" placeholder="Keywords" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                            <input type="text" name="location" id="location" placeholder="Location" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Category</h2>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-4">
                            <h2>Job Type</h2>
                            @if ($jobTypes->isNotEmpty())
                                @foreach ($jobTypes as $jobType)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" name="job_type" type="checkbox"
                                            value="{{ $jobType->id }}" id="{{ $jobType->id }}">
                                        <label class="form-check-label"
                                            for="{{ $jobType->id }}">{{ $jobType->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <h2>Experience</h2>
                            <select name="experience" id="experience" class="form-control">
                                <option value="">Select Experience</option>
                                <option value="">1 Year</option>
                                <option value="">2 Years</option>
                                <option value="">3 Years</option>
                                <option value="">4 Years</option>
                                <option value="">5 Years</option>
                                <option value="">6 Years</option>
                                <option value="">7 Years</option>
                                <option value="">8 Years</option>
                                <option value="">9 Years</option>
                                <option value="">10 Years</option>
                                <option value="">10+ Years</option>
                            </select>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                             @if ($jobs->isNotEmpty())
                             @foreach ($jobs as $job)
                                    <div class="col-md-4">
                                    <div class="card mb-4 border-0 p-3 shadow">
                                        <div class="card-body">
                                            <h3 class="fs-5 mb-0 border-0 pb-2">{{ $job->title }}</h3>
                                            <p>{{ Str::words($job->description, $words=10, '.....') }}</p>
                                            <div class="bg-light border p-3">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $job->location }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $job->jobType->name }}</span>
                                                </p>
                                                @if (!is_null($job->salary))
                                                 <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{ $job->salary }}</span>
                                                </p>   
                                                @endif
                                                
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             @endforeach

                               @else  
                               <div class="col-md-12">Jobs Not Found</div>
                             @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
@endsection
