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
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <div class="hstack gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createboardModal"><i class="ri-add-line align-bottom me-1"></i> Create Note</button>
                    </div>
                    <form id="filterData">
                        @csrf
                        <div class="row g-3 mb-0 align-items-center">
                            <div class="col-sm-auto">
                                <div class="input-group">
                                    <input id="range" class="form-control border-0" placeholder="Select Date" name="select_range">
                                    <div class="input-group-text bg-primary border-primary text-white">
                                        <button type="submit" class="btn btn-sm text-center"><i class="ri-calendar-2-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end card-body-->
</div>
<!--end card-->

<div class="row mb-3 note-box">
    @foreach($notes as $note)
    @php
    $response = json_decode($note->response);
    $first_width = round($response->predictions->neutral * 100, 1);
    $i = 0;
    $t = '';
    foreach($response->predictions as $k => $v)
    {
    if($i != 0)
    {
    break;
    }
    $t = $k;
    $i++;
    }
    @endphp
    <div class="col-lg-4 mb-3">
        <div class="card tasks-box h-100">
            <div class="card-body">
                <div class="my_note">
                    <div class="d-flex mb-2">
                        <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="javascript:void(0)" data-response="{{ $note->response }}" data-bs-target="#aiModal" data-bs-toggle="modal" class="d-block note-title">{{ $note->title}}</a></h6>
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" href="{{ route('view_notes') }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                <li><a class="dropdown-item editBtn" data-bs-toggle="modal" href="#editModalNote" data-title="{{ $note->title }}" data-description="{{ $note->description }}" data-id="{{ $note->id }}" data-image="{{ $note->image }}"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                <li><a class="dropdown-item deleteRecord" data-id="{{ $note->id }}"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <p class="text-muted">{{ $note->description }}.</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="mb-3">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">{{ $first_width }}% </span>of {{ $t }}</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted">{{ $note->created_at->format('Y-M-d') }}</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $first_width }}%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">{{ auth()->user()->fullname }}</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="avatar-group">
                            @if(!empty(auth()->user()->photo))
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="{{ asset('storage/user/'.auth()->user()->photo) }}" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            @else
                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                            </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Notes Dynamic -->
</div>


<div class="modal fade zoomIn" id="aiModal" tabindex="-1" aria-labelledby="aiModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">AI Analytics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="mb-3 fw-semibold text-uppercase">Prediction</h6>
                <div class="row">
                    <div class="col-lg-12 predictions">
                    </div>
                </div>

                <h6 class="mb-3 fw-semibold text-uppercase">Harassment Predictions</h6>
                <div class="row">
                    <div class="col-lg-12 harassment_predictions">


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex align-items-end justify-content-end">
                    <button class="btn btn-sm btn-info response_suggestion" data-bs-toggle="modal" data-suggestion="{{ $response->suggestions }}" href="#suggestionModal">Suggestion</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="suggestionModal" tabindex="-1" aria-labelledby="suggestionModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">AI Suggestion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="response-text"></p>
            </div>
            <div class="modal-footer">
                <div class="d-flex align-items-end justify-content-end">
                    <button class="btn btn-sm btn-info response_suggestion" data-bs-toggle="modal" data-suggestion="{{ $response->suggestions }}" href="#suggestionModal">Suggestion</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="createboardModal" tabindex="-1" aria-labelledby="createboardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="createboardModalLabel">Add Notes</h5>
                <button type="button" class="btn-close" id="addBoardBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="prompt"></div>
                <form id="noteForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Note Title</label>
                            <input type="text" class="form-control" placeholder="Enter Note title" name="title">
                            <div class="error-title"></div>
                        </div>

                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Note Description</label>
                            <textarea class="form-control" placeholder="Enter description" name="description" rows="5" style="resize: none;"></textarea>
                            <div class="error-description"></div>
                        </div>

                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" name="file" id="main_picture">

                            <div class="preview-img mt-4">
                                <div id="main_image_view" class="h-100">
                                    <p class="d-flex align-items-center h-100 justify-content-center fw-bold fs-4">Preview Image</p>
                                </div>
                            </div>

                            <div class="error-image"></div>
                        </div>

                        <div class="mt-4">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submitForm" class="btn btn-success" id="addNewBoard">Add Note</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end add note modal-->

