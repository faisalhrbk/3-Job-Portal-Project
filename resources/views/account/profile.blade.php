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
                    <form method="POST" id="userForm" name="userForm">
                        <div class="card mb-4 border-0 shadow">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">My Profile</h3>
                                <div class="mb-4">
                                    <label for="name" class="mb-2">Name*</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Name"
                                        class="form-control" value="{{ $user->name }}">
                                        <p class="error-name"></p>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="mb-2">Email*</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email"
                                        value="{{ $user->email }}" class="form-control">
                                        <p class="error-email"></p>
                                </div>
                                <div class="mb-4">
                                    <label for="designation" class="mb-2">Designation*</label>
                                    <input type="text" placeholder="Designation" class="form-control" name="designation"
                                        id="designation" value="{{ $user->designation }}">
                                        <p class="error-designation"></p>
                                </div>
                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">Mobile*</label>
                                    <input type="text" placeholder="Mobile" class="form-control" name="mobile"
                                        id="mobile" value="{{ $user->mobile }}"  >
                                        <p class="error-mobile"></p>
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>

                    <div class="card mb-4 border-0 shadow">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Old Password*</label>
                                <input type="password" placeholder="Old Password" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" placeholder="New Password" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" placeholder="Confirm Password" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="button" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script >
        $("#userForm").submit(function(event) {
            event.preventDefault();
        

            $.ajax({
                'url': '{{ route('account.update.profile') }}',
                'type': 'post',
                
                'data': $("#userForm").serializeArray(),
                'dataType': 'json',
                'success': function(response) {
                 if(response.status == true){
                 window.location="{{ route('account.profile') }}"
                 }else{
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
