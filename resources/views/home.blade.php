@extends('layouts.app')
@section('main')
    <section class="section-0 lazy d-flex bg-image-style align-items-center dark" class=""
        data-bg="{{ asset('assets/images/banner5.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <h1>Find your dream job</h1>
                    <p>Thounsands of jobs available.</p>
                    <div class="banner-btn mt-5"><a href="#" class="btn btn-primary mb-sm-0 mb-4">Explore Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1 py-5">
        <div class="container">
            <div class="card border-0 p-5 shadow">
                <form action="" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-sm-3 mb-lg-0 mb-3">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords">
                    </div>
                    <div class="col-md-3 mb-sm-3 mb-lg-0 mb-3">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                    </div>
                    <div class="col-md-3 mb-sm-3 mb-lg-0 mb-3">
                        <select name="category" id="category" class="form-select">
                            <option value="" selected disabled>Select a Category</option>
                            @if ($newCategories->isNotEmpty())
                                @foreach ($newCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>

                    <div class="col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            <a href="jobs.html" class="btn btn-primary btn-block">Search</a>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>Popular Categories</h2>

            <div class="row pt-5">
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="single_catagory">
                                <a href="jobs.html">
                                    <h4 class="pb-2">{{ $category->name }}</h4>
                                </a>
                                <p class="mb-0"> <span>0</span> Available position</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-3 py-5">
        <div class="container">
            <h2>Featured Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($featuredJobs->isNotEmpty())
                                @foreach ($featuredJobs as $featuredJob)
                                    <div class="col-md-4">
                                        <div class="card mb-4 border-0 p-3 shadow">
                                            <div class="card-body">
                                                <h3 class="fs-5 mb-0 border-0 pb-2">{{ $featuredJob->title }}</h3>
                                                <p>{{ Str::words($featuredJob->description, '4') }}</p>
                                                <div class="bg-light border p-3">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $featuredJob->location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $featuredJob->jobType->name }}</span>
                                                    </p>
                                                    @if (!is_null($featuredJob->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $featuredJob->salary }}</span>
                                                        </p>
                                                    @endif

                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('job.detail', $featuredJob->id) }}"
                                                        class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Latest Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($latestJobs->isNotEmpty())
                                @foreach ($latestJobs as $latestJob)
                                    <div class="col-md-4">
                                        <div class="card mb-4 border-0 p-3 shadow">
                                            <div class="card-body">
                                                <h3 class="fs-5 mb-0 border-0 pb-2">{{ $latestJob->title }}</h3>
                                                <p>{{ Str::words($latestJob->description, '4') }}</p>
                                                <div class="bg-light border p-3">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $latestJob->location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $latestJob->jobType->name }}</span>
                                                    </p>
                                                    @if (!is_null($latestJob->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $latestJob->salary }}</span>
                                                        </p>
                                                    @endif

                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('job.detail', $latestJob->id) }}"
                                                        class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
