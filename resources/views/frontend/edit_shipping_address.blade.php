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
                               <form action="{{ route('update.shipping.address', $shippingAddress->id) }}" method="POST">
        @csrf
                                    <h4 class="shoping-checkboxt-title">EDIT SHIPPING DETAILS</h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                               
                                                <input class="checkout-form-input" type="text" name="name" placeholder="First name *"  value="{{ $shippingAddress->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                
                                                <input class="checkout-form-input" type="text" name="email" placeholder="Email address *" value="{{ $shippingAddress->email }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                               
                                                <input class="checkout-form-input" type="text" name="mobile" placeholder="Phone *" value="{{ $shippingAddress->mobile }}">
                                            </div>
                                        </div>
                                        
                                    
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                
                                                <input class="checkout-form-input" type="text" placeholder="Country*" name="country"value="{{ $shippingAddress->country }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                <input class="checkout-form-input" type="text" placeholder="State*" name="state"value="{{ $shippingAddress->state }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                               
                                                <input class="checkout-form-input" type="text" name="city" placeholder="City *" value="{{ $shippingAddress->city }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                                
                                                <input class="checkout-form-input" type="text" name="address" placeholder="Address*" value="{{ $shippingAddress->address }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout-form-row">
                                             
                                                <input class="checkout-form-input" type="text" name="pincode" placeholder="Postcode / ZIP *" value="{{ $shippingAddress->pincode }}">
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