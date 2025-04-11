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
                        <select name="sort" id="sort" class="form-select">
                            <option value="" selected disabled>Sort by Date</option>
                            <option value="latest">Latest</option>
                            <option value="oldest">Oldest</option>
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
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword" id="keyword"
                                    placeholder="Keywords" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Location</h2>
                                <input type="text" value="{{ Request::get('location') }}" name="location" id="location"
                                    placeholder="Location" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Category</h2>
                                <select name="category" id="category" class="form-select">
                                    <option value="" selected disabled>Select Category</option>
                                    @if ($categories)
                                        @foreach ($categories as $category)
                                            <option {{ Request::get('category') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                value="{{ $jobType->id }}" id="{{ $jobType->id }}"
                                                {{ in_array($jobType->id, $jobTypeArray) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="{{ $jobType->id }}">{{ $jobType->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            {{-- <div class="mb-4">
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
                            </div> --}}
                            <div class="mb-4">
                                <label for="" class="mb-2">Experience <span class="req">*</span></label>
                                @php
                                    $experiences = [
                                        1 => '1 Year',
                                        2 => '2 Years',
                                        3 => '3 Years',
                                        4 => '4 Years',
                                        5 => '5 Years',
                                        6 => '6 Years',
                                        7 => '7 Years',
                                        8 => '8 Years',
                                        9 => '9 Years',
                                        10 => '10 Years',
                                        '10_plus' => '10+ Years',
                                    ];
                                @endphp

                                <select name="experience" id="experience" class="form-select mb-3">
                                    <option value="" selected disabled>Select Experience</option>
                                    @foreach ($experiences as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ Request::get('experience') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                <p></p>
                            </div>

                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                        <div class="col">
                                            <div class="card h-100 mb-4 border-0 p-3 shadow">
                                                <div class="card-body d-flex flex-column">
                                                    <h3 class="fs-5 mb-0 border-0 pb-2">{{ $job->title }}</h3>
                                                    <p class="flex-grow-1">
                                                        {{ Str::words($job->description, $words = 10, '.....') }}</p>
                                                    <div class="bg-light border p-3">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1">{{ $job->location }}</span>
                                                        </p>
                                                        <p>{{ $job->category->name }}</p>
                                                        <p>{{ $job->experience }}</p>

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
                    <div class="mt-3"> {{ $jobs->links() }}</div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#searchForm').submit(function(event) {
            event.preventDefault();
            // let url = '{{ route('jobs') }}?';

            //     let keyword = $('#keyword').val();
            //     let location = $('#location').val();
            //     let category = $('#category').val();
            //     let experience = $('#experience').val();
            //     let checkedJobTypes = $('input[name="job_type"]:checked').get().map(v => v.value);
            //     let sort = $('#sort').val();

            //     if (keyword) {
            //         url += '&keyword=' + keyword;
            //     }
            //     if (location) {
            //         url += '&location=' + location;
            //     }
            //     if (category) {
            //         url += '&category=' + category;
            //     }
            //     if (experience) {
            //         url += '&experience=' + experience;
            //     }

            //     if (checkedJobTypes.length > 0) {
            //         url += '&jobType=' + checkedJobTypes;
            //     }
            //     if (sort) {
            //         url += '&sort=' + sort;
            //     }
            //     window.location.href = url;
            // });
            // $('#sort').change(function() {
            //     $("#searchForm").submit();
        });
    // Form submission handler
    $('#searchForm').submit(function(event) {
        event.preventDefault();
        
        const params = new URLSearchParams();
        const filters = {
            keyword: $('#keyword').val().trim(),
            location: $('#location').val().trim(),
            category: $('#category').val(),
            experience: $('#experience').val(),
            jobType: $('input[name="job_type"]:checked').map((i, el) => el.value).get(),
            sort: $('#sort').val()
        };

        // Add only non-empty filters
        Object.entries(filters).forEach(([key, value]) => {
            if (value && 
                (Array.isArray(value) ? value.length > 0 : true) && 
                value !== 'null' && 
                value !== 'undefined') {
                params.append(key, Array.isArray(value) ? value.join(',') : value);
            }
        });

        // Build final URL
        let finalUrl = '{{ route("jobs") }}';
        const queryString = params.toString();
        
        // Add ? only if parameters exist
        if (queryString) {
            finalUrl += '?' + queryString;
        }

        window.location.href = finalUrl;
    });

    // Sort change handler
    $('#sort').change(function() {
        $('#searchForm').submit();
    });

    </script>
@endsection
