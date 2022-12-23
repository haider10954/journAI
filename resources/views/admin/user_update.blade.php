@extends('admin.layout.layout')

@section('title' , 'JournAI | Edit User Profile')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">JournAI</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">Edit User Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit Profile</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="prompt"></div>
                <div class="live-preview">
                    <form id="updateProfile">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}" />
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="Enter your username" value="{{ $user->Username }}">
                                    <label>User Name</label>
                                    <div class="error-name"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="fullname" placeholder="Enter your full name" value="{{ $user->fullname }}">
                                    <label>Full Name</label>
                                    <div class="error-fullname"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{ $user->email }}">
                                    <label>Email Address</label>
                                    <div class="error-email"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="Job_designation" placeholder="Enter your Job designation" value="{{ $user->Job_designation }}">
                                    <label>Job designation</label>
                                    <div class="error-job"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="company_name" placeholder="Enter your company name" value="{{ $user->company_name }}">
                                    <label>Company name</label>
                                    <div class="error-company"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="address" placeholder="Enter your address" value="{{ $user->address }}">
                                    <label>Address</label>
                                    <div class="error-address"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="hobbies" id="hobbies" value="{{ (empty( $user->hobbies)) ? '' : $user->getHobbiesJsonString('hobbies') }}">
                                    <label>Hobbies</label>
                                    <div class="error-hobbies"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="profile_img" id="main_picture">
                                    <label>Profile Image</label>
                                    <div class="error-image"></div>
                                </div>
                                <div class="img-preview">
                                    <img src="{{ $user->userImage() }}" class="img-fluid p-2">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button id="submitForm" type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')

<script>
    var input = document.querySelector('#hobbies');
    new Tagify(input);
    $('.tagify ').addClass('pt-3');

    $("#updateProfile").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#updateProfile")[0]);
        formData = new FormData($("#updateProfile")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('admin_edit_user') }}",
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
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 1000);
                    }, 1500);

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('admin_user') }}";
                    }, 3000);

                    $('.prompt').show()

                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 1000);
                    }, 1500);

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 3000);

                    $('.prompt').show()
                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                if (e.responseJSON.errors['name']) {
                    $('.error-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['name'][0] + '</small>');
                }
                if (e.responseJSON.errors['profile_img']) {
                    $('.error-image').html('<small class=" error-message text-danger">' + e.responseJSON.errors['profile_img'][0] + '</small>');
                }
                if (e.responseJSON.errors['fullname']) {
                    $('.error-fullname').html('<small class=" error-message text-danger">' + e.responseJSON.errors['fullname'][0] + '</small>');
                }
                if (e.responseJSON.errors['email']) {
                    $('.error-email').html('<small class=" error-message text-danger">' + e.responseJSON.errors['email'][0] + '</small>');
                }
                if (e.responseJSON.errors['Job_designation']) {
                    $('.error-job').html('<small class=" error-message text-danger">' + e.responseJSON.errors['Job_designation'][0] + '</small>');
                }
                if (e.responseJSON.errors['company_name']) {
                    $('.error-company').html('<small class=" error-message text-danger">' + e.responseJSON.errors['company_name'][0] + '</small>');
                }
                if (e.responseJSON.errors['hobbies']) {
                    $('.error-hobbies').html('<small class=" error-message text-danger">' + e.responseJSON.errors['hobbies'][0] + '</small>');
                }
                if (e.responseJSON.errors['address']) {
                    $('.error-address').html('<small class=" error-message text-danger">' + e.responseJSON.errors['address'][0] + '</small>');
                }
            }

        });
    });

    $("#main_picture").on("change", function(e) {

        f = Array.prototype.slice.call(e.target.files)[0]
        let reader = new FileReader();
        reader.onload = function(e) {

            $(".img-preview").html(`<img src="${e.target.result}" class="img-fluid p-2">`);
        }
        reader.readAsDataURL(f);
    })
</script>

@endsection