@extends('admin.layout.layout',['custom_scripts'=> [
'grid'
]])

@section('title' , 'JournAI | Notes')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">JournAI</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">User Notes</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    @foreach($notes as $note)
    @php
    $response = json_decode($note->response);
    @endphp
    @endforeach
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">User Notes</h4>

                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <input class="form-control" placeholder="Search by name" type="text" id="myInput" onkeyup="myFunction()">
                    </div>
                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">AI Analytics</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @if($notes->count() > 0)
                                @foreach ($notes as $n)
                                <tr>
                                    <td><a href="#" class="fw-medium">{{ $loop->index+1 }}</a></td>
                                    <td>{{ $n->getUser->Username }}</td>
                                    <td>{{ $n->getUser->company_name }}</td>
                                    <td>{{ $n->title }}</td>
                                    <td>
                                        <div>
                                            <img src="{{ $n->getImage() }}" class="img-fluid note_img">
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success note-title" onclick="openResponse()" data-response="{{ $n->response }}">Predictions</span></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a type="button" class="btn btn-sm btn-secondary viewPost" data-bs-toggle="modal" href="#viewPost" data-title="{{ $n->title }}" data-description="{{ $n->description }}" data-img="{{ $n->image }}"><i class="ri-eye-fill "></i></a>
                                            <a class="btn btn-sm btn-danger deleteRecord" data-id="{{ $n->id }}"><i class="ri-delete-bin-fill "></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center">
                                            <img src="{{ asset('assets/images/no-data-found.png') }}" alt="img" class="img-fluid no_records">
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $notes->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<!-- Response Modal -->
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
<!-- End Response Modal -->


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
                    <button class="btn btn-sm btn-info response_suggestion" data-bs-toggle="modal" data-suggestion="{{ $response->suggestions ?? '' }}" href="#suggestionModal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="viewPost" tabindex="-1" aria-labelledby="viewPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text text-muted text-justify" id="description"></p>
                    </div>
                    <div class="noteImg"></div>
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
        setProgressColor();
    });

    function setProgressColor() {
        $('.progress-bar-record').each(function() {
            if ($(this).attr('data-width') >= 60) {
                $(this).prev('.progress-span-label').addClass('text-white');
            }
        });
    }

    var aiModal = new bootstrap.Modal(document.getElementById("aiModal"), {});

    function openResponse() {
        aiModal.show();
    }

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
                    url: "{{ route('delete_notes') }}",
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
                            }, 100);
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

    $('.viewPost').on('click', function() {
        $('#description').text($(this).attr('data-description'));
        $('#noteTitle').text($(this).attr('data-title'));
        let image = $(this).attr('data-img');
        if ($(this).attr('data-img') == "") {
            $('.noteImg').html('')
            $('.noteImg').append(`
                <img class="card-img-bottom img-fluid" src="{{ asset('assets/images/small/img-11.jpg') }}" alt="Card image">
            `);
        } else {
            $('.noteImg').html('')
            $('.noteImg').append(`<img class="card-img-bottom img-fluid" src="{{ asset("storage/notes/") }}/${image}" alt="Card image cap">`);
        }
    });

    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        let hiddenCount = 0;
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                    hiddenCount++;
                }
            }
        }
        if (hiddenCount === $('#myTable tr').length) {
            $('#myTable').append(`
                  <tr id="no_record">
                    <td colspan="7" class="text-center">No records found</td>
                  </tr>`);
        } else {
            $(document).find('#no_record').remove();
        }
    }
</script>
@endsection