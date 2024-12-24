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
                                <li class="breadcrumb-item"><a href="#">Order</a></li>
                                <li class="breadcrumb-item active">Order Cancel Request</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Order</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Order Cancel Request</h4>
                        </div>
                        <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"
                                    style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong></strong>State deleted successfully.
                                </div> -->
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-12 rightsetup-details">
                                    <div class="d-flex justify-content-between p-2 bd-highlight">
                                        <div>
                                        </div>
                                        <!-- <div>
                                                    <a href="{{ route('states.create') }}"
                                                        class="icon-link common-color" title="Create New role">
                                                        <i class="mdi mdi-plus-box" style="font-size: 22px;"></i>
                                                    </a>
                                                </div> -->
                                    </div>
                                    <div class="card-body">
                                        <table id="users-table"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Order ID</th>
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
    <div class="modal employe-resign-modal-center" id="resignModal" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body py-0">
                                    <form action="{{ route('orders.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" class="order_id" name="order_id" value=""
                                                id="order_id">

                                            <label for="employee_status"
                                                class="mandatory col-form-label col-sm-12 col-form-label">Order
                                                Status</label>
                                            <div class="col-sm-12 mb-4">
                                                <select id="order_status" class="form-control" name="order_status">
                                                    <option value="">Select</option>
                                                    <option value="4">Cancel</option>
                                                </select>
                                            </div>

                                           
                                        </div>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            ajax: '{{ route('order.cancel.request.data') }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'order_id',
                    name: 'order_id'
                },
                


                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                                                    <button onclick="openResignModal(${row.id})" class="icon-button custom-color">
    <i class="ri-edit-box-line" style="font-size: 18px;"></i>
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

    function openResignModal(id) {
        $.ajax({
            url: `/orders/${id}`, // Make sure this route returns the order data
            method: 'GET',
            success: function(order) {
                $('#order_id').val(order.id);
                $('#order_status').val(order.order_status);
                $('#payment_status').val(order.payment_status);
                $('#resignModal').modal('show');
            }
        });
    }

    function showOrders(id) {
        console.log("inside");

        window.location.href = 'order-show/' + id;
    }

    function editStates(id) {
        console.log("inside");
        // Redirect to the user edit page or open a modal for editing
        window.location.href = 'state-edit/' + id;
    }

    function deleteStates(id) {
        // Send an AJAX request to delete the user
        if (confirm('Are you sure you want to delete this State?')) {
            $.ajax({
                url: 'state-delete/' + id,
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