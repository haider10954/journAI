@extends('user.layout.layout')

@section('title' , 'journAI | Update Profile')

@section('content')
<div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img">
        <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
    </div>
</div>


<div class="row">
    <div class="col-xxl-3">
        <div class="card mt-n5">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        <img src="{{asset( ''.auth()->user()->userImage())}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                    </div>
                    <h5 class="fs-16 mb-1">{{ auth()->user()->Username }}</h5>
                    <p class="text-muted mb-0">{{ auth()->user()->Job_designation }}</p>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col-xxl-9">
        <div class="card mt-xxl-n5">

            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="prompt"></div>
                        <form id="updateProfile">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="Enter your firstname" name="name" value="{{ auth()->user()->Username}}">
                                        <div class="error-name"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">User Profile</label>
                                        <input type="file" class="form-control" name="profile_img">
                                        <div class="error-image"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Full name</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" value="{{ auth()->user()->fullname }}">
                                        <div class="error-full-name"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ auth()->user()->email }}">
                                        <div class="error-email"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Job Designation</label>
                                        <input type="text" class="form-control" placeholder="Enter your Job designation" name="Job_designation" value="{{ auth()->user()->Job_designation}}">
                                        <div class="error-job"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-control" placeholder="Select date" name="company_name" value="{{ auth()->user()->company_name}}" />
                                        <div class="error-company"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hobbies</label>
                                        <input class="form-control" id="hobbies" name="hobbies" type="text" value="{{ auth()->user()->getHobbiesJsonString('hobbies') }}" />
                                        <div class="error-hobby"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3 pb-2">
                                        <label for="exampleFormControlTextarea" class="form-label">Address</label>
                                        <textarea class="form-control" name="address" placeholder="Enter your address" rows="3">{{ auth()->user()->address}}</textarea>
                                        <div class="error-address"></div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" id="submitForm" class="btn btn-primary">Updates</button>
                                        <button type="button" class="btn btn-soft-success">Cancel</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
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
    var input = document.querySelector('#hobbies');
    new Tagify(input);

    $("#updateProfile").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#updateProfile")[0]);
        formData = new FormData($("#updateProfile")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('update-profile') }}",
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
                        window.location.href = "{{ route('update_profile') }}"
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
                    $('.error-full-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['fullname'][0] + '</small>');
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
                    $('.error-hobby').html('<small class=" error-message text-danger">' + e.responseJSON.errors['hobbies'][0] + '</small>');
                }
                if (e.responseJSON.errors['address']) {
                    $('.error-address').html('<small class=" error-message text-danger">' + e.responseJSON.errors['address'][0] + '</small>');
                }
            }

        });
    });
</script>
@endsection