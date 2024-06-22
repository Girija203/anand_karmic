@extends('frontend.layouts.app')
  
@section('content')


<section class="checkout-section  border-bottom-1">
            <div class="container">
             
                <!-- checkout-details-wrapper start -->
                <div class="checkout-details-wrapper">
                    <div class="row gy-8 gx-lg-10">
                        <div class="col-lg-8 col-md-8 mx-auto">
                            <!-- billing-details-wrap start -->
                            <div class="billing-details-wrap">
                   <form action="{{ route('store.shipping.address') }}" method="POST">
    @csrf
    <h4 class="shoping-checkboxt-title">ADD SHIPPING DETAILS</h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="text" name="name" placeholder="First name *" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="email" name="email" placeholder="Email address *" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="text" name="mobile" placeholder="Phone *" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="text" name="country" placeholder="Country *" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="text" name="state" placeholder="State *" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="text" name="city" placeholder="City *" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="text" name="address" placeholder="Address *" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="checkout-form-row">
                <input class="checkout-form-input" type="text" name="pincode" placeholder="Postcode / ZIP *" required>
            </div>
        </div>
    </div>
    <br>
    <button type="submit">Submit</button>
</form>
                            </div>
                            <!-- billing-details-wrap end -->
                        </div>
                        

                 
        
                               
                            

                              
                        </div>
                    </div>
                </div>
                <!-- checkout-details-wrapper end -->
            </div>
        </section>

 @endsection