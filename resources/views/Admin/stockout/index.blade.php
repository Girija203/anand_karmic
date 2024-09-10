@extends('Admin.layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
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
                                    <li class="breadcrumb-item">Product Management</li>
                                    <li class="breadcrumb-item"><a href="#"> StockOut </a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                            <h4 class="page-title">StockOut </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                <a href="#" title="Stock List">
                                    <button class="header-title btn btn_primary_color">StockOut List</button>
                                </a>
                                {{-- <a href="{{route('product.create')}}" title="Create New role">
                                    <button class="header-title btn btn-gery"> <i class="mdi mdi-plus-box  pe-1"></i>Create
                                        Product</button>
                                </a> --}}
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="display:none;">
                                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                                <strong></strong> Product deleted successfully.
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between bd-highlight">

                                        </div>
                                        <div class="card-body data_table_border_style">
                                            <table id="outofstock-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>

                                                        <th>category </th>
                                                        <th>SubCategory</th>
                                                        <th>ChildCategory</th>
                                                        <th>Brand</th>
                                                        <th>Product Name</th>
                                                        <th>Image</th>
                                                       
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
    table = $('#outofstock-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('products.outOfStockData') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'category_name', name: 'category_name' },
            { data: 'subcategory_name', name: 'subcategory_name' },
            { data: 'childcategory_name', name: 'childcategory_name' },
            { data: 'brand', name: 'brand' },
            { data: 'product_name', name: 'product_name' },
            {
                data: 'image',
                name: 'image',
                render: function(data, type, row) {
                    return `<img src="${data}" width="50" height="50"/>`;
                }
            },
    
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                       <button class="btn py-0 px-0" onclick="editUsers(${row.id})"><i class="ri-edit-box-line text_danger_blue " style="font-size: 20px;"></i></button>
                       <button class="btn py-0" onclick="deleteUsers(${row.id})"><i class="mdi mdi-delete text_danger_red" style="font-size: 20px;"></i></button>
                    `;
                }
            }
        ],
        order: [[0, 'asc']],
        pageLength: 8
    });
});

        function editUsers(id) {
            console.log("inside");

            window.location.href = '/product/edit/' + id;
        }

        function deleteUsers(id) {

            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: '/product/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {

                        $('.alert-success').show();


                        setTimeout(function() {
                            $('.alert-success').alert('close');
                        }, 5000);


                        table.ajax.reload();
                    }
                });
            }
        }
    </script>
@endsection
