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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createboardModal"><i class="ri-add-line align-bottom me-1"></i> Create Note</button>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end card-body-->
</div>
<!--end card-->

<div class="row mb-3">
    <div class="col-lg-4 mb-3" id="openAI">
        <div class="card tasks-box h-100">
            <div class="card-body">
                <div class="my_note">
                    <div class="d-flex mb-2">
                        <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="javascript:void(0)" class="d-block">Note Title</a></h6>
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" href="{{ route('view_notes') }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
                    <div class="mb-3">
                        <div class="d-flex mb-1">
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-0"><span class="text-secondary">25% </span>of AI Analytics</h6>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-muted">03 Jan, 2022</span>
                            </div>
                        </div>
                        <div class="progress rounded-3 progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="badge badge-soft-primary">User Name</span>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-group">
                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                    <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                </a>
                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3" style="display: none;" id="AI">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="mb-3 fw-semibold text-uppercase">AI Analytics</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 90%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">disgust 60%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> approval 45%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 fw-semibold text-uppercase">AI Normal</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 90%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" href="#suggestionModal">Suggestion</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3" id="openAI2">
        <div class="card tasks-box h-100">
            <div class="card-body">
                <div class="d-flex mb-2">
                    <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="javascript:void(0)" id="openAI2" class="d-block">Note Title</a></h6>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="{{ route('view_notes') }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
                <div class="mb-3">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">25% </span>of AI Analytics</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted">03 Jan, 2022</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">User Name</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3" style="display: none;" id="AI2">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="mb-3 fw-semibold text-uppercase">AI Analytics</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 90%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">disgust 60%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> approval 45%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 fw-semibold text-uppercase">AI Normal</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 90%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" href="#suggestionModal">Suggestion</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3" id="openAI3">
        <div class="card tasks-box h-100">
            <div class="card-body">
                <div class="d-flex mb-2">
                    <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a class="d-block">Note Title</a></h6>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="{{ route('view_notes') }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                            <li><a class="dropdown-item" href="#"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
                <div class="mb-3">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">25% </span>of AI Analytics</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted">03 Jan, 2022</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">User Name</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-group">
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nancy">
                                <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3" style="display: none;" id="AI3">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="mb-3 fw-semibold text-uppercase">AI Analytics</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 90%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">disgust 60%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> approval 45%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 fw-semibold text-uppercase">AI Normal</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 90%</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <!-- Labels Example -->
                            <div class="progress progress_bar">
                                <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-end">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" href="#suggestionModal">Suggestion</button>
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
                            <textarea class="form-control" placeholder="Enter description" name="description" rows="5" style="resize: none;"></textarea>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Upload Image</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple="multiple">
                                        </div>
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                            </div>

                                            <h4>Drop files here or click to upload.</h4>
                                        </div>
                                    </div>

                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                        <li class="mt-2" id="dropzone-preview-list">
                                            <!-- This is used as the file preview template -->
                                            <div class="border rounded">
                                                <div class="d-flex p-2">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm bg-light rounded">
                                                            <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Dropzone-Image" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="pt-1">
                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-3">
                                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- end dropzon-preview -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
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


<div class="modal fade zoomIn" id="suggestionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">AI Suggestion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!--end modal -->



@endsection

@section('custom-script')
<script>
    $('#openAI').on('click', function() {
        if ($(this).next('#AI').css('display') !== 'block') {
            $(this).next('#AI').fadeIn();
        } else {
            $(this).next('#AI').fadeOut();
        }

    });

    $('#openAI2').on('click', function() {
        if ($(this).next('#AI2').css('display') !== 'block') {
            $(this).next('#AI2').fadeIn();
        } else {
            $(this).next('#AI2').fadeOut();
        }

    });

    $('#openAI3').on('click', function() {
        if ($(this).next('#AI3').css('display') !== 'block') {
            $(this).next('#AI3').fadeIn();
        } else {
            $(this).next('#AI3').fadeOut();
        }

    });
</script>

@endsection