@extends('layouts.app')
@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card border-0 p-5 shadow">
                        <h1 class="h3">Register</h1>
                        <form action="" name="registrationFrom" id="registrationForm" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Name">
                                <p class="error-name"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter Email">
                                <p class="error-email"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password">
                                <p class="error-password"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                    id="confirm_password" placeholder="Enter Password">
                                <p class="error-confirm_password"></p>
                            </div>
                            <button class="btn btn-primary mt-2" type="submit">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="login.html">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script>
        $("#registrationForm").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('account.register.post') }}',
                type: 'post',
                data: $('#registrationForm').serializeArray(),
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    if (response.status == false) {
                        if (response.status == false) {
                            let errors = response.errors;

                            if (errors.name) {
                                $("#name").addClass('is-invalid');
                                $('.error-name').addClass('invalid-feedback').html(errors.name);
                                console.log('in name if cond');

                            } else {
                                $("#name").removeClass('is-invalid');
                                $('.error-name').removeClass('invalid-feedback').html('');
                                console.log('in name else');
                            }

                            if (errors.email) {
                                $("#email").addClass('is-invalid');
                                $('.error-email').addClass('invalid-feedback').html(errors.email);
                            } else {
                                $("#email").removeClass('is-invalid');
                                $('.error-email').removeClass('invalid-feedback').html('');
                            }

                            if (errors.password) {
                                $("#password").addClass('is-invalid');
                                $('.error-password').addClass('invalid-feedback').html(errors.password);
                            } else {
                                $("#password").removeClass('is-invalid');
                                $('.error-password').removeClass('invalid-feedback').html('');
                            }

                            if (errors.confirm_password) {
                                $("#confirm_password").addClass('is-invalid');
                                $('.error-confirm_password').addClass('invalid-feedback').html(errors
                                    .confirm_password);
                            } else {
                                $("#confirm_password").removeClass('is-invalid');
                                $('.error-confirm_password').removeClass('invalid-feedback').html('');
                            }
                        }
                    } else {
                        $('#registrationForm')[0].reset();
                        $('.is-invalid').removeClass('is-invalid');
                        $('p').html('');
                    }

                }
            });
        });
    </script>
@endsection
