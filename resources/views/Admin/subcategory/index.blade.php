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
                                    <li class="breadcrumb-item">Category Management</li>
                                    <li class="breadcrumb-item">Sub Category</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Manage Sub Category</h4>
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
                                            href="#">Sub Category List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link rounded-0 pt-2 pb-2"
                                            href="{{ route('subcategory.create') }}">Create
                                            Sub Category</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body data_table_border_style">
                                            <table id="subcategory-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Category Name</th>
                                                        <th>SubcategoryName</th>
                                                        <th>Slug</th>
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

            table = $('#subcategory-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('subcategory.data') }}',
                columns: [{
                        data: null,
                        name: 'auto_increment_id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                return data === 1 ? 'Active' : 'Inactive';
            }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                           <button class="btn btn-edit py-0 px-0" onclick="editUsers(${row.id})"><i class="ri-edit-line" style="font-size: 20px;"></i></button>
                           <button  class="btn btn-delete py-0" onclick="deleteUsers(${row.id})"><i class="mdi mdi-delete-outline" style="font-size: 20px;"></i></button>

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

        function editUsers(id) {
            console.log("inside");

            window.location.href = 'subcategory/edit/' + id;
        }

        function deleteUsers(id) {

            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: 'subcategory/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {

                        toastr.success(result);
                        table.ajax.reload();
                    }
                });
            }
        }
    </script>
@endsection
