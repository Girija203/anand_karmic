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
                                    <li class="breadcrumb-item"><a href="#">Faq</a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Faq</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Faq List</h4>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="display:none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong></strong>Faq deleted successfully.
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>
                                            </div>
                                            <div>
                                                <a href="{{ route('faq.create') }}" class="icon-link common-color"
                                                    title="Create FAQ">
                                                    <i class="mdi mdi-plus-box" style="font-size: 22px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="faq-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Question</th>
                                                        <th>Answer</th>
                                                        <th>Status</th>
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

            table = $('#faq-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('faq.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'questions',
                        name: 'questions'
                    },
                    {
                        data: 'answers',
                        name: 'answers'
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
                           <button onclick="editCities(${row.id})" class="icon-link common-color"><i class="ri-edit-box-line text_danger_blue" style="font-size: 18px;"></i></button>
                           <button onclick="deleteCities(${row.id})" class="icon-link common-color"><i class="mdi mdi-delete text_danger_red" style="font-size: 18px;"></i></button>
                                                 
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

        function editCities(id) {
            console.log("inside");
            // Redirect to the user edit page or open a modal for editing
            window.location.href = '/faq/edit/' + id;
        }

        function deleteCities(id) {
            // Send an AJAX request to delete the user
            if (confirm('Are you sure you want to delete this Faq?')) {
                $.ajax({
                    url: '/faq/delete/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        // Show success message
                        $('.alert-success').show();

                        // Hide success message after 5 seconds
                        setTimeout(function() {
                            $('.alert-success').alert('close');
                        }, 5000);

                        // Reload the DataTable after success message is shown
                        table.ajax.reload(); // Reload the DataTable
                    }
                });
            }
        }
    </script>
@endsection
