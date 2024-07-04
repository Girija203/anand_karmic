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
                                    <li class="breadcrumb-item">Product Management</li>
                                    <li class="breadcrumb-item"><a href="{{ route('review.index') }}"> Review</a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Review</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                <a href="#" title="Review List">
                                    <button class="header-title btn btn_primary_color">Review List</button>
                                </a>
                                {{-- <a href="{{route('brand.create')}}" title="Create New role">
                                    <button class="header-title btn btn-gery"> <i class="mdi mdi-plus-box  pe-1"></i>Create
                                      Brand</button>
                                </a> --}}
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="display:none;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong></strong> Brand deleted successfully.
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between bd-highlight">
                                            {{-- <div>
                                            </div> --}}
                                            {{-- <div>
                                                <a href="{{ route('users.create') }}" class="icon-link common-color"
                                                    title="Create New role">
                                                    <i class="mdi mdi-plus-box" style="font-size: 22px;"></i>
                                                </a>
                                            </div> --}}
                                        </div>
                                        <div class="card-body data_table_border_style">
                                            <table id="review-table"
                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>User Name</th>
                                                        <th>product Name</th>

                                                        <th>Review</th>
                                                        <th>Rating</th>
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
        <!-- start -->
        <div class="modal employe-resign-modal-center" id="resignModal" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Review Status</h5>
                        <button type="button" class="close" onclick="closeResignModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body py-0">
                                        <form action="{{ route('review.update') }}" method="POST"
                                            enctype="multipart/form-data" id="reviewForm">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" class="review_id" name="review_id" value=""
                                                    id="review_id">


                                                <label for="employee_name" class="col-sm-12 col-form-label mandatory">Review
                                                    Status</label>
                                                <div class="col-sm-12 mb-4">
                                                    <select class="form-control" name="status" id="">
                                                        <option value="">Select</option>
                                                        <option value="0">Unapprovel</option>
                                                        <option value="1">Approvel</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="error" style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary"
                                                onclick="closeResignModal()">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end  -->
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

            table = $('#review-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('review.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },


                    {
                        data: 'review',
                        name: 'review',


                    },
                    {
                        data: 'rating',
                        name: 'rating',


                    },

                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            // Check the status value
                            if (data == 0) {
                                return 'Unapproved';
                            } else if (data == 1) {
                                return 'Approved';
                            } else {
                                return 'Unknown'; // Handle any other status values
                            }
                        }
                    },



                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
      <button class="btn py-0 px-0" onclick="openReviewModal(${row.id})">
                <i class="ri-edit-box-line text_danger_blue " style="font-size: 20px;"></i>
            </button>   
                      

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


        function openReviewModal(reviewId) {
            document.getElementById('review_id').value = reviewId;
            $('#resignModal').modal('show');
        }


        function closeResignModal() {
            $('#resignModal').modal('hide');
        }
    </script>
@endsection
