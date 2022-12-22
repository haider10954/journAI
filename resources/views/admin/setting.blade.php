@extends('admin.layout.layout')

@section('title' , 'journAI | Admin Profile')

@section('content')
<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <img src="{{asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
    </div>
</div>
<div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
    <div class="row g-4">
        <div class="col-auto">
            <div class="avatar-lg">
                @if(auth()->user()->image == null)
                <img src="{{asset('assets/images/users/avatar-8.jpg')}}" alt="user-img" class="img-thumbnail rounded-circle" />
                @else
                <img src="{{asset( ''.auth()->user()->getAdminProfileImage())}}" alt="user-img" class="img-thumbnail rounded-circle" />
                @endif
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="d-flex justify-content-between">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ auth()->user()->name }}</h3>
                    <p class="text-white-75">{{ auth()->user()->full_name}}</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ auth()->user()->email}}</div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin_update_profile_view') }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>
<div class="row">
    <div class="col-lg-12">
        <div>
            <!-- Tab panes -->
            <div class="tab-content pt-4 text-muted">
                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Info</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Full Name :</th>
                                                    <td class="text-muted">{{ auth()->user()->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">E-mail :</th>
                                                    <td class="text-muted">{{ auth()->user()->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Joining Date</th>
                                                    <td class="text-muted">{{ Carbon\Carbon::parse(auth()->user()->created_at)->format('d M, Y')}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
            <!--end tab-content-->
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection