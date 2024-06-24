  @extends('frontend.layouts.app')

  <style>
      .input-container {
          position: relative;


      }

      .input-container input[type="text"] {
          font-size: 20px;
          width: 100%;
          border: none;
          border-bottom: 2px solid #ccc;
          padding: 5px 0;
          background-color: transparent;
          outline: none;
      }

      .input-container .label {
          position: absolute;
          top: 0;
          left: 0;
          color: #ccc;
          transition: all 0.3s ease;
          pointer-events: none;
      }

      .input-container input[type="text"]:focus~.label,
      .input-container input[type="text"]:valid~.label {
          top: -20px;
          font-size: 16px;
          color: #333;
      }

      .input-container .underline {
          position: absolute;
          bottom: 0;
          left: 0;
          height: 2px;
          width: 100%;
          background-color: #333;
          transform: scaleX(0);
          transition: all 0.3s ease;
      }

      .input-container input[type="text"]:focus~.underline,
      .input-container input[type="text"]:valid~.underline {
          transform: scaleX(1);
      }
  </style>

  @section('content')
  <section class="h-100 position-relative" style="background-color: #000 !important;">
      <video autoplay muted loop class="banner-video" preload="auto">
          <!-- Video source and any additional content -->
          <source src="{{ asset('frontend/assets/images/Karmic.webm') }}" class="position-relative" type="video/mp4" />
          <div class="banner-video-overlay"></div>
      </video>
      <swiper-container class="mySwiper animeslide" direction="vertical" pagination="true" pagination-clickable="true" mousewheel="true">
          <swiper-slide style="background-color: rgb(0 0 0 / 40%)">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-sm-12 order-2 order-sm-1 text-white text-left animated-content">
                          <div class="my-3">
                              <div class="d-flex justify-content-center align-items-center flex-column text-white banner_content_section">
                                  <h5 class="m-0 position-relative text-white" style="top: 50px">
                                      <span class="typed-text"></span><span class="cursor">&nbsp;</span>
                                  </h5>
                                  <h3 class="banner_title_text text-white">Karmic</h3>
                                  <p class="text-white">Explore Our Stylish & Unique Bag Collection</p>
                              </div>
                          </div>
                          <div class="d-flex justify-content-center">
                              <i class="fa-solid fa-angles-down fa-bounce"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </swiper-slide>
          <swiper-slide class="back-lightblack" style="background-color: rgba(0, 0, 0, 0.65)">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-sm-6 order-2 order-sm-1 text-white text-left animated-content">
                          <h6 class="m-0 text-white" style="top: 50px">BAGS FOR WOMEN</h6>
                          <div class="my-3">
                              <h1 class="fw-bold display-5 text-left slide text-white">Unique & luxury bags</h1>
                          </div>
                          <div>
                              <p>
                                  Touch and feel our unique bags collection, we crafted exclusively for women and our bags design and color make you more attractive and elegant. Choose our bags to enhance your beauty.
                              </p>
                          </div>
                          <button class="button">
                              BUY NOW
                              <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                  <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
                              </svg>
                          </button>
                      </div>
                      <div class="col-sm-6 order-1 order-sm-2 animated-contentright d-flex justify-content-center mobile_none">
                          <div class="glasmorphism">
                              <img src="{{ asset('frontend/assets/images/karmic/karmic 04.png') }}" class="img-fluid image" alt="" />
                          </div>
                      </div>
                  </div>
              </div>
          </swiper-slide>
          <swiper-slide class="back-lightblack" style="background-color: rgba(0, 0, 0, 0.65)">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-sm-6 order-2 order-sm-1 text-white animated-content" data-aos="fade-right">
                          <h6 class="m-0 text-white" style="top: 50px">BAGS FOR WOMEN</h6>
                          <div class="my-2">
                              <h1 class="fw-bold text-left slide display-5 text-white">Women’s Premium HandBags</h1>
                          </div>
                          <p>
                              Karmic bags crafting world’s finest premium handbags for women, All bags are exclusively handmade. Our limited-edition designs enhance your attractiveness and boost your confidence.
                          </p>
                          <button class="button">
                              Shop Now
                              <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                  <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
                              </svg>
                          </button>
                      </div>
                      <div class="col-sm-6 order-1 order-sm-2 animated-contentright d-flex justify-content-center mobile_none">
                          <div class="glasmorphism">
                              <img src="{{ asset('frontend/assets/images/karmic/karmic 01.png') }}" class="img-fluid image w-100" alt="" />
                          </div>
                      </div>
                  </div>
              </div>
          </swiper-slide>
          <swiper-slide class="back-lightblack" style="background-color: rgba(0, 0, 0, 0.65)">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-sm-6 order-2 order-sm-1 text-white text-left animated-content">
                          <h6 class="m-0 text-white" style="top: 50px">BAGS FOR WOMEN</h6>
                          <div class="my-3">
                              <h1 class="fw-bold display-5 text-white">World of Karmic bags</h1>
                          </div>
                          <p>
                              Explore more and select stylish and unique handbags to your fashion needs. Our bags make you more fashion freak to the world.
                          </p>
                          <button class="button">
                              Shop Now
                              <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                  <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
                              </svg>
                          </button>
                      </div>
                      <div class="col-sm-6 order-1 order-sm-2 animated-contentright d-flex justify-content-center mobile_none">
                          <div class="glasmorphism">
                              <img src="{{ asset('frontend/assets/images/karmic/Karmic Bag 14.png') }}" class="img-fluid image w-100" alt="" />
                          </div>
                      </div>
                  </div>
              </div>
          </swiper-slide>
          <swiper-slide id="your-slide-id" style="background-color: rgba(0, 0, 0, 0.65)">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-sm-6 order-2 order-sm-1 text-white text-left animated-content">
                          <h6 class="m-0 text-white" style="top: 50px">BAGS FOR WOMEN</h6>
                          <div class="my-3">
                              <a href="./index copy.html#about">
                                  <h1 class="fw-bold display-5 text-white" id="auto-click">Karmic Leathers</h1>
                              </a>
                          </div>
                          <p>
                              Karmic uses only 100% top quality leathers and ensures long lasting wearable. We produce all our leathers in our own tanneries and maintain strict quality control throughout the process.
                          </p>
                          <button class="button">
                              Shop Now
                              <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                  <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
                              </svg>
                          </button>
                      </div>
                      <div class="col-sm-6 order-1 order-sm-2 animated-contentright d-flex justify-content-center mobile_none">
                          <div class="glasmorphism">
                              <img src="{{ asset('frontend/assets/images/karmic/Karmic Bag 10_01.png') }}" class="img-fluid image w-90" alt="" />
                          </div>
                      </div>
                  </div>
              </div>
          </swiper-slide>
      </swiper-container>
  </section>


  <!-- About -->
  <section class="section-space-ptb back-black" id="about" style="background-color: black;">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6 col-md-12 text-white">
                  <h2 class="mb-3 text-white">Who We Are ?</h2>
                  <p>Karmic bags origin is in Canada, Originality and simplicity are at the core of our design
                      philosophy. The
                      Karmic journey starts in 2023 and now we are a leading handbags company worldwide. Our journey
                      began with a
                      commitment to crafting bags that stand out, using 100% pure leather materials. Karmic's innovative
                      designs
                      have set trends and made a significant impact on fashion styles worldwide. Our bags will catch all
                      their
                      eyes because we are using quality leathers and finest work. Visit us and get the perfect handbags
                      for you.
                  </p>
              </div>
              <div class="col-lg-6 col-md-12 d-flex justify-content-center">
                  <img src="{{ asset('frontend/assets/images/banners/Karmic - 3.png') }}" alt="" srcset="" class="w-75">
              </div>
          </div>
      </div>
  </section>
  <!-- About end -->

  @if (!empty($ProductShowCases))
  <!-- product start -->
  <section class="product-section section-space-ptb">
      <div class="container">

          <!-- Section Title Area Start -->
          <div class="section-title-area text-center">
              <h2 class="section-title">{{ $ProductShowCases->title ?? '' }}</h2>
              <p>{{ $ProductShowCases->description ?? '' }}</p>
          </div>
          <!-- Section Title Area End -->

          <div class="row">
              @foreach ($showCaseProducts as $showCaseProduct)
              <div class="col-lg-4 col-md-6 mb-15 ">
                  <div class="card position-relative box-shad" style="overflow: hidden">
                      <div class="position-absolute display-none vedio_back" style="display: none">
                          <img class="img-hov position-relative" src="" alt="" srcset="">
                          <div class="position-absolute bottom-footer" style="display: none;">
                              <div class="bottom-foot">
                                  <button class="btn btn-black">Shop Now</button>
                              </div>
                          </div>
                      </div>
                      <div class="p-2">
                          <div class="">
                              <img class="card-img-top " src="{{ asset('storage/' . $showCaseProduct->product->image) }}" alt="Card image cap object-fit-cover" width="75%" />
                          </div>
                      </div>
                      <div class="card-body">
                          <h6 class="card-title">{{ $showCaseProduct->product->title }}</h6>
                          <div class="d-flex justify-content-between align-items-center my-2">
                              <div>
                                  <a href="{{ route('single.product', $showCaseProduct->id) }}">
                                      <button class="btn btn-black" style="z-index: 99999;">Shop Now</button>
                                  </a>
                              </div>
                              <div class="d-flex flex-column align-items-end">
                                  <span>Rs. {{ $showCaseProduct->product->offer_price }}</span>
                                  <span class="product-card-old-price fw-600">M.R.P :
                                      <del>{{ $showCaseProduct->product->price }}</del></span>
                                      
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
  </section>
  <!-- product end -->
