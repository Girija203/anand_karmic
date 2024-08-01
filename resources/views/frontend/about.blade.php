@extends('frontend.layouts.app')

@section('content')
    <main>
        <!-- About Us Section Start -->
        <section class="about-us-section  border-top-1">
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

                        <a href="{{ route('shop') }}">
                            <button class="button">
                                Contact us
                                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                    <path clip-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </a>



                    </div>


                    <div class="col-md-6">
                        <div class="">
                            <div class="my-4">
                                <div class="mb-5 about-image">
                                    <img src="{{ asset('frontend/assets/images/karmicabout/ab2.jpg') }}" alt=""
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




        <section class="about-us-section  border-top-1">
            <div class="container">

                <div class="about-body-section section-space-pt fs-16 row align-items-center">
                    <div class="col-md-6">
                        <div class="">
                            <div class="my-4">
                                <div class="mb-5 about-image">
                                    <img src="{{ asset('frontend/assets/images/karmicabout/three.jpg') }}" alt=""
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

                    <div class="col-md-6 ">
                        <h2 class="mb-3">Our Mission</h2>
                        <p>

                            "
                            Karmic Bags was founded on the belief that fashion should be personal, ethical, and empowering.
                            By harnessing traditional handcrafting techniques, each Karmic Bag is meticulously imprinted and
                            assembled by hand, ensuring a unique touch in every piece. Created by women for women, our bags
                            are designed to be a testament to the resilience and creativity of rural artisans."


                        </p>


                        <button class="button">
                            New Shop
                            <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                <path clip-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </button>

                    </div>





                </div>
            </div>

            <div class="container">

                <div class="about-body-section fs-16 row align-items-center">

                    <div class="col-md-6 ">
                        <h2 class="mb-3">Our Craft</h2>
                        <p>
                            In our workshops, which hum with the quiet focus of cottage industry settings, each bag is
                            crafted using techniques passed down through generations. From the weaving of the fabric to the
                            painting of vibrant patterns, every process is done by hand with care and precision. This
                            hands-on approach not only leads to stunning visual aesthetics but also guarantees the
                            durability and quality of every bag."


                        </p>

                        <button class="button">
                            Shop Now
                            <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                <path clip-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </button>

                    </div>


                    <div class="col-md-6">
                        <div class="">
                            <div class="my-4">
                                <div class="mb-5 about-image">
                                    <img src="{{ asset('frontend/assets/images/karmicabout/one.jpg') }}" alt=""
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

            <div class="container">

                <div class="about-body-section section-space-pt fs-16 row align-items-center">
                    <div class="col-md-6">
                        <div class="">
                            <div class="my-4">
                                <div class="mb-5 about-image">
                                    <img src="{{ asset('frontend/assets/images/karmicabout/four.jpg') }}" alt=""
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

                    <div class="col-md-6 ">
                        <h2 class="mb-3">Our Impact</h2>
                        <p>
                            Karmic Bags aims to do more than just create beautiful handbags. We are committed to making a
                            positive impact on the communities we work with by providing fair wages, fostering safe working
                            conditions, and supporting the economic empowerment of women. Every purchase helps contribute to
                            the betterment of our artisans' lives, enabling education and health care opportunities for
                            their families."

                        </p>


                        <button class="button">
                            Shop Bag
                            <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                <path clip-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </button>

                    </div>





                </div>
            </div>


            <div class="container">

                <div class="about-body-section section-space-pt fs-16 row align-items-center">

                    <div class="col-md-6 ">
                        <h2 class="mb-3">Discover Our Collections</h2>
                        <p>
                            "" Explore our diverse range of handbags, each with its own unique story and design. From
                            vibrant totes that carry the essence of rural craftsmanship to elegant clutches that are perfect
                            for any celebration, our collections are as versatile as they are environmentally conscious."



                        </p>

                        <button class="button">
                            Shop Now
                            <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                <path clip-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                    fill-rule="evenodd"></path>
                            </svg>
                        </button>

                    </div>


                    <div class="col-md-6">
                        <div class="">
                            <div class="my-4">
                                <div class="mb-5 about-image">
                                    <img src="{{ asset('frontend/assets/images/karmicabout/two.jpg') }}" alt=""
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


            </div>
        </section>




        <section class="new-letter my-4">
            <div class="container">
                <h2>Sign up with News Letter</h2>
                <p>Get our latest product arrival, offers and news through your mail, enter your email and join our karmic
                    family!
                    Signup now and get 10% off.</p>
                <p class="fs-14">
                    Follow our journey and connect with us on social media to get a closer look at how your bags are made
                    and the stories of the women who make them.
                    </span></p>


                <!-- input newletter -->

                <!-- <h6 class="fs-15 fw-600">Email Signup *</h6> -->
                <form action="{{ route('subscriber.store') }}" method="POST">
                    @csrf

                    <div class="input-container new col-md-5">
                        <div class="input-container">
                            <input type="email" id="input" required="" name="email"
                                placeholder="Enter mail">
                            <!-- <label for="email" class="label"></label> -->
                            <div class="underline"></div>
                        </div>


                        <button class="btn btn-black">Subscribe</button>
                    </div>

                </form>

            </div>
        </section>






        <!-- About Us Section Start -->
        <section class="about-us-section  border-top-1">
            <div class="container">
                @foreach ($sorted_about_sections as $about_section)
                    @if ($about_section && $about_section->is_left == 1)
                        <div class="about-body-section section-space-pt fs-16 row align-items-center">
                            <div class="col-md-6">
                                <div class="row">
                                    @foreach ($about_section->images as $image)
                                        <div class="col-md-6 my-4">
                                            <div class="col-md-12 mb-5">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt=""
                                                    class="w-100">
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
                                    @foreach ($about_section->images as $image)
                                        <div class="col-md-6 my-4">
                                            <div class="col-md-12 mb-5">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt=""
                                                    class="w-100">
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
