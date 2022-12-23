<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>JournAI | Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    @include('admin.includes.style')

</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="javascript:void(0)" class="d-inline-block auth-logo">
                                    <img src="{{asset('assets/images/logo-white.png')}}" alt="" height="20">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to JournAI.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <div class="prompt"></div>
                                    <form id="loginForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="text" class="form-control" placeholder="Enter email" name="email">
                                            <div class="error-email"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5" placeholder="Enter password" name="password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <div class="error-password"></div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" id="submitForm" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
    </div>

    @include('admin.includes.script')
    <script>
        $("#loginForm").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($("#loginForm")[0]);
            formData = new FormData($("#loginForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('admin_login') }}",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                beforeSend: function() {
                    $("#submitForm").prop('disabled', true);
                    $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
                },
                success: function(res) {
                    $("#submitForm").attr('class', 'btn btn-success');
                    if (res.success) {
                        $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                        setTimeout(function() {
                            $('.prompt').hide()
                            window.location.href = "{{ route('admin_index') }}";
                        }, 3000);
                        $('.prompt').show()

                    } else {
                        $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');
                        setTimeout(function() {
                            $('.prompt').hide()
                        }, 2000);
                        $('.prompt').show()
                        $("#submitForm").prop('disabled', false);
                        $("#submitForm").html('Login');
                    }
                },
                error: function(e) {
                    $("#submitForm").prop('disabled', false);
                    $("#submitForm").html('Login');
                    if (e.responseJSON.errors['email']) {
                        $('.error-email').html('<small class=" error-message text-danger">' + e.responseJSON.errors['email'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['password']) {
                        $('.error-password').html('<small class=" error-message text-danger">' + e.responseJSON.errors['password'][0] + '</small>');
                    }
                }

            });
        });

        const togglePassword = document.querySelector('#password-addon');
        const password = document.querySelector('#password-input');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            let type;
            if (password.getAttribute('type') === 'password') {
                type = 'text';
                password.setAttribute('type', type);
                this.classList.add('fa-eye-slash');
                this.classList.remove("fa-eye");
            } else {
                type = 'password';
                password.setAttribute('type', type);
                this.classList.add("fa-eye");
                this.classList.remove('fa-eye-slash');
            }
        });
    </script>
</body>

</html>