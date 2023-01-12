@extends('user.layout.layout')

@section('title' , 'journAI | Notes')

@section('content')


<div class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-lg-3 col-sm-3">
                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createboardModal" id="logo-tour"><i class="ri-add-line align-bottom me-1"></i>Create Note</button>
            </div>
            <!--end col-->

            <div class="col-lg-3 col-sm-3">
                <div class="search-box">
                    <input id="myInput" type="text" class="form-control search bg-light border-light" placeholder="Search for notes">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-6 col-sm-6">
                <form id="filterData" class="row">
                    @csrf
                    <div class="col-lg-8 col-sm-8 mb-3 mb-md-0">
                        <div class="search-box postion-relative" id="date-tour">
                            <input id="range" class="form-control search bg-light border-light" placeholder="Select Date" name="select_range">
                            <i class="ri-close-fill cancel-search d-none" id="cancel_search"></i>
                        </div>
                    </div>
                    <!--end col-->

                    <div class="col-lg-4 col-sm-4">
                        <button type="submit" class="btn btn-primary w-100" id="filter-tour"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                            Filters
                        </button>
                    </div>
                </form>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<!--end card-body-->

<div class="row mb-3 note-box">

    <div class="no-records d-flex align-items-center justify-content-center w-100"></div>
    <input type="hidden" name="checkNote" id="checkNote" value="{{$notes}}">
    @if($notes->count() > 0)
    @foreach($notes as $note)
    @php
    $response=json_decode($note->response);
    $count = 0 ;
    $first_value = '' ;

    foreach($response->predictions as $key1=>$value)
    {

    if($count == 0)
    {
    $first_value = $value;
    }
    $count++;
    break;
    }


    $first_width = round($first_value * 100, 1);
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

    @php
    $stringLength = Str::length($note->description);
    @endphp

    <div class="col-lg-3 mb-3 searchable" data-aos="fade-up" data-name="{{ $note->title }}">
        <div class="card tasks-box h-100">
            <div class="card-body">
                <div class="d-flex mb-2">
                    <h6 class="fs-15 mb-0 flex-grow-1 text-truncate task-title note_titles">{{ $note->title }}</h6>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill dropdown-icon"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item editBtn" data-bs-toggle="modal" href="#editModalNote" data-title="{{ $note->title }}" data-description="{{ $note->description }}" data-id="{{ $note->id }}" data-image="{{ $note->image }}"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                            <li><a class="dropdown-item deleteRecord" data-id="{{ $note->id }}"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-0">
                    <p class="text-muted mb-1 single-note-description mb-2">
                        <a href="javascript:void(0)" data-response="{{ $note->response ?? '' }}" data-bs-target="#aiModal" data-bs-toggle="modal" class="d-block note-title single-note-description-link" id="predictions-tour">
                            {{ Str::limit($note->description , 150 , '') }}
                            @if (Str::length($note->description) > 150)
                            <span class="dots"></span>
                            <span class="more" style="display: none;">{{ substr($note->description,150) }}</span>
                            @endif
                        </a>
                    </p>
                    <a data-bs-toggle="modal" href="#noteModal" class="badge badge-soft-primary cursor-pointer viewNote mb-2" data-id="{{ $note->id }}" data-title="{{ $note->title }}" data-description="{{ $note->description }}" data-image="{{ $note->image }}">View details</a>
                </div>
            </div>
            <div class="card-footer">
                <div class="mb-2">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-0"><span class="text-secondary">{{ $first_width }}% </span>of {{ $t }}</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-muted ms-2">{{ $note->created_at->format('Y-M-d') }}</span>
                        </div>
                    </div>
                    <div class="progress rounded-3 progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $first_width }}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="badge badge-soft-primary">{{ auth()->user()->Username }}</span>
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
    @else
    <div class="text-center">
        <img src="{{ asset('assets/images/no-data-found.png') }}" alt="img" class="img-fluid no_records">
    </div>
    @endif
    <!-- Notes Dynamic -->
</div>

<!-- View Note -->
<div class="modal fade zoomIn" id="noteModal" tabindex="-1" aria-labelledby="noteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                        <input type="hidden" name="id" id="id">
                        <h4 class="card-title" id="title_note"></h4>
                        <p class="card-text text-justify" id="note_description"></p>
                    </div>
                    <div class="mt-2 p-3">
                        <img id="imagepreviewNote" class="card-img-top img-fluid shadow-lg view-note-img" src="" alt="Card image cap" />
                    </div>
                </div><!-- end card -->
            </div>
        </div>
    </div>
</div>
<!--End View Note -->

<!-- Ai modal -->
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
                    <button class="btn btn-sm btn-info response_suggestion" data-bs-toggle="modal" data-suggestion="{{ $response->suggestions ?? '' }}" href="#suggestionModal">Suggestion</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Ai Note -->

