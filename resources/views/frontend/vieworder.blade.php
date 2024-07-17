@extends('frontend.layouts.app')

@section('content')
    <div class="section-body d-flex justify-content-center">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title text-center">
                            <h2><img src="" alt="" width="120px"></h2>
                            <div class="invoice-number">Order #{{ $order->order_no }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Billing Information:</strong><br>
                                    {{ $order->user->addresses[0]->address }},
                                    {{ $order->user->addresses[0]->city }},
                                    {{ $order->user->addresses[0]->state }},
                                    {{ $order->user->addresses[0]->country }},
                                    {{ $order->user->addresses[0]->pincode }},
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Shipping Information:</strong><br>
                                    {{ $order->user->addresses[0]->address }},
                                    {{ $order->user->addresses[0]->city }},
                                    {{ $order->user->addresses[0]->state }},
                                    {{ $order->user->addresses[0]->country }},
                                    {{ $order->user->addresses[0]->pincode }},
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Payment Information:</strong><br>
                                    Method: {{ $order->payment_method }}<br>
                                    Payment Status: <span
                                        class="badge badge-success">{{ $order->payment_status }}</span><br>
                                    Transaction: <p>{{ $order->transection_id }}</p>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Order Information:</strong><br>
                                    Date: {{ $order->created_at->format('F d, Y') }}<br>
                                    Shipping: {{ $order->shipping_method }}<br>
                                    Order Status: <span
                                        class="">
                                        {{ $order->order_status == 0 ? 'Pending' : 'Success' }}
                                    </span>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Product</th>
                                    {{-- <th width="20%">Variant</th>
                                <th width="10%">Shop Name</th> --}}
                                    <th width="10%" class="text-center">Unit Price</th>
                                    <th width="10%" class="text-center">Quantity</th>
                                    <th width="10%" class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="">{{ $item->product->title }}</a></td>
                                        {{-- <td></td>
                                <td></td> --}}
                                        <td class="text-center">Rs.{{ number_format($item->unit_price, 2) }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-right">Rs.{{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
