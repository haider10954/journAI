@extends('user.layout.layout')

@section('title' , 'journAI | index')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">My JournAI</h4>

            <div class="page-title-right">
                <div class="d-flex align-items-center gap-1 mt-3 mt-md-0">
                    <button class="btn btn-theme-export">Export All</button>
                    <button class="btn btn-theme-export">Export Entry</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-end">
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <div class="d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2"><i class=" ri-filter-2-fill font-20"></i></span>
                        <p class="mb-sm-0">My JournAI</p>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="p-2">
                            <label class="form-group">From</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="p-2">
                            <label class="form-group">To</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="p-2">
                            <a class="btn btn-sm btn-primary" href="#">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-md-3">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Title</p>
                        <h2 class="mt-4 ff-secondary fw-semibold">Note Description</h2>
                        <p class="mb-0 text-muted">05/12/2022</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                <i data-feather="trash" class="text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-md-3">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Title</p>
                        <h2 class="mt-4 ff-secondary fw-semibold">Note Description</h2>
                        <p class="mb-0 text-muted">05/12/2022</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                <i data-feather="trash" class="text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-md-3">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Title</p>
                        <h2 class="mt-4 ff-secondary fw-semibold">Note Description</h2>
                        <p class="mb-0 text-muted">05/12/2022</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                <i data-feather="trash" class="text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-md-3">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Title</p>
                        <h2 class="mt-4 ff-secondary fw-semibold">Note Description</h2>
                        <p class="mb-0 text-muted">05/12/2022</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                <i data-feather="trash" class="text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>



<div class="row">
    <div class="col-sm-6 col-xl-3">
        <!-- Simple card -->
        <div class="card">
            <img class="card-img-top img-fluid" src="{{ asset('assets/images/small/img-1.jpg') }}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mb-2">Web Developer</h4>
                <p class="card-text">At missed advice my it no sister. Miss told ham dull knew see she spot near can. Spirit her entire her called.</p>
                <div class="text-end">
                    <a href="javascript:void(0);" class="btn btn-primary">Submit</a>
                </div>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <img class="card-img-top img-fluid" src="{{ asset('assets/images/small/img-2.jpg') }}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title mb-2">How apps is changing the IT world</h4>
                <p class="card-text mb-0">Whether article spirits new her covered hastily sitting her. Money witty books nor son add. Chicken age had evening believe but proceed pretend mrs.</p>
            </div>
            <div class="card-footer">
                <a href="javascript:void(0);" class="card-link link-secondary">Read More <i class="ri-arrow-right-s-line ms-1 align-middle lh-1"></i></a>
                <a href="javascript:void(0);" class="card-link link-success">Bookmark <i class="ri-bookmark-line align-middle ms-1 lh-1"></i></a>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <img class="card-img-top img-fluid" src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">We quickly learn to fear and thus automatically avoid potentially stressful situations of all kinds, including the most common of all making mistakes.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
            </ul>
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">What planning process needs ?</h4>
                <h6 class="card-subtitle font-14 text-muted">Development</h6>
            </div>
            <img class="img-fluid" src="{{ asset('assets/images/small/img-4.jpg') }}" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer revolutionary meta-services.</p>
            </div>
            <div class="card-footer">
                <a href="javascript:void(0);" class="card-link link-secondary">Read More <i class="ri-arrow-right-s-line ms-1 align-middle lh-1"></i></a>
                <a href="javascript:void(0);" class="card-link link-success">Bookmark <i class="ri-bookmark-line align-middle ms-1 lh-1"></i></a>
            </div>
        </div>
    </div><!-- end col -->
</div><!-- end row -->

@endsection
