@extends('Admin.layouts.app')
@section('content')
    @include('Admin.links.css.datatable.datatable-css')
    @include('Admin.links.css.table.custom-css')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">Manage Product</li>
                                    <li class="breadcrumb-item active">Colors</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Color</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-0 pt-2 pb-2" aria-current="page"
                                            href="#">Products Color List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link rounded-0 pt-2 pb-2" href="{{ route('colors.create') }}">Add
                                            Color</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body">
                                            <table id="users-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Code</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row-->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Karmic - Theme by <b>Syscorp</b>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


    @include('Admin.links.js.datatable.datatable-js')

    <script>
        var table;


        $(document).ready(function() {

            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('colors.data') }}',
                columns: [{
                        data: null,
                        name: 'auto_increment_id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code',
                        render: function(data, type, row, meta) {
                            return `<div style="display: flex; align-items: center;">
                        <div style="width: 20px; height: 20px; background-color: ${data}; margin-right: 10px;"></div>
                        <span>(${data})</span>
                    </div>`;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                           <button class="btn btn-edit py-0 px-0" onclick="editColors(${row.id})"><i class="ri-edit-line" style="font-size: 20px;"></i></button>
                           <button class="btn btn-delete py-0 px-0" onclick="deleteColors(${row.id})"><i class="mdi mdi-delete-outline" style="font-size: 20px;"></i></button>                
                       `;
                        }

                    },
                ],
                order: [
                    [0, 'asc']
                ],
                select: true,
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'print'
                ],
                pageLength: 8
            });


        });

        function editColors(id) {
            console.log("inside");
            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/color/edit/' + id;
        }

        function deleteColors(id) {
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Color?')) {
                $.ajax({
                    url: '/color/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        // Show success message
                        toastr.success(result);
                        // Reload the DataTable after success message is shown
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }
        }
    </script>
@endsection
