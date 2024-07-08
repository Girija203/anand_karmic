   @extends('frontend.layouts.app')

   @section('content')
       <main>
           <!-- About Us Section Start -->
           <section class="about-us-section section-space-ptb border-top-1">
               <div class="container">

                   <div class="about-body-section section-space-pt fs-16 row align-items-center">

                       <div class="col-md-6 ">
                           <h2 class="mb-3">Who We Are ?</h2>
                           <p>
                               Karmic bags origin is in Canada, Originality and simplicity are at the core of our design
                               philosophy. The
                               Karmic journey starts in 2023 and now we are a leading handbags company worldwide. Our
                               journey began with
                               a commitment to crafting bags that stand out, using 100% pure leather materials. Karmic's
                               innovative
                               designs have set trends and made a significant impact on fashion styles worldwide. Our bags
                               will catch all
                               their eyes because we are using quality leathers and finest work. Visit us and get the
                               perfect handbags
                               for you.
                           </p>

                       </div>


                       <div class="col-md-6">
                           <div class="">
                               <div class="my-4">
                                   <div class="mb-5 about-image">
                                       <img src="{{ asset('https://img.freepik.com/free-photo/close-up-shoemaker-cutting-leather_171337-12266.jpg?t=st=1719238264~exp=1719241864~hmac=e1d64e9bec7e7d460ab4bfd727b9890a7ee4666f2f1631030024614d7790d5d5&w=900') }}" alt=""
                                           srcset="" class="w-100">
                                   </div>
                                  
                               </div>

                               <!-- <div class="col-md-6 ">
                                   <div class="col-md-12 mb-5">
                                       <img src="{{ asset('frontend/assets/images/products/pano (1).jpeg') }}"
                                           alt="" srcset="" class="w-100">
                                   </div>
                                   <div class="col-md-12 mb-5">
                                       <img src="{{ asset('frontend/assets/images/products/pano (1).jpeg') }}"
                                           alt="" srcset="" class="w-100">
                                   </div>
                               </div> -->



                           </div>


                       </div>



                   </div>
               </div>
           </section>
           <!-- About Us Section End -->


           <!-- About Us Section Start -->
           <section class="about-us-section section-space-ptb border-top-1">
               <div class="container">

                   <div class="about-body-section section-space-pt fs-16 row align-items-center">

                       <div class="col-md-12 text-center  mb-5">
                           <h2 class="mb-3">Our Story</h2>


                       </div>

                   </div>

                   <div class="row">
                       <div class="col-2">
                           <div class="d-flex flex-column align-items-center ">
                               <img src="{{ asset('./frontend/assets/images/icon/Group 1.png') }}" alt=""
                                   srcset="" class="w-50 mb-2">

                               <span>sample</span>
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="d-flex flex-column align-items-center ">
                               <img src="{{ asset('./frontend/assets/images/icon/Group 6.png') }}" alt=""
                                   srcset="" class="w-50 mb-2">

                               <span>sample</span>
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="d-flex flex-column align-items-center ">
                               <img src="{{ asset('./frontend/assets/images/icon/Group 3.png') }}" alt=""
                                   srcset="" class="w-50 mb-2">

                               <span>sample</span>
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="d-flex flex-column align-items-center ">
                               <img src="{{ asset('./frontend/assets/images/icon/Group 4.png') }}" alt=""
                                   srcset="" class="w-50 mb-2">

                               <span>sample</span>
                           </div>
                       </div>
                       <div class="col-2">
                           <div class="d-flex flex-column align-items-center ">
                               <img src="{{ asset('./frontend/assets/images/icon/Group 5.png') }}" alt=""
                                   srcset="" class="w-50 mb-2">

                               <span>sample</span>
                           </div>
                       </div>

                       <div class="col-2">
                           <div class="d-flex flex-column align-items-center ">
                               <img src="{{ asset('./frontend/assets/images/icon/Group 5.png') }}" alt=""
                                   srcset="" class="w-50 mb-2">

                               <span>sample</span>
                           </div>
                       </div>
                   </div>

               </div>
           </section>
           <!-- About Us Section End -->

           <!-- About Us Section Start -->
<section class="about-us-section section-space-ptb border-top-1">
    <div class="container">
        @foreach($sorted_about_sections as $about_section)
            @if($about_section && $about_section->is_left == 1)
                <div class="about-body-section section-space-pt fs-16 row align-items-center">
                    <div class="col-md-6">
                        <div class="row">
                            @foreach($about_section->images as $image)
                                <div class="col-md-6 my-4">
                                    <div class="col-md-12 mb-5">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="" class="w-100">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="mb-3">{{ $about_section->title }}</h2>
                        <p>{{ $about_section->content }}</p>
                    </div>
                </div>
            @elseif($about_section)
                <div class="about-body-section section-space-pt fs-16 row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-3">{{ $about_section->title }}</h2>
                        <p>{{ $about_section->content }}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            @foreach($about_section->images as $image)
                                <div class="col-md-6 my-4">
                                    <div class="col-md-12 mb-5">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="" class="w-100">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>




           <!-- About Us Section End -->

           <!-- About Us Section Start -->
           
           <!-- About Us Section End -->

           <!-- About Us Section Start -->
          
           <!-- About Us Section End -->

           <!-- Counter Up Section Start -->

           <!-- Counter Up Section End -->


       </main>
   @endsection
