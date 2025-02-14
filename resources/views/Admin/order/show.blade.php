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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                                    <li class="breadcrumb-item active">Show</li>
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
                                <h4 class="header-title">Show Order</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>
                                            </div>
                                        </div>
                                        <div class="section-body">
                                            <div class="invoice">
                                                <div class="invoice-print">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="invoice-title">
                                                                <h2><img src="" alt=""
                                                                        width="120px">{{ $order->user->name }}</h2>
                                                                <div class="invoice-number">Order No: {{ $order->order_no }}
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <address>
                                                                        <strong>Billing Information:</strong><br>
                                                                        {{ $billingAddress->address }},
                                                                        {{ $billingAddress->city }},
                                                                        {{ $billingAddress->state }},
                                                                        {{ $billingAddress->country }},
                                                                        {{ $billingAddress->pincode }},
                                                                    </address>

                                                                    <div class="col-md-6 text-md-right">
                                                                        <address>
                                                                            <strong>Shipping Information:</strong><br>
                                                                            {{ $shippingAddress->address ?? '' }},
                                                                            {{ $shippingAddress->city ?? '' }},
                                                                            {{ $shippingAddress->state ?? '' }},
                                                                            {{ $shippingAddress->country ?? '' }},
                                                                            {{ $shippingAddress->pincode ?? '' }},
                                                                        </address>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <address>
                                                                        <strong>Payment Information:</strong><br>
                                                                        Method: {{ $order->payment_method }}<br>
                                                                        Status:
                                                                        {{ $order->payment_status == 1 ? 'Success' : 'Pending' }}<br>
                                                                        Transaction: {{ $order->payment->transaction_id ?? 'N/A' }}

                                                                    </address>
                                                                </div>
                                                                <div class="col-md-6 text-md-right">
                                                                    <address>
                                                                        <strong>Order Information:</strong><br>
                                                                        Date: {{ $order->created_at->format('d-m-Y') }}<br>
                                                                        Shipping Cost: {{ $order->shipping_cost }}<br>
                                                                        Status:
                                                                        {{ $order->order_status == 0
                                                                            ? 'Pending'
                                                                            : ($order->order_status == 1
                                                                                ? 'In Progress'
                                                                                : ($order->order_status == 2
                                                                                    ? 'Delivered'
                                                                                    : ($order->order_status == 3
                                                                                        ? 'Completed'
                                                                                        : ($order->order_status == 4
                                                                                            ? 'Declined'
                                                                                            : 'Unknown')))) }}

                                                                    </address>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-md-12">
                                                            <div class="section-title">Order Summary</div>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-hover table-md">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th width="5%">#</th>
                                                                            <th width="25%">Product</th>
                                                                            <th width="10%" class="text-center">Unit
                                                                                Price
                                                                            </th>
                                                                            <th width="10%" class="text-center">Quantity
                                                                            </th>
                                                                            <th width="10%" class="text-right">Total</th>
                                                                        </tr>
                                                                        @foreach ($order->orderItems as $item)
                                                                            <tr>
                                                                                <td>{{ $item->product->id }}</td>
                                                                                <td>{{ $item->product->title }}</td>
                                                                                <td class="text-center">
                                                                                    {{ $item->quantity }}
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    {{ $item->unit_price }}
                                                                                </td>
                                                                                <td class="text-right">
                                                                                    {{ $item->total_price }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach


                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 order-status">
                                                                    <!-- <div class="section-title">Order Id</div> -->
                                                                    <form action="{{ route('orders.update') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf

                                                                        <input type="hidden" class="order_id"
                                                                            name="order_id" value="{{ $order->id }}"
                                                                            id="order_id">
                                                                        <div class="form-group">
                                                                            <label for="">Payment Status</label>
                                                                            <select class="form-control"
                                                                                name="payment_status" id="payment_status">
                                                                                <option value="">Select</option>
                                                                                <option value="0"
                                                                                    {{ $order->payment_status == 0 ? 'selected' : '' }}>
                                                                                    Pending</option>
                                                                                <option value="1"
                                                                                    {{ $order->payment_status == 1 ? 'selected' : '' }}>
                                                                                    Success</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Order Status</label>
                                                                            <select id="order_status" class="form-control"
                                                                                name="order_status">
                                                                                <option value="">Select</option>
                                                                                <option value="0"
                                                                                    {{ $order->order_status == 0 ? 'selected' : '' }}>
                                                                                    Pending</option>
                                                                                <option value="1"
                                                                                    {{ $order->order_status == 1 ? 'selected' : '' }}>
                                                                                    In Progress</option>
                                                                                <option value="2"
                                                                                    {{ $order->order_status == 2 ? 'selected' : '' }}>
                                                                                    Shipped</option>
                                                                                <option value="3"
                                                                                    {{ $order->order_status == 3 ? 'selected' : '' }}>
                                                                                    Delivered</option>
                                                                                <option value="4"
                                                                                    {{ $order->order_status == 4 ? 'selected' : '' }}>
                                                                                    Cancel</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="">Assign Delivery
                                                                                Man</label>
                                                                            <select name="delivery_man_id"
                                                                                class="form-control select2 select2-hidden-accessible"
                                                                                tabindex="-1" aria-hidden="true"
                                                                                data-select2-id="select2-data-5-bj61">
                                                                                <option value="">Select</option>
                                                                                <option value="0">Unknown</option>
                                                                                <option value="1">Gopi</option>
                                                                            </select>
                                                                            <!-- <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-6-jfzu" style="width: 427px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-delivery_man_id-rr-container" aria-controls="select2-delivery_man_id-rr-container"><span class="select2-selection__rendered" id="select2-delivery_man_id-rr-container" role="textbox" aria-readonly="true" title="Select">Select</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                                                                        </div>
                                                                        <br>
                                                                        <button class="btn btn-primary"
                                                                            type="submit">Update
                                                                            Status</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
    @endsection
