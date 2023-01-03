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
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Job</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @if($user->count() > 0)
                                @foreach ($user as $u)
                                <tr>
                                    <td><a href="#" class="fw-medium">{{ $loop->index+1 }}</a></td>
                                    <td>{{ $u->fullname }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td class="text-capitalize">{{ $u->gender }}</td>
                                    <td>{{ $u->Job_designation }}</td>
                                    <td>{{ $u->company_name }}</td>
                                    <td><a class="badge bg-success" href="{{ route('admin_user_notes' , $u->id ) }}">User Notes</a></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a class="btn btn-sm btn-secondary" href="{{ route('update_user' , $u->id ) }}"><i class="ri-edit-fill "></i></a>
                                            <a class="btn btn-sm btn-danger deleteRecord" data-id="{{ $u->id }}"><i class="ri-delete-bin-fill "></i></a>
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
                            {{ $user->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection

@section('custom-script')

<script>
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
                    url: "{{ route('delete_user') }}",
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