 @extends('frontend.layouts.app')

 @section('content')
     <style>
         .plus__minus_btn {
             border: none;
             width: 34px;
             height: 34px;
         }
     </style>

     <main>
         <section class="cart-page-section section-space-ptb border-bottom-1">
             <div class="container">
                 <div class="row gy-8">
                     <div class="col-lg-8">
                         <h5 class="fw-500">
                             Cart
                             <span class="color-grey fs-6 text-uppercase px-2">{{ $cartcount }} Items</span>
                         </h5>
                         <form class="cart-form" action="{{ route('update.cart') }}" method="POST">
                             @csrf
                             <div class="table-responsive">
                                 <table class="cart-wishlist-table table align-middle">
                                     <tbody>
                                         @if ($cart->isEmpty())
                                             <tr>
                                                 <td colspan="3" class="text-center">
                                                     Your cart is empty.
                                                 </td>
                                             </tr>
                                         @else
                                             @foreach ($cart as $item)
                                                 <tr>
                                                     <td class="thumbnail">
                                                         <a href="#" style="width: 100px;">
                                                             <img src="{{ asset('storage/' . $item->image) }}"
                                                                 alt="cart-product-1" width="100" height="100"
                                                                 loading="lazy" />
                                                         </a>
                                                     </td>
                                                     <td class="name">
                                                         <div class="d-flex flex-column">
                                                             <p class="mb-0 text-dark product_cart_title">
                                                                 {{ $item->name }}
                                                             </p>
                                                             <div class="d-flex align-items-center py-3">
                                                                 <div class="product-item-quantity">





                                                                     {{-- test Ends --}}
                                                                     <div class="quantity-controls">
                                                                         <button type="button"
                                                                             class="btn-decrement plus__minus_btn "
                                                                             data-item-id="{{ $item->id }}">-</button>
                                                                         <input type="number" name="quantity[]"
                                                                             class="product-item-quantity-input bg-transparent text-center"
                                                                             value="{{ $item->quantity }}" min="1"
                                                                             max="10"
                                                                             data-item-id="{{ $item->id }}"
                                                                             data-unit-price="{{ $item->price }}"
                                                                             onchange="this.form.submit()" />
                                                                         <button type="button"
                                                                             class="btn-increment plus__minus_btn"
                                                                             data-item-id="{{ $item->id }}">+</button>
                                                                     </div>
                                                                     {{-- <input type="number" name="quantity[]"
                                                                         class="product-item-quantity-input"
                                                                         value="{{ $item->quantity }}" min="1"
                                                                         max="10" data-item-id="{{ $item->id }}"
                                                                         data-unit-price="{{ $item->price }}"
                                                                         onchange="this.form.submit()" /> --}}
                                                                     <input type="hidden" name="item_id[]"
                                                                         value="{{ $item->id }}" />
                                                                 </div>
                         </form>
                         <div class="px-3">
                             <form action="{{ route('remove.from.cart', $item->id) }}" method="POST">
                                 @csrf
                                 <button type="submit" class="fs-6 text-danger bg-transparent border-0">Remove</button>
                             </form>
                         </div>
                     </div>
                 </div>
                 </td>
                <td class="price text-dark fw-500">
    {{ $currencySymbol }}<span class="item-total-price">{{ number_format($item->price, 2) }}</span>
    
</td>
                 </tr>
                 @endforeach
                 @endif
                 </tbody>
                 </table>
             </div>
             <div class="row justify-content-between mt-3">
                 <div class="col-auto">
                     <!-- <a class="btn btn-light me-3 mb-3 alert-offer"
                                                                                                                                                                                    >
                                                                                                                                                                                    @if ($res_coupon)
    <span class="fs-20 cl-green">{{ $res_coupon }}</span>