<!-- Suggestion Modal -->
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
                    <button class="btn btn-sm btn-info response_suggestion" data-bs-toggle="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Suggestion Modal -->

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
                            <div class="mb-3">
                                <label for="boardName" class="form-label">Note Title</label>
                                <input type="text" class="form-control" placeholder="Enter Note title" name="title" autocomplete="off">
                                <div class="error-title"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="boardName" class="form-label">Note Description</label>
                                <textarea class="form-control" placeholder="Enter description" name="description" rows="5" style="resize: none;" autocomplete="off"></textarea>
                                <div class="error-description"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="boardName" class="form-label">Upload Image</label>
                                <input class="form-control" type="file" name="file" id="main_picture" autocomplete="off">
                            </div>

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
    $('#range').on('change', function() {
        if ($('#range').val() != '') {
            $('#cancel_search').removeClass('d-none');
        } else {
            $('#cancel_search').addClass('d-none');
        }
    });

    $('#cancel_search').on('click', function() {
        $('#range').flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            mode: "range"
        }).clear();
        window.location.reload();
    });

    var viewNoteModal = new bootstrap.Modal(document.getElementById("noteModal"), {});
    $(document).on('click', '.viewNote', function() {
        viewNoteModal.show();
        $('#id').val($(this).attr('data-id'));
        $('#title_note').text($(this).attr('data-title'));
        $('#note_description').text($(this).attr('data-description'));
        var image = $(this).attr('data-image');
        $('#imagepreviewNote').attr("src", "{{ asset('storage/notes') }}" + "/" + image);
    })

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
                        <div class="progress-bar progress_bar_inner progress-bar-record" role="progressbar" style="width: ${(response.predictions[key]*100).toFixed(1)}%;" aria-valuenow="25" data-width="${(response.predictions[key]*100).toFixed(1)}" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <div class="progress-bar progress_bar_inner progress-bar-record" role="progressbar" style="width: ${(response.harassment_predictions[key]*100).toFixed(1)}%;" aria-valuenow="25" data-width="${(response.harassment_predictions[key]*100).toFixed(1)}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                `)
            console.log(`${key}: ${response.harassment_predictions[key]}`);
        }
        setProgressColor()
    });

    function showResponse(a) {
        let response = JSON.parse(a.next('.response').html());
        console.log(response);
        $('.predictions').html('');
        for (const key in response.predictions) {

            $('.predictions').append(`
                <div class="mb-3">
                    <!-- Labels Example -->
                    <div class="progress progress_bar position-relative" style="background-color: #d5e0f1;">
                        <span class="progress-span-label" style="position: absolute;top:0;height:100%;line-height:19px;width:100%;text-align:center;color: #000000;">${key} ${(response.predictions[key]*100).toFixed(1)}%</span>
                        <div class="progress-bar progress_bar_inner progress-bar-record" role="progressbar" style="width: ${(response.predictions[key]*100).toFixed(1)}%;" aria-valuenow="25" data-width="${(response.predictions[key]*100).toFixed(1)}" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <div class="progress-bar progress_bar_inner progress-bar-record" role="progressbar" style="width: ${(response.harassment_predictions[key]*100).toFixed(1)}%;" aria-valuenow="25" data-width="${(response.harassment_predictions[key]*100).toFixed(1)}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                `)
            console.log(`${key}: ${response.harassment_predictions[key]}`);
        }
        setProgressColor()
    }

    var editModal = new bootstrap.Modal(document.getElementById("editModalNote"), {});
    $(document).on('click', '.deleteRecord', function() {

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

    function setProgressColor() {
        $('.progress-bar-record').each(function() {
            if ($(this).attr('data-width') >= 60) {
                $(this).prev('.progress-span-label').addClass('text-white');
            }
        });
    }

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

                    $('#createboardModal').modal().animate({
                        scrollTop: 0
                    }, 300);

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 3000);

                    window.location.reload();
                    $('.prompt').show()

                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');

                    $('#createboardModal').modal().animate({
                        scrollTop: 0
                    }, 300);


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


                    $('#editModalNote').modal().animate({
                        scrollTop: 0
                    }, '300');

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 3000);

                    window.location.reload();
                    $('.prompt').show()

                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');

                    $('#editModalNote').modal().animate({
                        scrollTop: 0
                    }, '300');


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
        altFormat: "F j, y",
        dateFormat: "y-m-d",
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

    $(document).on('click', '.editBtn', function() {
        editModal.show();
        $('#id').val($(this).attr('data-id'));
        $('#title').val($(this).attr('data-title'));
        $('#description').val($(this).attr('data-description'));
        var image = $(this).attr('data-image');
        $('#imagepreview').attr("src", "{{ asset('storage/notes') }}" + "/" + image);

    })

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
                    console.log(res.data);
                    $('.loader').addClass('d-none')
                    $('.note-box').html('');
                    let data = res.data;
                    for (var i = 0; i < data.length; i++) {
                        var string = data[i].description;
                        var length = 150;
                        var trimmedString = string.substring(0, length);
                        let jsonResponse = JSON.parse(data[i].response);
                        $('.note-box').append(`
                        <div class="col-lg-3">
                            <div class="card tasks-box h-100">
                                <div class="card-body">
                                    <div class="d-flex mb-2">
                                        <h6 class="fs-15 mb-0 flex-grow-1  task-title">
                                            <a href="javascript:void(0)" data-response="${data[i].response}" onclick="showResponse($(this))" data-bs-target="#aiModal" data-bs-toggle="modal" class="d-block">${data[i].title}</a>
                                            <template class="response">${data[i].response}</template>
                                        </h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill dropdown-icon"></i></a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <li><a class="dropdown-item editBtn" href="javascript:void(0)" data-title="${data[i].title}" data-description="${data[i].description}" data-id="${data[i].id}" data-image="${data[i].image}"><i class="ri-edit-2-line align-bottom me-2 text-muted"></i> Edit</a></li>
                                                <li><a class="dropdown-item deleteRecord" data-id="${data[i].id}"><i class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <p class="text-muted mb-3"><a href="javascript:void(0)" class="d-block note-title"> ${trimmedString}.</a></p>
                                        <a data-bs-toggle="modal" href="#noteModal" class="badge badge-soft-primary cursor-pointer viewNote mb-2" data-title="${data[i].title}" data-description="${data[i].description}" data-id="${data[i].id}" data-image="${data[i].image}">View details</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="mb-2">
                                        <div class="d-flex mb-1">
                                            <div class="flex-grow-1">
                                                <h6 class="text-muted mb-0"><span class="text-secondary">${ (Object.values(jsonResponse.predictions)[0]*100).toFixed(1)}% </span>of ${ Object.keys(jsonResponse.predictions)[0]}</h6>
                                            </div>
                                        </div>
                                        <div class="progress rounded-3 progress-sm">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: ${ (Object.values(jsonResponse.predictions)[0]*100).toFixed(1)}%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="badge badge-soft-primary">{{ auth()->user()->Username }}</span>
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
            error: function(e) {
                $('.loader').addClass('d-none')
                $('.note-box').append(`
                    <div class="text-center bg-white">
                        <img src={{ asset('assets/images/no-data-found.png') }} class="img-fuild" style="height:300px;"></img>
                    </div>`)
            }
        });
    });


    let hiddenCount = 0;
    $("#myInput").on("keyup keypress", function() {
        hiddenCount = 0;
        var value = $(this).val();
        $(".searchable").each(function(index) {
            $row = $(this);
            var id = $row.attr("data-name");
            var name = id.toLowerCase();

            if (name.indexOf(value) != 0) {
                $(this).hide();
                hiddenCount++;
            } else {
                $(this).show();
            }
        });
        if (hiddenCount == $('.searchable').length) {
            $('.no-records').html(`
                    <div id="no_record" class="text-center">
                        <img src="{{ asset('assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                    </div>
                `);
        } else {
            $(document).find('.no-records #no_record').remove();
        }
    });

    //Tour
    var tour = new Shepherd.Tour({
        defaultStepOptions: {
            cancelIcon: {
                enabled: !0
            },
            classes: "shadow-md bg-purple-dark",
            scrollTo: {
                behavior: "smooth",
                block: "center"
            },
        },
        useModalOverlay: {
            enabled: !0
        },
    });
    if ('{{ auth()->user()->tour_status }}' == 0) {
        document.querySelector("#logo-tour") &&
            tour.addStep({
                title: "Welcome Back !",
                text: "Click this button to create a new note",
                attachTo: {
                    element: "#logo-tour",
                    on: "bottom"
                },
                buttons: [{
                    text: "Next",
                    classes: "btn btn-success",
                    action: tour.next
                }, ],
            }),
            document.querySelector("#date-tour") &&
            tour.addStep({
                title: "Select Dates",
                text: "Select range of date to filter out data.",
                attachTo: {
                    element: "#date-tour",
                    on: "bottom"
                },
                buttons: [{
                        text: "Back",
                        classes: "btn btn-light",
                        action: tour.back
                    },
                    {
                        text: "Next",
                        classes: "btn btn-success",
                        action: tour.next
                    },
                ],
            }),
            document.querySelector("#filter-tour") &&
            tour.addStep({
                title: "Apply Filter",
                text: "Click here to apply filter.",
                attachTo: {
                    element: "#filter-tour",
                    on: "bottom"
                },
                buttons: [{
                        text: "Back",
                        classes: "btn btn-light",
                        action: tour.back
                    },
                    {
                        text: "Next",
                        classes: "btn btn-success",
                        action: tour.next
                    },
                ],
            }),
            document.querySelector("#predictions-tour") &&
            tour.addStep({
                title: "View Predictions",
                text: "Click anywhere on text to view AI predictions",
                attachTo: {
                    element: "#getproduct-tour",
                    on: "bottom"
                },
                buttons: [{
                        text: "Back",
                        classes: "btn btn-light",
                        action: tour.back
                    },
                    {
                        text: "Next",
                        classes: "btn btn-success",
                        action: tour.next
                    },
                ],
            }),
            tour.start();
        tour.on("complete", function() {
            $.ajax({
                type: "POST",
                url: "{{ route('check_tour_status') }}",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function() {},
                success: function(res) {
                    if (res.success) {
                        setTimeout(function() {
                            window.location.href.reload();
                        }, 2000);

                    } else {}
                },
                error: function(e) {}
            });
        });
    } else {
        console.log('Tour Completed');
    };
</script>
@endsection