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

                                    <li class="breadcrumb-item"><a href="#"> Subscriber </a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Send Email to All Subscriber </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                {{-- <a href="#" title="Create New role">
                                    <button class="header-title btn btn_primary_color">Inventory List</button>
                                </a> --}}
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="display:none;">
                                <strong></strong> stock deleted successfully.
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between bd-highlight">
                                        </div>
                                        <div class="card-body data_table_border_style">
                                            {{-- <h4 class="page-title">Send </h4> --}}
                                            <form class="row g-3" method="post" action="{{ route('newsletter.store') }}">
                                                @csrf
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <label for="subject" class="form-label">Subject</label>
                                                    <input type="text" class="form-control" id="subject" name="subject"
                                                        required value="{{ old('subject') }}">
                                                    @error('subject')
                                                        <span class="error" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea name="content" id="message" class="form-control text-area-5" cols="30" rows="10"></textarea>
                                                    @error('message')
                                                        <span class="error" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('subscriber.index') }}"
                                                        class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </form>
                                            <!-- Table to display stock entries -->
                                            <div class="table-responsive mt-5">
                                                <table id="subscriber-table"
                                                    class="table table-striped table-bordered dt-responsive nowrap"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Email</th>

                                                            {{-- <th>Action</th> --}}
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

            table = $('#subscriber-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('subscriber.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },




                    // {
                    //     data: null,
                    //     orderable: false,
                    //     searchable: false,
                    //     render: function(data, type, row) {
                    //         return `
                //        <button class="btn py-0 px-0" onclick="editUsers(${row.id})"><i class="ri-edit-box-line text_danger_blue " style="font-size: 20px;"></i></button>
                //        <button  class="btn py-0" onclick="deleteUsers(${row.id})"><i class="mdi mdi-delete text_danger_red" style="font-size: 20px;"></i></button>

                //    `;
                    //     }

                    // },
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