<!-- Edit Note -->
<div class="modal fade zoomIn" id="editModalNote" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="editModalNote">Edit Notes</h5>
                <button type="button" class="btn-close" id="addBoardBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="prompt"></div>
                <form id="editNoteForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Note Title</label>
                            <input type="text" id="title" class="form-control" placeholder="Enter Note title" name="title">
                            <div class="error-title"></div>
                        </div>

                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Note Description</label>
                            <textarea class="form-control" placeholder="Enter description" name="description" rows="5" id="description" style="resize: none;"></textarea>
                            <div class="error-description"></div>
                        </div>

                        <div class="col-lg-12">
                            <label for="boardName" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" name="file" id="pic">

                            <div class="preview-img mt-4">
                                <div id="image_view" class="h-100 text-center">
                                    <img src="" class="img-fluid h-100" id="imagepreview">
                                </div>
                            </div>

                            <div class="error-image"></div>
                        </div>

                        <div class="mt-4">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="editForm" class="btn btn-success" id="addNewBoard">Update Note</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Note -->

@endsection

@section('custom-script')
<script>
    $('.note-title').on('click', function() {
        let response = JSON.parse($(this).attr('data-response'));
        console.log(response);
        $('.predictions').html('');
        for (const key in response.predictions) {

            $('.predictions').append(`
                <div class="mb-3">
                    <!-- Labels Example -->
                    <div class="progress progress_bar position-relative" style="background-color: #d5e0f1;">
                        <span class="progress-span-label" style="position: absolute;top:0;height:100%;line-height:19px;width:100%;text-align:center;color: #000000;">${key} ${(response.predictions[key]*100).toFixed(1)}%</span>
                        <div class="progress-bar progress_bar_inner progress-bar-record" role="progressbar" style="width: ${(response.predictions[key]*100).toFixed(1)}%;" aria-valuenow="25" data-width=${(response.predictions[key]*100).toFixed(1)}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            `)
            console.log(`${key}: ${response.predictions[key]}`);
        }
        $('.harassment_predictions').html('');
        for (const key in response.harassment_predictions) {
            $('.harassment_predictions').append(`
                    <div class="mb-3">
                        <!-- Labels Example -->
                        <div class="progress progress_bar position-relative" style="background-color: #d5e0f1;">
                            <span class="progress-span-label" style="position: absolute;top:0;height:100%;line-height:19px;width:100%;text-align:center;color: #000000;">${key} ${(response.harassment_predictions[key]*100).toFixed(1)}%</span>
                            <div class="progress-bar progress_bar_inner progress-bar-record" role="progressbar" style="width: ${(response.harassment_predictions[key]*100).toFixed(1)}%;" aria-valuenow="25" data-width=${(response.harassment_predictions[key]*100).toFixed(1)}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                `)
            console.log(`${key}: ${response.harassment_predictions[key]}`);
        }
    });

    var editModal = new bootstrap.Modal(document.getElementById("editModalNote"), {});

    function oepnModal() {
        $('.editBtn').on('click', function() {
            editModal.show();
            $('#id').val($(this).attr('data-id'));
            $('#title').val($(this).attr('data-title'));
            $('#description').val($(this).attr('data-description'));
            var image = $(this).attr('data-image');
            $('#imagepreview').attr("src", "{{ asset('storage/notes') }}" + "/" + image);
        });
    }

    function deleteSweetAlert() {
        $('.deleteRecord').on('click', function() {

            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('delete-note') }}",
                        dataType: 'json',
                        data: {
                            id: id,
                            _token: '{{csrf_token()}}',
                        },

                        beforeSend: function() {},
                        success: function(res) {
                            if (res.success == true) {
                                setTimeout(function() {
                                    Swal.fire('Success!', res.Message, 'success');
                                }, 1500);
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            } else {}
                        },
                        error: function(e) {}
                    });
                }
            })
        });
    }

    $('.response_suggestion').on('click', function() {
        $('#response-text').text($(this).attr('data-suggestion'));
    });

    $('.editBtn').on('click', function() {
        $('#id').val($(this).attr('data-id'));
        $('#title').val($(this).attr('data-title'));
        $('#description').text($(this).attr('data-description'));
        var image = $(this).attr('data-image');
        $('#imagepreview').attr("src", "{{ asset('storage/notes') }}" + "/" + image);
    });

    $('.progress-bar-record').each(function() {
        if ($(this).attr('data-width') >= 60) {
            $(this).prev('.progress-span-label').addClass('text-white');
        }
    });

    $("#noteForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#noteForm")[0]);
        formData = new FormData($("#noteForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('add-note') }}",
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
                    }, 3000);

                    window.location.reload();
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
                if (e.responseJSON.errors['title']) {
                    $('.error-title').html('<small class=" error-message text-danger">' + e.responseJSON.errors['title'][0] + '</small>');
                }
                if (e.responseJSON.errors['description']) {
                    $('.error-description').html('<small class=" error-message text-danger">' + e.responseJSON.errors['description'][0] + '</small>');
                }
                if (e.responseJSON.errors['file']) {
                    $('.error-image').html('<small class=" error-message text-danger">' + e.responseJSON.errors['file'][0] + '</small>');
                }
            }

        });
    });

    $("#editNoteForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#editNoteForm")[0]);
        formData = new FormData($("#editNoteForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('edit-note') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            mimeType: "multipart/form-data",
            beforeSend: function() {
                $("#editForm").prop('disabled', true);
                $("#editForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {
                $("#editForm").attr('class', 'btn btn-success');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 3000);

                    window.location.reload();
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
                $("#editForm").prop('disabled', false);
                if (e.responseJSON.errors['title']) {
                    $('.error-title').html('<small class=" error-message text-danger">' + e.responseJSON.errors['title'][0] + '</small>');
                }
                if (e.responseJSON.errors['description']) {
                    $('.error-description').html('<small class=" error-message text-danger">' + e.responseJSON.errors['description'][0] + '</small>');
                }
                if (e.responseJSON.errors['file']) {
                    $('.error-image').html('<small class=" error-message text-danger">' + e.responseJSON.errors['file'][0] + '</small>');
                }
            }

        });
    });

    $("#main_picture").on("change", function(e) {

        f = Array.prototype.slice.call(e.target.files)[0]
        let reader = new FileReader();
        reader.onload = function(e) {

            $("#main_image_view").html(`<img style="height: 100%; object-fit: contain;"  id="main_image_preview"  src="${e.target.result}" class="main_image_preview img-block- img-fluid w-100">`);
        }
        reader.readAsDataURL(f);


    })

    $("#pic").on("change", function(e) {

        f = Array.prototype.slice.call(e.target.files)[0]
        let reader = new FileReader();
        reader.onload = function(e) {

            $("#image_view").html(`<img style="height: 100%; object-fit: contain;"  id="image_preview"  src="${e.target.result}" class="main_image_preview img-block- img-fluid w-100">`);
        }
        reader.readAsDataURL(f);
    })



    $("#range").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        mode: "range"
    });


    $('.deleteRecord').on('click', function() {

        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('delete-note') }}",
                    dataType: 'json',
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}',
                    },

                    beforeSend: function() {},
                    success: function(res) {
                        if (res.success == true) {
                            setTimeout(function() {
                                Swal.fire('Success!', res.Message, 'success');
                            }, 1500);
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else {}
                    },
                    error: function(e) {}
                });
            }
        })
    });


    $("#filterData").on('submit', function(e) {
        $('.loader').removeClass('d-none')
        e.preventDefault();
        var formData = new FormData($("#filterData")[0]);
        formData = new FormData($("#filterData")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('filter_data') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            beforeSend: function() {
                $(".note-box").html('<i class="fa fa-spinner fa-spin me-1"></i>');
            },
            success: function(res) {
                if (res.success == true) {
                    $('.loader').addClass('d-none')
                    $('.note-box').html('');
                    let data = res.data;
                    for (var i = 0; i < data.length; i++) {
                        $('.note-box').append(`
                            <div class="col-lg-4 mb-3">
                                <div class="card tasks-box h-100">
                                    <div class="card-body">
                                        <div class="my_note">
                                            <div class="d-flex mb-2">
                                                <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title"><a href="javascript:void(0)" data-response="{{ $note->response }}" data-bs-target="#aiModal" data-bs-toggle="modal" class="d-block note-title">${data[i].title}</a></h6>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                        <li><a class="dropdown-item" href="{{ route('view_notes') }}"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                                        <li><a class="dropdown-item editBtn" 
                                                        onclick=(oepnModal())
                                                        href="javascript:void(0)" data-title="${data[i].title}" data-description="${data[i].description}" data-id="${data[i].id}" data-image="${data[i].image}"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                                        <li><a onclick=(deleteSweetAlert()) class="dropdown-item deleteRecord" data-id="${data[i].id}"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="text-muted">${data[i].description}.</p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="mb-3">
                                            <div class="d-flex mb-1">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-muted mb-0"><span class="text-secondary">{{ $first_width }}% </span>of Neutral</h6>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <span class="text-muted">{{ $note->created_at->format('Y-M-d') }}</span>
                                                </div>
                                            </div>
                                            <div class="progress rounded-3 progress-sm">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $first_width }}%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="badge badge-soft-primary">{{ auth()->user()->fullname }}</span>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="avatar-group">
                                                    @if(!empty(auth()->user()->photo))
                                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                                        <img src="{{ asset('storage/user/'.auth()->user()->photo) }}" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                    @else
                                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Alexis">
                                                        <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                } else {
                    $('.loader').addClass('d-none')
                    $('.note-box').html(' ')
                    $('.note-box').append(`
                    <div class="text-center bg-white">
                        <img src={{ asset('assets/images/no-data-found.png') }} class="img-fuild" style="height:300px;"></img>
                    </div>`)
                }
            },
            error: function(e) {}
        });
    });
</script>
@endsection