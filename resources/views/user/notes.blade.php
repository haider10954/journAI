@extends('user.layout.layout')

@section('title' , 'journAI | Notes')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Journ AI</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item "><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">Notes</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-lg-auto">
                <div class="hstack gap-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createboardModal"><i class="ri-add-line align-bottom me-1"></i> Create Board</button>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end card-body-->
</div>
<!--end card-->

<div class="row">
    <div class="col-lg-3">
        <div class="card tasks-box">
            <div class="card-body">
                <div class="d-flex mb-2">
                    <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Profile Page Structure</a></h6>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted">Profile Page means a web page accessible to the public or to guests.</p>
                <div class="mb-3">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">15%</span> of 100%</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted">03 Jan, 2022</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">Admin</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card tasks-box">
            <div class="card-body">
                <div class="d-flex mb-2">
                    <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Profile Page Structure</a></h6>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted">Profile Page means a web page accessible to the public or to guests.</p>
                <div class="mb-3">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">15%</span> of 100%</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted">03 Jan, 2022</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">Admin</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3">
        <div class="card tasks-box">
            <div class="card-body">
                <div class="d-flex mb-2">
                    <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Profile Page Structure</a></h6>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted">Profile Page means a web page accessible to the public or to guests.</p>
                <div class="mb-3">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">15%</span> of 100%</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted">03 Jan, 2022</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">Admin</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3">
        <div class="card tasks-box">
            <div class="card-body">
                <div class="d-flex mb-2">
                    <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="apps-tasks-details.html" class="d-block">Profile Page Structure</a></h6>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="apps-tasks-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted">Profile Page means a web page accessible to the public or to guests.</p>
                <div class="mb-3">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">15%</span> of 100%</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted">03 Jan, 2022</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">Admin</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createboardModal" tabindex="-1" aria-labelledby="createboardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="createboardModalLabel">Add Notes</h5>
                <button type="button" class="btn-close" id="addBoardBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Note Title</label>
                            <input type="text" class="form-control" placeholder="Enter Note title" name="title">
                        </div>

                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Note Description</label>
                            <input type="text" class="form-control" placeholder="Enter description" name="description">
                        </div>

                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>


                        <div class="mt-4">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" id="addNewBoard">Add Note</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end add note modal-->


<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="delete-btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this tasks ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end modal -->

@endsection
