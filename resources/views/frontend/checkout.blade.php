@extends('frontend.layouts.app')

@section('content')

    <main>
        <section class="breadcrumb-section border-top-1 py-5">
            <div class="container-full px-50">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-start">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            checkout
                        </li>
                    </ol>
                </nav>
            </div>
        </section>
        <!-- Checkout Section Start -->
        <section class="checkout-section section-space-ptb border-bottom-1">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="coupon-area">
                            <!-- coupon-accordion start -->

                            <!-- coupon-accordion end -->
                        </div>
                    </div>
                </div>
                <!-- checkout-details-wrapper start -->
                <div class="checkout-details-wrapper">
                    <div class="row gy-8 gx-lg-10">
                        <div class="col-lg-6 col-md-6">
                            <!-- billing-details-wrap start -->
                            <div class="billing-details-wrap">
                                <form action="{{ route('placeorder') }}" method="POST" id="orderForm">
                                    @csrf


                                    <h4 class="shoping-checkboxt-title">BILLING DETAILS</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" id="name"
                                                    name="name" placeholder="First name *"
                                                    value="{{ $billingAddress->name ?? '' }}">
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_name"></span>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="email" id="email"
                                                    name="email" placeholder="email *"
                                                    value="{{ $billingAddress->email ?? '' }}">
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_email"></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" id="mobile"
                                                    name="mobile" placeholder="Phone *"
                                                    value="{{ $billingAddress->mobile ?? '' }}">
                                            </div>
                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_mobile"></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" id="country"
                                                    name="country"
                                                    placeholder="country *"value="{{ $billingAddress->country ?? '' }}">
                                            </div>
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_country"></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" id="state"
                                                    name="state"
                                                    placeholder="State *"value="{{ $billingAddress->state ?? '' }}">
                                            </div>
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_state"></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" id="city"
                                                    name="city" placeholder="city *"
                                                    value="{{ $billingAddress->city ?? '' }}">
                                            </div>
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_city"></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" id="address"
                                                    name="address" placeholder="Address *"
                                                    value="{{ $billingAddress->address ?? '' }}">
                                            </div>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_address"></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" id="pincode"
                                                    name="pincode"
                                                    placeholder="pincode *"value="{{ $billingAddress->pincode ?? '' }}">
                                            </div>
                                            @error('pincode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <span class="text-danger" id="error_pincode"></span>
                                        </div>
                                        @php
                                            use App\Models\Addresses; // Move the 'use' statement here
                                        @endphp

                                        @if (!empty($shippingAddress) && $shippingAddress->count() > 0)
                                            <!-- Shipping Address Starts -->
                                            <!-- shipping Address Starts -->

                                            <section class="cart-page-section border-bottom-1 mt-3">
                                                <h4>Shipping Address</h4>
                                                <div class="">
                                                    <div class="row gy-8">
                                                        <div class="col-lg-12">
                                                            @php
                                                                $user = auth()->user();
                                                                $shippingAddresses = Addresses::where(
                                                                    'user_id',
                                                                    $user->id,
                                                                )
                                                                    ->where('type', 1) // Shipping address
                                                                    // ->where('default_shipping', 1) // Default shipping address
                                                                    ->get();
                                                                $firstAddressId = $shippingAddresses->first()
                                                                    ? $shippingAddresses->first()->id
                                                                    : null;
                                                            @endphp

                                                            @foreach ($shippingAddresses as $address)
                                                                <div class="row my-3">
                                                                    <div class="col-md-9">

                                                                        <div
                                                                            class="customer-detailaddress d-flex flex-column text-black">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="shipping_address"
                                                                                    id="flexRadioDefault{{ $address->id }}"
                                                                                    value="{{ $address->id }}"
                                                                                    {{ $address->id === $firstAddressId ? 'checked' : '' }} />
                                                                                <label class="form-check-label"
                                                                                    for="flexRadioDefault{{ $address->id }}">
                                                                                    <h5 class="fs-20 fw-500">
                                                                                        {{ $address->name }}
                                                                                    </h5>
                                                                                </label>
                                                                                <input type="hidden"
                                                                                    name="selected_shipping_address_id"
                                                                                    value="{{ $firstAddressId }}">
                                                                            </div>

                                                                            <p class="fs-15 pl-1em">
                                                                                {{ $address->address }}
                                                                            </p>
                                                                            <p class="fs-16 pl-1em">Contact -(+91)
                                                                                {{ $address->mobile }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="d-flex justify-content-between">
                                                                            <a
                                                                                href="{{ route('edit.shipping.address', $address->id) }}">
                                                                                <span
                                                                                    class="fs-16 fw-500 text-black">Edit</span>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('remove.shipping.address', $address->id) }}">
                                                                                <span
                                                                                    class="fs-16 fw-500 text-danger">Remove</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div class="p-3 my-3"
                                                                style="border-top: 1px solid rgba(186, 186, 186, 0.444)">
                                                                <a href="{{ route('add.shipping.address') }}">
                                                                    <p class="fs-6 text-success px-5">Add Address</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- shipping Address Ends -->
                                        @else
                                            <label id="chekout-box-2" class="fs-16 mt-3">
                                                <input type="checkbox" value="1" id="ship-toggle"
                                                    name="ship_different">
                                                Ship to a different address?
                                            </label>
                                        @endif


                                        <div class="col-lg-12">
                                            <div class="checkout-box-wrap mt-4">


                                                <div class="ship-box-info" id="shipping-address-form"
                                                    style="display: none;">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="text"
                                                                    name="shipping_name" placeholder="name *">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="email"
                                                                    name="shipping_email" placeholder="email">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="text"
                                                                    name="shipping_mobile" placeholder="Phone">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="text"
                                                                    name="shipping_country" placeholder="country">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="text"
                                                                    name="shipping_state" placeholder="state name">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="text"
                                                                    placeholder="city name" name="shipping_city">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="text"
                                                                    placeholder="Address" name="shipping_address">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="checkout-form-row">
                                                                <input class="checkout-form-input" type="text"
                                                                    name="shipping_pincode" placeholder="Postcode *">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12">
                        <div class="checkout-form-row">
                          <label class="checkout-form-label">Order notes</label>
                          <textarea
                            class="checkout-form-textarea"
                            placeholder="Notes about your order, e.g. special notes for delivery."
                          ></textarea>
                        </div>
                      </div> --}}
                                    </div>
                                    {{-- </form> --}}
                            </div>
                            <!-- billing-details-wrap end -->
                        </div>
                        <div class="col-lg-6 col-md-6">
                            @php
                                $totalAmount = 0;
                                $cartItems = $cart;
                            @endphp

                            @foreach ($cartItems as $item)
                                @php
                                    $offerPrice =
                                        \App\Models\ProductColor::where('product_id', $item->product_id)->min(
                                            'offer_price',
                                        ) ?:
                                        $item->product->offer_price;
                                    $totalAmount += $item->quantity * $offerPrice;
                                @endphp
                            @endforeach

                            @php
                                $shippingFee = session('shippingFee', 0);
                                $res_coupon = session('res_coupon', 0);
                                $finalTotalAmount = $totalAmount + $shippingFee;
                                $finalAmountToPay = $finalTotalAmount - $res_coupon;

                                $exchangeRate = session('exchange_rate', 1);
                                $currencySymbol = session('currency_symbol', '₹');

                                $totalAmount *= $exchangeRate;
                                $shippingFee *= $exchangeRate;
                                $finalTotalAmount *= $exchangeRate;
                                $finalAmountToPay *= $exchangeRate;

                                foreach ($cartItems as $item) {
                                    $item->price *= $exchangeRate;
                                }
                            @endphp
                            <!-- Order Summary-wrapper start -->
                            <div class="order-summary">
                                <h4 class="shoping-checkboxt-title mb-4 text-center">
                                    YOUR ORDER
                                </h4>
                                <!-- your-order-wrap start-->
                                <div class="order-summary-wrap">
                                    <!-- order-summary-table start -->
                                    <div class="order-summary-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cartItems as $item)
                                                    <tr class="cart_item">
                                                        <td class="product-name">
                                                            {{ $item->product->title }}
                                                            <strong class="product-quantity"> ×
                                                                {{ $item->quantity }}</strong>
                                                        </td>
                                                        <td class="product-total">
                                                            {{ $currencySymbol }}<span
                                                                class="amount">{{ number_format($item->quantity * $item->price, 2) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>Cart Subtotal</th>
                                                    <td>{{ $currencySymbol }}<span
                                                            class="amount">{{ number_format($totalAmount, 2) }}</span>
                                                    </td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>Shipping Cost</th>
                                                    <td>{{ $currencySymbol }}<span
                                                            class="amount">{{ number_format($shippingFee, 2) }}</span>
                                                    </td>
                                                </tr>
                                                <tr class="cart-subtotal">
                                                    <th>Coupon Discount</th>
                                                    <td>{{ $currencySymbol }}<span
                                                            class="amount">{{ number_format($res_coupon, 2) }}</span></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Order Total</th>
                                                    <td><strong>{{ $currencySymbol }}<span
                                                                class="amount">{{ number_format($finalAmountToPay, 2) }}</span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- your-order-table end -->

                                    <!-- your-order-wrap end -->

                                    <div class="col-lg-12">
                                        <div class="checkout-form-row">
                                            <label>
                                                <input type="radio" name="payment_method" value="stripe"
                                                    id="stripe-option"> Stripe
                                            </label>
                                            <label>
                                                <input type="radio" name="payment_method" value="razorpay"
                                                    id="razorpay-option"> Razorpay
                                            </label>
                                            <label>
                                                <input type="radio" name="payment_method" value="cod"
                                                    id="cod-option"> Cash on Delivery
                                            </label>
                                        </div>
                                        @error('payment_method')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger" id="error_payment_method"></span>
                                    </div>

                                    <div id="stripe-form" style="display: none;">
                                        <div class="form-group">
                                            <label for="card-element">Credit or debit card</label>
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                    </div>

                                    <!-- <div id="razorpay-form" style="display: none;">
              <button id="razorpay-button" type="button">Pay with Razorpay</button>
              <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
          </div> -->

                                    <input type="hidden" name="shipping_fee" value="{{ $shippingFee }}">
                                    <input type="hidden" name="coupon_discount" value="{{ $res_coupon }}">

                                    <div class="text-center border-top-1 pt-4">
                                        <button type="button" class="btn btn-primary btn-full btn-md"
                                            onclick="validateForm()">Place Order</button>
                                    </div>
                                    <div class="text-danger" id="error_order_total"></div>
                                    <!-- your-order-wrapper start -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- checkout-details-wrapper end -->
            </div>
        </section>
        <!-- Checkout Section End -->
    </main>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>


    <!-- testing start -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addressInput = document.getElementById('address');
            var addressDetailsDiv = document.getElementById('address-details');
            var displayedAddress = document.getElementById('displayed-address');

            addressInput.addEventListener('blur', function() {
                var addressValue = addressInput.value.trim();
                if (addressValue) {
                    displayedAddress.textContent = addressValue;
                    addressDetailsDiv.style.display = 'block';
                } else {
                    addressDetailsDiv.style.display = 'none';
                }
            });
        });
    </script>

    <!-- testing end -->
    <script>
        var stripe = Stripe(
            'pk_test_51P8d5PSGxcIrVgVcJoxGtRjnHbUTsAbYQEUn6McgRqIqPaaQkaIhBx5ecPc1IDhuo7IIYG49cC4J5zeSxnf7XCay00B3fbQZJq'
        ); // Replace with your Stripe publishable key
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');


        function validateForm() {
            var name = $('#name').val().trim();
            var email = $('#email').val().trim();
            var mobile = $('#mobile').val().trim();
            var address = $('#address').val().trim();
            var country = $('#country').val().trim();
            var state = $('#state').val().trim();
            var city = $('#city').val().trim();
            var pincode = $('#pincode').val().trim();
            var paymentMethod = $('input[name="payment_method"]:checked').val();

            // Reset error messages
            $('.text-danger').text('');

            var isValid = true;

            if (name === '') {
                $('#error_name').text('Name is required');
                isValid = false;
            }
            if (email === '') {
                $('#error_email').text('Email is required');
                isValid = false;
            }
            if (mobile === '') {
                $('#error_mobile').text('Phone is required');
                isValid = false;
            }
            if (address === '') {
                $('#error_address').text('Address is required');
                isValid = false;
            }
            if (country === '') {
                $('#error_country').text('Country is required');
                isValid = false;
            }
            if (state === '') {
                $('#error_state').text('State is required');
                isValid = false;
            }
            if (city === '') {
                $('#error_city').text('City is required');
                isValid = false;
            }
            if (pincode === '') {
                $('#error_pincode').text('Pincode is required');
                isValid = false;
            }
            if (!paymentMethod) {
                $('#error_payment_method').text('Payment method is required');
                isValid = false;
            }
            if (isValid) {
                // Disable the button
                var placeOrderButton = $('.btn.btn-primary.btn-full.btn-md');
                placeOrderButton.prop('disabled', true);

                // Set a timeout to re-enable the button after 10 seconds
                setTimeout(function() {
                    placeOrderButton.prop('disabled', false);
                }, 10000);
            }
            if (finalAmountToPay === 0) {
        $('#error_order_total').text('Order total cannot be zero. Please add items to your cart.');
        isValid = false;
    }

            if (isValid) {
                if (paymentMethod === 'cod') {
                    $('#orderForm').submit();
                } else if (paymentMethod === 'razorpay') {
                    handleRazorpayPayment();
                } else if (paymentMethod === 'stripe') {
                    handleStripePayment();
                }
            }
        }
        var currencySymbol = @json($currencySymbol);
        var finalAmountToPay = @json($finalAmountToPay);

        function handleRazorpayPayment() {
            if (currencySymbol === '₹') {
                var amountInPaise = Math.round(finalAmountToPay * 100); // Convert to paise and round off

                if (amountInPaise < 100) {
                    alert('Invalid amount. The minimum amount should be ₹1.');
                    return;
                }

                var options = {
                    key: 'rzp_test_Pr8rSFGW98gREc',
                    amount: amountInPaise,
                    currency: 'INR',
                    name: 'Karmic',
                    description: 'Payment for Order',
                    image: 'path_to_your_logo.png',
                    handler: function(response) {
                        $('#razorpay_payment_id').val(response.razorpay_payment_id);
                        $('#orderForm').submit();
                    }
                };

                var rzp = new Razorpay(options);
                rzp.open();
            } else {
                alert('Razorpay payment gateway is only available for payments in INR.');
            }
        }

        function handleStripePayment() {
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        }

        function stripeTokenHandler(token) {
            var form = document.getElementById('orderForm');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

        $(document).ready(function() {
            $('input[name="payment_method"]').on('change', function() {
                var paymentMethod = $(this).val();
                if (paymentMethod === 'stripe') {
                    $('#stripe-form').show();
                    $('#razorpay-form').hide();
                } else if (paymentMethod === 'razorpay') {
                    $('#razorpay-form').show();
                    $('#stripe-form').hide();
                } else {
                    $('#stripe-form').hide();
                    $('#razorpay-form').hide();
                }
            });
        });
    </script>

    <!-- JavaScript code -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // When a radio button is clicked
            $('input[name="shipping_address"]').click(function() {
                // Get the value of the selected radio button (which is the ID of the shipping address)
                var selectedShippingAddressId = $(this).val();

                // Assign the selected ID to the hidden input field
                $('input[name="selected_shipping_address_id"]').val(selectedShippingAddressId);
            });
        });
    </script>



    <!-- Product Modal End -->
    <script src="{{ asset('/frontend/assets/js/modernizr-3.11.7.min.js') }}"></script>


    <!-- Plugins JS -->
    <script src="{{ asset('/frontend/assets/js/swiper-bundle.min.js') }}"></script>

    <!-- <script src="{{ asset('/frontend/assets/js/ajax.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@endsection
