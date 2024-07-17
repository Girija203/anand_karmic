@extends('frontend.layouts.app')

@section('content')
    <main>
        <!-- Contact Us Section Start -->
        <section class="contact-us-section section-space-ptb border-top-1">
            <div class="container">
                <div class="contact-us-section-header text-center mb-50">
                    <h2 class="contact-us-title mb-6">Contact us</h2>
                    {{-- <p class="contact-us-subtitle fs-5">
                        Contact us via the contact form below, or come visit us on our
                        office in Melbourne and we will discuss your new project
                    </p> --}}
                </div>
                {{-- <div class="google-map-area mt-10">
                    <iframe class="contact-us-google-map" width="100%" height="450" loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://maps.google.com/maps?q=Dhaka&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=&amp;output=embed">
                    </iframe>
                </div>
                @foreach ($contactpage as $item)
                    <div class="google-map-area mt-10">
                        <iframe class="contact-us-google-map" width="100%" height="450" loading="lazy" allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade" src="{{ $item->map }}">
                        </iframe>

                    </div>
                @endforeach --}}
                @if ($contactpage->isEmpty())
                    <div class="google-map-area mt-10">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15610.746270495962!2d79.738312241987!3d11.996176350206238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a536742c0057dfb%3A0x71c9db973516caaf!2sSedarapet%2C%20Puducherry!5e0!3m2!1sen!2sin!4v1721178822233!5m2!1sen!2sin"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>


                    </div>
                @else
                    @foreach ($contactpage as $item)
                        <div class="google-map-area mt-10">
                            <iframe class="contact-us-google-map" width="100%" height="450" loading="lazy"
                                allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="{{ $item->map }}">
                            </iframe>



                        </div>
                    @endforeach
                @endif


            </div>
        </section>
        <!-- Contact Us Section End -->

        <!-- Contact Form Section Start -->

        <section class="contact-form-section section-space-pb border-bottom-1">
            <div class="container">
                <div class="row gy-10">

                    <div class="col-12 col-md-6">
                        @if ($contactpage->isEmpty())
                            <div class="contact-form-title mb-50">
                                <h3 class="contact-form-title">Contact Info</h3>
                                <p class="fs-16">
                                    Have a project or an idea you’d like to collaborate with Us?
                                    Let’s get in touch!
                                </p>
                            </div>
                            <ul class="contact-info mt-8">
                                <li class="contact-info-item">
                                    <div class="contact-info-item-icon">
                                        <i class="icon-rt-call-outline"></i>
                                    </div>
                                    <div class="contact-info-item-content">
                                        <span class="contact-info-item-title">Phone:
                                            <a href="tel:+68 6886 6888">+91 93606 59216</a></span>
                                    </div>
                                </li>
                                <li class="contact-info-item">
                                    <div class="contact-info-item-icon">
                                        <i class="icon-rt-mail-outline"></i>
                                    </div>
                                    <div class="contact-info-item-content">
                                        <span class="contact-info-item-title"><a
                                                href="mailto:demo@example.com">Mailto:karm@12345</a></span>
                                    </div>
                                </li>
                                <li class="contact-info-item">
                                    <div class="contact-info-item-icon">
                                        <i class="icon-rt-map-marked-alt-solid"></i>
                                    </div>
                                    <div class="contact-info-item-content">
                                        <span class="contact-info-item-title">Location:Pondicherry</span>
                                    </div>
                                </li>
                            </ul>
                        @else
                            @foreach ($contactpage as $item)
                                <div class="contact-form-title mb-50">
                                    <h3 class="contact-form-title">{{ $item->title }}</h3>
                                    <p class="fs-16">
                                        {{ $item->description }}
                                    </p>
                                </div>
                                <ul class="contact-info mt-8">
                                    <li class="contact-info-item">
                                        <div class="contact-info-item-icon">
                                            <i class="icon-rt-call-outline"></i>
                                        </div>
                                        <div class="contact-info-item-content">
                                            <span class="contact-info-item-title">Phone:
                                                <a href="tel:+68 6886 6888"> {{ $item->phone }}</a></span>
                                        </div>
                                    </li>
                                    <li class="contact-info-item">
                                        <div class="contact-info-item-icon">
                                            <i class="icon-rt-mail-outline"></i>
                                        </div>
                                        <div class="contact-info-item-content">
                                            <span class="contact-info-item-title"><a
                                                    href="mailto:demo@example.com">{{ $item->email }}</a></span>
                                        </div>
                                    </li>
                                    <li class="contact-info-item">
                                        <div class="contact-info-item-icon">
                                            <i class="icon-rt-map-marked-alt-solid"></i>
                                        </div>
                                        <div class="contact-info-item-content">
                                            <span class="contact-info-item-title">{{ $item->address }}</span>
                                        </div>

                                    </li>
                                </ul>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="contact-form-title mb-50">
                            <h3 class="contact-form-title">Contact Form</h3>
                            <p class="fs-16">
                                * All fields marked with a asterisk are required
                            </p>
                        </div>
                        <form id="contact-form" action="{{ route('contact.store') }}" method="post"
                            class="contact-form mt-8">
                            @csrf


                            <div class="contact-form-item">
                                <input type="text" name="name" class="contact-form-input" placeholder="Name*"
                                    required />
                            </div>
                            <div class="contact-form-item">
                                <input type="email" name="email" class="contact-form-input" placeholder="Email*"
                                    required />
                            </div>
                            <div class="contact-form-item">
                                <textarea class="contact-form-input" name="message" placeholder="Message*" required></textarea>
                            </div>
                            <div class="contact-form-item">
                                <button type="submit" class="btn btn-primary btn-md">
                                    Send Message
                                </button>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Form Section End -->
    </main>
@endsection
