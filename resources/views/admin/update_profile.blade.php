@extends('admin.layout.layout')

@section('title' , 'journAI | Update Admin Profile')

@section('content')
<div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img">
        <img src="{{asset('assets/images/profile-bg.jpg')}}" class="profile-wid-img" alt="">
    </div>
</div>

<div class="row">
    <div class="col-xxl-3">
        <div class="card mt-n5">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        @if( auth('admin')->user()->image == null)
                        <img src="{{asset('assets/images/users/avatar-1.jpg')}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                        @else
                        <img src="{{ auth('admin')->user()->getAdminProfileImage() }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                        @endif
                    </div>
                    <h5 class="fs-16 mb-1">{{ auth('admin')->user()->full_name}}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-9">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                            <i class="fas fa-home"></i> Personal Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                            <i class="far fa-user"></i> Change Password
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        <form id="updateProfile">
                            <div class="prompt"></div>
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{ auth('admin')->user()->name }}">
                                        <div class="error-name"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="lastnameInput" class="form-label">Full name</label>
                                        <input type="text" class="form-control" name="full_name" placeholder="Enter your full name" value="{{ auth('admin')->user()->full_name}}">
                                        <div class="error-full-name"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{ auth('admin')->user()->email }}">
                                        <div class="error-email"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" value="{{ auth('admin')->user()->email }}">
                                        <div class="error-image"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="submitForm">Updates</button>
                                        <button type="button" class="btn btn-soft-success">Cancel</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        <form id="updatePasswordForm">
                            <div class="prompt"></div>
                            @csrf
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control" name="oldpasswordInput" placeholder="Enter current password" id="password-input">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        <div class="error-oldPassword"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="newpasswordInput" class="form-label">New Password*</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control" name="newpasswordInput" placeholder="Enter new password" id="new-password">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="new-password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        <div class="error-newPass"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                        <input type="password" class="form-control" name="confirmpasswordInput" placeholder="Confirm password" id="confirmPassword">
                                    </div>
                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success" id="submitForm">Change Password</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection

@section('custom-script')
<script>
    $("#updateProfile").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#updateProfile")[0]);
        formData = new FormData($("#updateProfile")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('admin_update_profile') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            mimeType: "multipart/form-data",
            beforeSend: function() {
                $("#submitForm").prop('disabled', true);
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {
                $("#submitForm").attr('class', 'btn btn-success');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.reload();
                    }, 3000);
                    $('.prompt').show()
                } else {
                    $('.prompt').html('<div class="alert alert-danger">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.reload();
                    }, 3000);

                    $('.prompt').show()
                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                if (e.responseJSON.errors['name']) {
                    $('.error-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['name'][0] + '</small>');
                }
                if (e.responseJSON.errors['image']) {
                    $('.error-image').html('<small class=" error-message text-danger">' + e.responseJSON.errors['image'][0] + '</small>');
                }
                if (e.responseJSON.errors['full_name']) {
                    $('.error-full-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['full_name'][0] + '</small>');
                }
                if (e.responseJSON.errors['email']) {
                    $('.error-email').html('<small class=" error-message text-danger">' + e.responseJSON.errors['email'][0] + '</small>');
                }
            }

        });
    });

    $("#updatePasswordForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#updatePasswordForm")[0]);
        formData = new FormData($("#updatePasswordForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('admin_update_password') }}",
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
                    $('.prompt').html('<div class="alert alert-success">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.reload();
                    }, 3000);
                    $('.prompt').show()
                } else {
                    $('.prompt').html('<div class="alert alert-danger">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 3000);

                    $('.prompt').show()
                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                if (e.responseJSON.errors['oldpasswordInput']) {
                    $('.error-oldPassword').html('<small class=" error-message text-danger">' + e.responseJSON.errors['oldpasswordInput'][0] + '</small>');
                }
                if (e.responseJSON.errors['newpasswordInput']) {
                    $('.error-newPass').html('<small class=" error-message text-danger">' + e.responseJSON.errors['newpasswordInput'][0] + '</small>');
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

    const newTogglePassword = document.querySelector('#new-password-addon');
    const newPassword = document.querySelector('#new-password');
    const confirmPassword = document.querySelector('#confirmPassword');

    newTogglePassword.addEventListener('click', function(e) {
        let type;
        if (newPassword.getAttribute('type') === 'password' && confirmPassword.getAttribute('type') === 'password') {
            type = 'text';
            newPassword.setAttribute('type', type);
            confirmPassword.setAttribute('type', type);
            this.classList.add('fa-eye-slash');
            this.classList.remove("fa-eye");
        } else {
            type = 'password';
            newPassword.setAttribute('type', type);
            confirmPassword.setAttribute('type', type);
            this.classList.add("fa-eye");
            this.classList.remove('fa-eye-slash');
        }
    });
</script>
@endsection