@endif

  <!-- product start -->
  <section class="product-section section-space-ptb back-black">
      <div class="container position-relative">

          <!-- Section Title Area Start -->
          <div class="section-title-area text-center text-white">
              <h2 class="section-title text-white">Our Gallery</h2>
              <p>Fashion eases the load off your shoulders! Explore our stylish array of handbags designed for women.
              </p>
          </div><!-- Section Title Area End -->
          <swiper-container class="mySwiper pano-style position-relative" pagination="true" pagination-clickable="true" slides-per-view="5" space-between="5" free-mode="true" autoplay="true" loop="true" style="height: 350px !important;">
              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend/assets/images/products/1.jpg') }}" alt="">
              </swiper-slide>
              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend/assets/images/products/pano (1).jpeg') }}" alt="">
              </swiper-slide>
              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend/assets/images/products/pano (3).jpg') }}" alt="">
              </swiper-slide>

              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend/assets/images/products/pano (4).jpg') }}" alt="">
              </swiper-slide>
              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend/assets/images/products/CES02376ed.jpg') }}" alt="">
              </swiper-slide>
              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend/assets/images/products/pano (5).jpg') }}" alt="">
              </swiper-slide>
              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend//assets/images/products/1 (1).JPG') }}" alt="">
              </swiper-slide>
              <swiper-slide>
                  <img class="slide-image" src="{{ asset('frontend/assets/images/products/CES02376ed.jpg') }}" alt="">
              </swiper-slide>



          </swiper-container>

      </div>
  </section>


  <section class="new-letter section-space-ptb">
      <div class="container">
          <h2>Sign up with News Letter</h2>
          <p>Get our latest product arrival, offers and news through your mail, enter your email and join our karmic
              family!
              Signup now and get 10% off.</p>
          <p class="fs-14">Please read our privacy policy carefully before purchasing a product. All instructions are
              detailed within the policy.</span></p>


          <!-- input newletter -->

          <h6 class="fs-15 fw-600">Email Signup *</h6>
          <form action="{{ route('subscriber.store') }}" method="POST">
              @csrf

              <div class="input-container new col-md-5">
                  <div class="input-container">
                      <input type="email" id="input" required="" name="email" placeholder="Enter Your Email">
                      <!-- <label for="email" class="label"></label> -->
                      <div class="underline"></div>
                  </div>


                  <button class="btn btn-black">Subscribe</button>
              </div>

          </form>

      </div>
  </section>

  </main>


  <!-- Product Modal Start -->
  <div class="modal fade" id="login-form-popup-actiove" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered sign-in-modal">
          <div class="modal-content">
              <button type="button" class="btn-close position-absolute end-0 p-2" data-bs-dismiss="modal" aria-label="Close"></button>
              <!-- Logo Start -->
              <div class="logo text-center pt-2">
                  <a href="index.html">
                      <img src="assets/images/logo/logo.svg" height="30" width="120" alt="logo">
                  </a>
              </div><!-- Logo Start -->
              <div class="sign-in-modal-body px-3 pb-5">
                  <div class="modal-box-wrapper">
                      <ul class="nav sign-in-tablist" role="tablist">
                          <li class="sign-in-tab--item nav-item" role="presentation">
                              <a class="sign-in-tab--link active" data-bs-toggle="tab" href="#tab_list_06" role="tab" aria-selected="true">Login</a>
                          </li>
                          <li class="sign-in-tab--item nav-item" role="presentation">
                              <a class="sign-in-tab--link" data-bs-toggle="tab" href="#tab_list_07" role="tab" aria-selected="false" tabindex="-1">Our Register</a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane fade show active" id="tab_list_06" role="tabpanel">
                              <form action="#" class="account-form-box max-w-400 mx-auto">
                                  <div class="single-input-gruop">
                                      <label class="single-input-label" for="login-username">Username or email
                                          address*</label>
                                      <input class="single-input-fild" type="text" id="login-username">
                                  </div>
                                  <div class="single-input-gruop">
                                      <label class="single-input-label" for="login-password">Password*</label>
                                      <input class="single-input-fild" type="password" id="login-password">
                                  </div>
                                  <div class="checkbox-wrap mt-3 mb-4 d-flex align-items-center justify-content-between fs-16">
                                      <label class="label-for-checkbox d-flex gap-1 align-items-center">
                                          <input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
                                          <span>Remember me</span>
                                      </label>
                                      <a href="#">Lost your password?</a>
                                  </div>
                                  <div class="button-box">
                                      <a href="#" class="btn btn-full btn-md btn-primary">Log in</a>
                                  </div>
                              </form>
                          </div>
                          <div class="tab-pane fade" id="tab_list_07" role="tabpanel">
                              <form action="#" class="account-form-box  max-w-400 mx-auto">
                                  <div class="single-input-gruop">
                                      <label class="single-input-label" for="register-name">Username*</label>
                                      <input class="single-input-fild" type="text" id="register-name">
                                  </div>
                                  <div class="single-input-gruop">
                                      <label class="single-input-label" for="register-email">Email address*</label>
                                      <input class="single-input-fild" type="email" id="register-email">
                                  </div>
                                  <div class="single-input-gruop">
                                      <label class="single-input-label" for="register-password">Password*</label>
                                      <input class="single-input-fild" type="password" id="register-password">
                                  </div>
                                  <p class="mt-3 text-center">Your personal data will be used to support your
                                      experience throughout this
                                      website, to manage access to your account, and for other purposes described in our
                                      <a href="#" class="privacy-policy-link" target="_blank">privacy
                                          policy</a>.
                                  </p>
                                  <div class="button-box mt-4">
                                      <button type="submit" class="btn btn-full btn-primary btn-md">Register</button>
                                  </div>
                              </form>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Product Modal End -->

  <!-- OffCanvas Cart Start -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-cart">
      <div class="offcanvas-cart-wrap">
          <div class="offcanvas-cart-header">
              <div class="offcanvas-cart-title">YOUR CART</div>
              <button type="button" class="btn-close text-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
              <div class="cart-product">
                  <!-- Cart Product Item Start -->
                  @foreach ($cart as $item)
                  <div class="cart-product-item">
                      <a href="product-details.html" class="cart-product-thum">
                          <img src="{{ asset('storage/' . $item->image) }}" alt="Product Cart One" />
                      </a>
                      <div class="cart-product-content">
                          <h6 class="cart-product-content-title">
                              <a href="">{{ $item->name }}</a>
                          </h6>
                          <div class="cart-product-content-bottom">
                              <span class="cart-product-content-quantity">1 × </span>
                              <span class="cart-product-content-amount">
                                  <bdi>
                                      <span class="visually-hidden">Price:</span>
                                      <span class="price-currency-symbol">Rs.</span>{{ $item->price }}
                                  </bdi>
                              </span>
                          </div>
                      </div>
                      <button class="cart-product-close">×</button>
                  </div>
                  @endforeach

                  <!-- Cart Product Item End -->
              </div>
              <div class="offcanvas-cart-footer">
                  <div class="mini-cart-total">
                      <strong class="mini-cart-subtotal">Subtotal</strong>
                      <span class="mini-cart-amount">
                          <bdi> <span class="currency-symbol">Rs.</span>4123.00 </bdi>
                      </span>
                  </div>
                  <div class="cart-button-action-wrap gap-2 d-flex flex-column">
                      <a href="{{ route('cart') }}" class="btn-outline btn btn-full btn-lg">View Cart</a>
                      <a href="{{ route('checkout') }}" class="btn-outline btn btn-full btn-lg">Checkout</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- OffCanvas Cart End -->


  <div class="offcanvas offcanvas-top offcanvas-search-area" tabindex="-1" id="offcanvas-search">
      <div class="offcanvas-search-wrap">
          <div class="offcanvas-search-header">
              <div class="offcanvas-search-title">
                  <span class="visually-hidden">Search</span>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-search-body">
              <div class="offcanvas-search-box">
                  <form action="#" class="offcanvas-search-form">
                      <input type="text" placeholder="Search..." class="offcanvas-search-input">
                      <button type="submit" class="offcanvas-search-submit"> <i class="icon-rt-loupe"></i></button>
                  </form>
                  <div class="offcanvas-search-content">
                      <div class="offcanvas-search-keywords-list">
                          <p class="offcanvas-search-key-title">Popular searches :</p>
                          <ul class="offcanvas-search-popular d-flex gap-1">
                              <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">men</a></li>
                              <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">clothing</a></li>
                              <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">women</a></li>
                              <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">kids</a></li>
                              <li><a href="#" class="btn btn-xs btn-gray btn-rounde-2">new</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Offcanvas Mobile Menu Start -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-mobile-menu">
      <div class="offcanvas-header">
          <h6>Menu</h6>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
          <nav class="navbar-mobile-menu">
              <ul class="mobile-menu">
                  <li class="mobile-menu-item">
                      <a href="#" class="mobile-menu-link">
                          Demos
                          <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                      </a>
                      <ul class="mega-menu mobile-menu--mega">
                          <li><a href="index.html" class="sub-menu-link">Home One</a></li>
                          <li><a href="index-2.html" class="sub-menu-link">Home Two</a></li>
                          <li><a href="index-3.html" class="sub-menu-link">Home Three</a></li>
                          <li><a href="index-4.html" class="sub-menu-link">Home Four</a></li>
                      </ul>
                  </li>
                  <li class="mobile-menu-item">
                      <a href="#" class="mobile-menu-link">Shop <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span></a>
                      <ul class="sub-menu">
                          <li>
                              <a href="#" class="sub-menu-link">
                                  LAYOUT
                                  <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                              </a>
                              <ul class="sub-menu">
                                  <li><a href="shop.html" class="megamenu-link">No Sidebar Grid</a></li>
                                  <li><a href="shop-left-sidebar.html" class="megamenu-link">Left Sidebar Shop
                                          Grid</a></li>
                                  <li><a href="shop-right-sidebar.html" class="megamenu-link">Right Sidebar Shop Grid
                                      </a></li>
                                  <li><a href="shop-list-sidebar.html" class="megamenu-link">Right Sidebar Shop List
                                      </a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="#" class="sub-menu-link">
                                  FEATURES
                                  <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                              </a>
                              <ul class="sub-menu">
                                  <li><a href="shop-description-on-top.html" class="megamenu-link">Show description
                                          <span class="menu-label">On Top</span></a></li>
                                  <li><a href="shop-description-on-bottom.html" class="megamenu-link">Show description
                                          <span class="menu-label">On Bottom</span></a></li>
                                  <li><a href="shop-show-subcategories.html" class="megamenu-link">Show subcategories
                                      </a></li>
                                  <li><a href="shop-no-sidebar-offcanvas.html" class="megamenu-link">No Sidebar Off –
                                          Canvas</a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="#" class="sub-menu-link">
                                  PRODUCT STYLE
                                  <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                              </a>
                              <ul class="sub-menu">
                                  <li><a href="shop-product-type-01.html" class="megamenu-link">Product Card Style
                                          1</a></li>
                                  <li><a href="shop-product-type-02.html" class="megamenu-link">Product Card Style
                                          2</a></li>
                                  <li><a href="shop-product-type-03.html" class="megamenu-link">Product Card Style
                                          3</a></li>
                                  <li><a href="shop-product-type-04.html" class="megamenu-link">Product Card Style
                                          4</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="mobile-menu-item">
                      <a href="#" class="mobile-menu-link">Product <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span></a>
                      <ul class="sub-menu">
                          <li>
                              <a href="#" class="sub-menu-link">
                                  PRODUCT GALLERY
                                  <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                              </a>
                              <ul class="sub-menu">
                                  <li><a href="product-details.html" class="megamenu-link">Simple Style</a></li>
                                  <li><a href="product-top-gallay-details.html" class="megamenu-link">Image Top</a>
                                  </li>
                                  <li><a href="product-details-grid-1-column.html" class="megamenu-link">Grid - 1
                                          column</a></li>
                                  <li><a href="product-details-grid-2-column.html" class="megamenu-link">Grid - 2
                                          column</a></li>
                                  <li><a href="product-details-variation.html" class="megamenu-link">Gallery For
                                          Variation</a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="#" class="sub-menu-link">
                                  FEATURES
                                  <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                              </a>
                              <ul class="sub-menu">
                                  <li><a href="product-details-variation-vertical-thumbs.html" class="megamenu-link">Vertical
                                          Thumbnails</a></li>
                                  <li><a href="product-details-variable.html" class="megamenu-link">Variable
                                          Product</a></li>
                                  <li><a href="product-details-countdown.html" class="megamenu-link">Countdown
                                          Product</a></li>
                                  <li><a href="product-details-tab-accordion.html" class="megamenu-link">Tab
                                          Accordion</a></li>
                                  <li><a href="product-details-tab-accordion-vertical.html" class="megamenu-link">Tab
                                          Accordion
                                          Vertical</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="mobile-menu-item">
                      <a href="#" class="mobile-menu-link">Page <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span></a>
                      <ul class="sub-menu">
                          <li>
                              <a href="#" class="sub-menu-link">
                                  WOOCOMMERCE
                                  <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                              </a>
                              <ul class="sub-menu">
                                  <li><a href="my-account.html" class="megamenu-link">My account</a></li>
                                  <li><a href="checkout.html" class="megamenu-link">Checkout</a></li>
                                  <li><a href="cart.html" class="megamenu-link">Shopping Cart</a></li>
                                  <li><a href="wishlist.html" class="megamenu-link">Wishlist</a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="#" class="sub-menu-link">
                                  OTHER PAGE
                                  <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                              </a>
                              <ul class="sub-menu">
                                  <li><a href="about-us.html" class="megamenu-link">About Us</a></li>
                                  <li><a href="contact-us.html" class="megamenu-link">Contact Us</a></li>
                                  <li><a href="store-locator.html" class="megamenu-link">Store Locator</a></li>
                                  <li><a href="404-page.html" class="megamenu-link">404 Page</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="mobile-menu-item">
                      <a href="#" class="mobile-menu-link">
                          Blogs
                          <span class="menu-expand"><i class="icon-rt-arrow-down"></i></span>
                      </a>
                      <ul class="mega-menu mobile-menu--mega">
                          <li><a href="blog.html" class="sub-menu-link">Blog Grid</a></li>
                          <li><a href="blog-mask.html" class="sub-menu-link">Blog Mask</a></li>
                          <li><a href="blog-list.html" class="sub-menu-link">Blog List</a></li>
                          <li><a href="blog-left-sidebar.html" class="sub-menu-link">Blog Left Sidebar</a></li>
                          <li><a href="blog-right-sidebar.html" class="sub-menu-link">Blog Right Sidebar</a></li>
                          <li><a href="blog-no-sidebar.html" class="sub-menu-link">No Sidebar</a></li>
                          <li><a href="blog-details.html" class="sub-menu-link">Blog Post Details</a></li>
                          <li><a href="blog-details-two.html" class="sub-menu-link">Blog Post Details Two</a></li>
                      </ul>
                  </li>
              </ul>
          </nav>
      </div>
  </div>
  <!-- Offcanvas Mobile Menu End -->



  <!-- Product Modal Start -->
  <div class="modal fade" id="product-modal-active" aria-hidden="true" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered product-quick-view-modal">
          <div class="modal-content">
              <button type="button" class="btn-close position-absolute end-0 p-2" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="product-item-details px-3 py-4">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="swiper product-quickview-lg-active">
                              <div class="swiper-wrapper">
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-1.jpg" alt="product quick view 1" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-1-1.jpg" alt="product quick view 2" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-2.jpg" alt="product quick view 1" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-2-2.jpg" alt="product quick view 2" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-3.jpg" alt="product quick view 1" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-3-3.jpg" alt="product quick view 2" loading="lazy">
                                  </div>
                              </div>
                              <div class="product-details-button-next product-details-navigation-next"><i class="icon-rt-arrow-right"></i></div>
                              <div class="product-details-button-prev product-details-navigation-prev"><i class="icon-rt-arrow-left"></i></div>
                          </div>
                          <div class="swiper product-quickview-sm-thum-active mt-2">
                              <div class="swiper-wrapper">
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-1.jpg" alt="small product 1" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-1-1.jpg" alt="small product 2" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-2.jpg" alt="small product 1" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-2-2.jpg" alt="small product 2" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-3.jpg" alt="small product 1" loading="lazy">
                                  </div>
                                  <div class="swiper-slide">
                                      <img src="assets/images/products/product-3-3.jpg" alt="small product 2" loading="lazy">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="product-item-details-box">
                              <h4 class="product-item-details-title">FERMENTUM TURPIS EROS</h4>
                              <div class="product-item-details-rating d-flex align-items-center gap-2 text-black">
                                  <div class="product-item-details-rating-list d-flex">
                                      <i class="icon-rt-star-solid"></i>
                                      <i class="icon-rt-star-solid"></i>
                                      <i class="icon-rt-star-solid"></i>
                                      <i class="icon-rt-star-solid"></i>
                                      <i class="icon-rt-star-solid"></i>
                                  </div>
                                  <a href="#" class="fs-16">(1 customer review)</a>
                              </div>

                              <div class="product-card-price mt-2">
                                  <span class="product-card-old-price"><del>$60.00</del></span>
                                  <span class="product-card-regular-price">$50.00</span>
                              </div>

                              <p class="product-item-details-description mt-2 fs-16">Lorem ipsum dolor sit amet,
                                  consectetur
                                  adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna...</p>

                              <div class="product-item-stock in-stock mb-3">
                                  <span class="stock-label visually-hidden">Availability:</span>
                                  <span class="product-item-stock-in">994 In Stock</span>
                              </div>

                              <div class="product-item-action-box d-flex gap-2 align-items-center">
                                  <form action="#" class="product-item-quantity">
                                      <button class="product-item-quantity-decrement product-item-quantity-button" type="button">-</button>
                                      <input type="text" class="product-item-quantity-input" value="1">
                                      <button class="product-item-quantity-increment product-item-quantity-button" type="button">+</button>
                                  </form>
                                  <button class="btn btn-primary btn-lg">Add to cart</button>
                              </div>
                              <a href="wishlist.html" class="product-item-wishlist-action mt-3">
                                  <i class="icon-rt-heart2"></i><span>Add to wishlist</span>
                              </a>
                              <div class="social-share-wrap d-flex gap-1 mt-3">
                                  <p class="fs-16">SHARE: </p>
                                  <div class="social-share social-share-in-color d-flex gap-2">
                                      <a class="social-share-link facebook" href="https://www.facebook.com/" target="_blank" aria-label="facebook">
                                          <i class="icon-rt-4-facebook-f"></i>
                                      </a>
                                      <a class="social-share-link twitter" href="https://twitter.com/" target="_blank" aria-label="twitter">
                                          <i class="icon-rt-logo-twitter"></i>
                                      </a>
                                      <a class="social-share-link instagram" href="https://instagram.com/" target="_blank" aria-label="instagram">
                                          <i class="icon-rt-logo-instagram"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>


          </div>
      </div>
  </div> <!-- Product Modal End -->



  @endsection


  <script>
      var swiper = new Swiper('.mySwiper.pano-style', {
          slidesPerView: 5,
          spaceBetween: 5,
          freeMode: true,
          loop: true,
          autoplay: {
              delay: 2500,
              disableOnInteraction: false,
          },
          pagination: {
              el: '.swiper-pagination',
              clickable: true,
          },
          breakpoints: {
              // when window width is >= 320px
              320: {
                  slidesPerView: 1,
                  spaceBetween: 10
              },
              // when window width is >= 480px
              480: {
                  slidesPerView: 2,
                  spaceBetween: 10
              },
              // when window width is >= 640px
              640: {
                  slidesPerView: 3,
                  spaceBetween: 10
              },
              // when window width is >= 768px
              768: {
                  slidesPerView: 4,
                  spaceBetween: 10
              },
              // when window width is >= 1024px
              1024: {
                  slidesPerView: 5,
                  spaceBetween: 5
              }
          }
      });
  </script>


  <script>
      document.addEventListener("DOMContentLoaded", function() {
          let lazyVideos = [].slice.call(document.querySelectorAll("video.lazyload"));
          if ("IntersectionObserver" in window) {
              let lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
                  entries.forEach(function(video) {
                      if (video.isIntersecting) {
                          for (let source in video.target.children) {
                              let videoSource = video.target.children[source];
                              if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                                  videoSource.src = videoSource.dataset.src;
                              }
                          }
                          video.target.load();
                          video.target.classList.remove("lazyload");
                          lazyVideoObserver.unobserve(video.target);
                      }
                  });
              });
              lazyVideos.forEach(function(lazyVideo) {
                  lazyVideoObserver.observe(lazyVideo);
              });
          }
      });
  </script>