@else
    <span class="fs-20 cl-green">Coupon Apply</span>
    @endif
                                                                                                                                                                                    </a
                                                                                                                                                                                > -->
                 </div>
             </div>
             </form>
             </div>
             @php
                 $totalAmount = 0;

             @endphp

             @foreach ($cart as $item)
                 @php
                     // Calculate the total amount for each item
                     $totalAmount += $item->quantity * $item->product->offer_price;
                 @endphp
                 @php
                     // Calculate the final total amount including the shipping fee
                     $finalTotalAmount = $totalAmount + $shippingFee;
                 @endphp
             @endforeach
             @php
                 $coupons = DB::table('coupons')->get();
             @endphp
             
              @php
             $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
          $currencySymbol = session('currency_symbol', '$');

    // Convert prices to selected currency
    $totalAmount *= $exchangeRate;
    $shippingFee *= $exchangeRate;
    $finalTotalAmount *= $exchangeRate; 


    // Convert individual item prices to selected currency
    foreach ($cart as $item) {
        $item->price *= $exchangeRate;
    }
    @endphp
             <div class="col-lg-4">
                 <div class="cart_totals table-responsive">
                     <h5 class="mb-1">Order Summary</h5>
                     <table class="cart-totals-table table align-middle text-dark">
                         <tbody style="border-bottom: 2px solid #cccccc54">
                             <tr class="cart-subtotal">
                                 <th>Price</th>
                                 <td>{{ $currencySymbol }}<span class="amount">{{ number_format($totalAmount, 2) }}</span></td>
                             </tr>
                             <!-- <tr class="cart-subtotal">
                                                                                                                                                                                          <th>Discount</th>
                                                                                                                                                                                          <td>
                                                                                                                                                                                            <span class="amount text-dark fw-500"></span>
                                                                                                                                                                                          </td>
                                                                                                                                                                                        </tr> -->
                             <tr class="cart-subtotal">
                                 <th>Shipping</th>
                                 <td>{{ $currencySymbol }}<span class="text-success fw-500">{{ number_format($shippingFee, 2) }}</span></td>
                             </tr>
                             <tr class="cart-subtotal">
                                 <th>Coupon Applied</th>
                                 <td>
                                    {{ $currencySymbol }}
                                     <span class="amount text-dark fw-500">-{{ $res_coupon }}</span>
                                 </td>
                             </tr>
                         </tbody>
                         <tbody style="border-bottom: 2px solid #cccccc54">
                             <tr class="cart-subtotal">
                                 <th class="fw-500 text-uppercase">Total</th>
                                 <td>
                                    {{ $currencySymbol }}
                                     <span
                                         class="amount text-dark fw-500">{{ number_format((float) $finalTotalAmount - (float) $res_coupon, 2) }}</span>

                                 </td>
                             </tr>
                             <tr class="order-total">
                                 <td class="order-total-amount">
                                 </td>
                             </tr>

                             <tr class="w-100">
                                 <td class="w-100">
                                     <div class="">
                                         <form method="GET" class="justify-content-center flex-column align-items-center" action="{{ route('cart') }}">
                                             <div class="row">
                                                <div class="col-lg-9">
                                                    <input type="text" name="coupon" class="form-control rounded-pill"
                                                 placeholder="Coupon Code" class="w-100" value="{{ request('coupon') }}">
                                                </div>
                                                <div class="col-lg-3">
                                                  <button type="button" class="d-flex btn wrong-icon" id="removeCouponButton" aria-label="Remove Coupon">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                  </button>

                                                </div>
                                             </div>
                                            
                                             <button class="button1 w-50 text-center d-flex justify-content-center mt-4" type="submit" style='margin:  auto'>Apply Coupon</button>
            
                                         </form>
                                     </div>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                     <div class="d-flex justify-content-center">
                         <a href="{{ route('checkout') }}" class="button1" style="--clr: #7808d0">
                             <span class="button1__icon-wrapper">
                                 <svg viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                                     class="button1__icon-svg" width="10">
                                     <path
                                         d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"
                                         fill="currentColor"></path>
                                 </svg>

                                 <svg viewBox="0 0 14 15" fill="none" width="10"
                                     xmlns="http://www.w3.org/2000/svg" class="button1__icon-svg button1__icon-svg--copy">
                                     <path
                                         d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"
                                         fill="currentColor"></path>
                                 </svg>
                             </span>
                             Proceed to Checkout
                         </a>
                     </div>




                 </div>
             </div>
             </div>

             </div>
         </section>
         <!-- Cart Page Section End -->
     </main>



     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="{{ asset('/frontend/assets/js/modernizr-3.11.7.min.js') }}"></script>


     <!-- Plugins JS -->
     <script src="{{ asset('/frontend/assets/js/swiper-bundle.min.js') }}"></script>

     <script src="{{ asset('/frontend/assets/js/ajax.js') }}"></script>

     <script>
         $(document).ready(function() {
             // Add this JavaScript code to handle quantity updates
             $('.product-item-quantity-input').on('change', function() {
                 var itemId = $(this).data('item-id');
                 var newQuantity = $(this).val();

                 // Send AJAX request to update quantity
                 $.ajax({
                     url: '/update-cart-quantity',
                     method: 'POST',
                     data: {
                         _token: '{{ csrf_token() }}',
                         item_id: itemId,
                         new_quantity: newQuantity
                     },
                     success: function(response) {
                         // Handle success, maybe update UI if needed
                     },
                     error: function(xhr, status, error) {
                         // Handle error
                     }
                 });
             });

         });
     </script>

     {{-- <script>
         $(document).ready(function() {
             const minus = $('.quantity__minus');
             const plus = $('.quantity__plus');
             const input = $('.quantity__input');
             minus.click(function(e) {
                 e.preventDefault();
                 var value = input.val();
                 if (value > 1) {
                     value--;
                 }
                 input.val(value);
             });

             plus.click(function(e) {
                 e.preventDefault();
                 var value = input.val();
                 value++;
                 input.val(value);
             })
         });
     </script> --}}

     <!-- Include this script at the bottom of your Blade template -->
     <script>
         document.addEventListener('DOMContentLoaded', (event) => {
             // Decrement button functionality
             document.querySelectorAll('.btn-decrement').forEach(button => {
                 button.addEventListener('click', () => {
                     let input = button.nextElementSibling;
                     if (input && input.type === 'number') {
                         let currentValue = parseInt(input.value);
                         if (currentValue > parseInt(input.min)) {
                             input.value = currentValue - 1;
                             input.dispatchEvent(new Event(
                                 'change')); // Trigger change event to submit the form
                         }
                     }
                 });
             });

             // Increment button functionality
             document.querySelectorAll('.btn-increment').forEach(button => {
                 button.addEventListener('click', () => {
                     let input = button.previousElementSibling;
                     if (input && input.type === 'number') {
                         let currentValue = parseInt(input.value);
                         if (currentValue < parseInt(input.max)) {
                             input.value = currentValue + 1;
                             input.dispatchEvent(new Event(
                                 'change')); // Trigger change event to submit the form
                         }
                     }
                 });
             });
         });
     </script>

     
 @endsection
