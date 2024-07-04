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
                                    <li class="breadcrumb-item"><a href="{{ route('show_case_products.index') }}">Show Case
                                            Product</a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Show Case Product</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Show Case Product List</h4>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="display:none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong></strong>Show Case Product deleted successfully.
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>
                                            </div>
                                            <div>
                                                <a href="{{ route('show_case_products.create') }}"
                                                    class="icon-link common-color" title="Create Show Case Product">
                                                    <i class="mdi mdi-plus-box" style="font-size: 22px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="users-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Show Case Product</th>
                                                        <th>Product</th>
                                                        <th>Status</th>
                                                        <th>Created By</th>
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
                ajax: '{{ route('show_case_products.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'show_case_title',
                        name: 'show_case_title'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'updated_by_name',
                        name: 'updated_by_name'
                    },




                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                           <button onclick="editshow_case_Products(${row.id})" class="icon-link common-color"><i class="ri-edit-box-line" style="font-size: 18px;"></i></button>
                           <button onclick="deleteshow_case_Products(${row.id})" class="icon-link common-color"><i class="mdi mdi-delete" style="font-size: 18px;"></i></button>
                                                 
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

        function editshow_case_Products(id) {
            console.log("inside");
            // Redirect to the user edit page or open a modal for editing
            window.location.href = 'show_case_product-edit/' + id;
        }

        function deleteshow_case_Products(id) {
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Show Case Product?')) {
                $.ajax({
                    url: 'show_case_product-delete/' + id,
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
