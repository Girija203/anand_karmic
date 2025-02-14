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

                                    <li class="breadcrumb-item"><a href="#"> Inventory </a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Product </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                <a href="#" title="Inventory List">
                                    <button class="header-title btn btn_primary_color">Inventory List</button>
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
                                            <table id="inventory-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>

                                                        <th>Product Name</th>
                                                        <th>SKU </th>
                                                        <th>Stock</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

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
    table = $('#inventory-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('inventory.data') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'sku', name: 'sku' }, // SKU from product_colors
            { data: 'qty', name: 'qty' }, // Stock (qty) from product_colors

            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                       <button class="btn py-0 px-0" onclick="editUsers(${row.id})">
                           <i class="mdi mdi-eye text-success" style="font-size: 20px;"></i>
                       </button>
                   `;
                }
            },
        ],
        order: [[0, 'asc']],
        select: true,
        dom: 'lBfrtip',
        buttons: ['excel', 'print'],
        pageLength: 8
    });
});

        // function editUsers() {
        //     console.log("inside");

        //     window.location.href = '/stock/index';
        // }

        function editUsers(productId) {
            console.log("inside");
            window.location.href = '/stock/index/' + productId;
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
