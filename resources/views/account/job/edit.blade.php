@extends('layouts.app')

@section('main')
    <section class="section-5 bg-2">

        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 mb-4 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('account.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('message')
                    <form action="" method="POST" id="editJobForm" name="editJobForm">
                        <div class="card mb-4 border-0 shadow">

                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Edit Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title"
                                            value="{{ $job->title }}" name="title" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-select">
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option {{ $job->category_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                        <select name="jobType" id="jobType" class="form-select">
                                            <option value="">Select Job Type</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option {{ $job->job_type_id == $jobType->id ? 'selected' : '' }}
                                                        value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input value="{{ $job->vacancy }}" type="number" min="1"
                                            placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" value="{{ $job->salary }}" placeholder="Salary"
                                            id="salary" name="salary" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input value="{{ $job->location }}" type="text" placeholder="location"
                                            id="location" name="location" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                        placeholder="Description">{{ $job->description }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"> {{ $job->benefits }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility">{{ $job->responsibility }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications"> {{ $job->qualifications }}</textarea>
                                </div>
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
                                        <option value="">Select Experience</option>
                                        @foreach ($experiences as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ $job->experience == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" value="{{ $job->keywords }}" placeholder="keywords" id="keywords" name="keywords"
                                        class="form-control">
                                </div>

                                <h3 class="fs-4 border-top mb-1 mt-5 pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" {{ $job->company_name }} placeholder="Company Name" id="company_name"
                                            name="company_name" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Location</label>
                                        <input {{ $job->company_location }} type="text" placeholder="Location" id="location"
                                            name="company_location" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Website</label>
                                    <input type="text" {{ $job->company_website }}  placeholder="Website" id="website" name="company_website"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Update Job</button>
                            </div>
                        </div>
                    </form>
    </section>
    </div>
    </div>
    </div>
@endsection

@section('customJs')
    <script>
        $("#editJobForm").submit(function(event) {
            event.preventDefault();
            let form = $('#editJobForm ')[0]; // form DOM object
            let formData = new FormData(form);


            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }


            $.ajax({
                'url': "{{ route('account.updateJobPost') }}",
                'type': 'post',
                'dataType': 'json',
                'data': $("#editJobForm").serializeArray(),
                'success': function(response) {
                    if (response.status == true) {
                        $("#title").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $("#category").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $("#jobType").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $("#vacancy").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $("#location").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $("#description").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $("#company_name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        window.location = "{{ route('account.myJobs') }}"

                    } else {

                        console.log('in errors else');
                        let errors = response.errors;
                        if (errors.title) {
                            $("#title").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.title);
                        } else {
                            $("#title").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors.category) {
                            $("#category").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.category);
                        } else {
                            $("#category").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors.jobType) {
                            $("#jobType").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.jobType);
                        } else {
                            $("#jobType").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        vacancy
                        if (errors.vacancy) {
                            $("#vacancy").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.vacancy);
                        } else {
                            $("#vacancy").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors.location) {
                            $("#location").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.location);
                        } else {
                            $("#location").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors.description) {
                            $("#description").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.description);
                        } else {
                            $("#description").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors.company_name) {
                            $("#company_name").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors.company_name);
                        } else {
                            $("#company_name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                }
            });
        });
    </script>
@endsection
