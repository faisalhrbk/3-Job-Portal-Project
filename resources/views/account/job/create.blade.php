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
                    <form action="" method="POST" id="createJobForm" name="createJobForm">
                        <div class="card mb-4 border-0 shadow">

                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select name="jobType" id="jobType" class="form-select">
                                            <option value="">Select Job Type</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option value="{{ $jobType->name }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                            name="vacancy" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="location" id="location" name="Location"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                        placeholder="Description"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords"
                                        class="form-control">
                                </div>

                                <h3 class="fs-4 border-top mb-1 mt-5 pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name"
                                            name="company_name" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="location" name="location"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="website"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="button" class="btn btn-primary">Save Job</button>
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
        $("#userForm").submit(function(event) {
            event.preventDefault();


            $.ajax({
                'url': '{{ route('account.update.profile') }}',
                'type': 'post',

                'data': $("#userForm").serializeArray(),
                'dataType': 'json',
                'success': function(response) {
                    if (response.status == true) {
                        window.location = "{{ route('account.profile') }}"
                    } else {
                        let errors = response.errors;
                        if (errors.name) {
                            $("#name").addClass('is-invalid');
                            $('.error-name').addClass('invalid-feedback').html(errors.name);

                        } else {
                            $("#name").removeClass('is-invalid');
                            $('.error-name').removeClass('invalid-feedback').html('');
                        }

                        if (errors.email) {
                            $("#email").addClass('is-invalid');
                            $('.error-email').addClass('invalid-feedback').html(errors.email);
                        } else {
                            $("#email").removeClass('is-invalid');
                            $('.error-email').removeClass('invalid-feedback').html('');
                        }
                    }
                }
            });
        });
    </script>
@endsection
