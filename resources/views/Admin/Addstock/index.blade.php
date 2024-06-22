@extends('Admin.layouts.app')
@section('content')
    @include('Admin.links.css.datatable.datatable-css')
    @include('Admin.links.css.table.custom-css')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory Management</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"> Inventory </a></li>
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
                            <div class="card-header py-1 pt-2">
                                <a href="#" title="Create New role">
                                    <button class="header-title btn btn_primary_color">Inventory List</button>
                                </a>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display:none;">
                                <strong></strong> stock deleted successfully.
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between bd-highlight">
                                        </div>
                                        <div class="card-body data_table_border_style">
                                            <h4 class="page-title">Add Stock for {{ $product->title }}</h4>
                                            <form class="row g-3" method="post" action="{{ route('stock.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <input type="hidden" id="productId" name="product_id" value="{{ $product->id }}">

                                                <div class="col-md-6">
                                                    <label for="stock_in" class="form-label">Stock In</label>
                                                    <input type="number" class="form-control" id="stock_in" name="stock_in" required value="{{ old('stock_in') }}">
                                                    @error('stock_in')
                                                        <span class="error" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </form>

                                            <!-- Table to display stock entries -->
                                            <div class="table-responsive mt-5">
                                                <table id="stock-table" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Stock In</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Table body will be filled by DataTables -->
                                                    </tbody>
                                                </table>
                                            </div>
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
                        </script> © Velonic - Theme by <b>Techzaa</b>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 

    <script>
         var token = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            var productId = {{ $product->id }};
            $('#stock-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('stock.data', ['product' => $product->id]) }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'stock_in', name: 'stock_in' },
                    { data: 'created_at', name: 'created_at' },
                    { data: null, orderable: false, searchable: false, render: function(data, type, row) {
                        return `
                           
                            <button  class="btn py-0" onclick="deleteUsers(${row.id})"><i class="mdi mdi-delete text_danger_red" style="font-size: 20px;"></i></button>
                        `;
                    }}
                ],
                order: [[0, 'asc']],
                dom: 'lBfrtip',
                buttons: ['excel', 'print'],
                pageLength: 8
            });
        });

        // function editUsers(id) {
        //     console.log("inside");
        //     window.location.href = 'brand/edit/' + id;
        // }

        function deleteUsers(id) {
            if (confirm('Are you sure you want to delete this stock?')) {
                $.ajax({
                    url: '/stock/delete/' + id,
                    type: 'get',
                    headers: {
                    'X-CSRF-TOKEN': token
                },
                    success: function(result) {
                        $('.alert-success').show();
                        setTimeout(function() {
                            $('.alert-success').alert('close');
                        }, 5000);
                        $('#stock-table').DataTable().ajax.reload();
                    }
                });
            }
        }
    </script>
@endsection
