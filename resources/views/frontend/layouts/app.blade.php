<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Karmic Bags</title>
<meta name="robots" content="noindex, follow" />
<meta name="Googlebot" content="noindex">
<meta name="description" content="Karmic Bags">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="frontend/assets/images/favicon.png">
<!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->
<!-- Font CSS -->
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
<!-- Vendor CSS (Bootstrap & Icon Font) -->
<link rel="stylesheet" href="{{ asset('/frontend/assets/css/bootstrap.min.css') }}">
<!-- Plugins CSS (All Plugins Files) -->
<link rel="stylesheet" href="{{ asset('/frontend/assets/css/roadthemes-icon.css') }}">
<link rel="stylesheet" href="{{ asset('/frontend/assets/css/swiper-bundle.min.css') }}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('/frontend/assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('/frontend/assets/css/slider.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    @keyframes float {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-14px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .image {
        animation: float 3s ease-in-out infinite;
        filter: drop-shadow(7px 3px 12px black);
    }

    .cursor {
        display: inline-block;
        background-color: #ccc;
        margin-left: 0.1rem;
        width: 3px;
        animation: blink 1s infinite;
    }

    .cursor.typing {
        animation: none;
    }

    @keyframes blink {
        0% {
            background-color: #ccc;
        }

        49% {
            background-color: #ccc;
        }

        50% {
            background-color: transparent;
        }

        99% {
            background-color: transparent;
        }

        100% {
            background-color: #ccc;
        }
    }
</style>
<style>
    .banner_title_text {
        font-size: 200px;
        margin: 0;
    }

    .banner_content_section p {
        font-size: 21px;
        text-transform: uppercase;
        margin: 0;
        letter-spacing: 1px;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 85%;
    }
</style>
<style>
    .glasmorphism {
        max-width: 350px;
        height: 350px;
        backdrop-filter: blur(16px) saturate(180%);
        -webkit-backdrop-filter: blur(16px) saturate(180%);
        background-color: rgba(255, 255, 255, 0.75);
        border-radius: 20px;
        border: 1px solid rgba(209, 213, 219, 0.3);
        rotate: 45deg;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgb(255 255 255 / 15%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 50px !important;
    }

    .glasmorphism img {
        rotate: -45deg;
    }
</style>
<style>
    /* Smooth scrolling for swiper container */
    .mySwiper {
        overflow-y: auto;
        scrollbar-width: none;
        /* Hide scrollbar for Firefox */
        -ms-overflow-style: none;
        /* Hide scrollbar for IE and Edge */
    }

    /* Hide scrollbar for Webkit (Chrome, Safari) */
    .mySwiper::-webkit-scrollbar {
        display: none;
    }

    /* Optional: Add smooth scrolling behavior */
    .back-lightblack {
        background-color: rgb(0 0 0 / 79%);
        transition: 0.3s;
    }
</style>
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

    swiper-container h6,
    swiper-container h1,
    swiper-container h3 {
        font-family: "Allerta Stencil", sans-serif !important;
    }

    .mySwiper.pano-style.position-relative {
        position: relative;
        width: 100%;
        margin-inline: auto;
        overflow: hidden;
    }

    .mySwiper.pano-style.position-relative::before {
        content: "";
        position: absolute;
        top: -70px;
        left: -10%;
        width: 120%;
        height: 100px;
        background: black;
        border-radius: 100%;
        z-index: 100;
    }

    .mySwiper.pano-style.position-relative::after {
        content: "";
        position: absolute;
        bottom: -60px;
        left: -10%;
        width: 120%;
        height: 100px;
        background: #000;
        border-radius: 100%;
        z-index: 1000;
    }

    .w-60 {
        width: 60%;
    }

    .swiper.pano-style .swiper-slide {
        margin-right: 10px !important;
    }
</style>
<style>
    swiper-container {
        width: 100%;
        height: 100%;
    }

    swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
</style>



<style>
    /* Loder style */

    #loader {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        background-color: #000 !important;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;


    }

    .loader {
        width: 8px;
        height: 40px;
        border-radius: 4px;
        display: block;
        background-color: currentColor;
        margin: 20px auto;
        position: relative;
        color: #f2f2f2;
        animation: animloader 0.3s 0.3s linear infinite alternate;
    }

    .loader::after,
    .loader::before {
        content: '';
        width: 8px;
        height: 40px;
        border-radius: 4px;
        background: currentColor;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 20px;
        animation: animloader 0.3s 0.45s linear infinite alternate;
    }

    .loader::before {
        left: -20px;
        animation-delay: 0s;
    }

    @keyframes animloader {
        0% {
            height: 48px;
        }

        100% {
            height: 4px;
        }
    }


    /* end */
</style>
</head>

<body>

    <!-- Loader -->
    <div id="loader">
        <div class="loader">
            <!-- <img src="{{ asset('/frontend/assets/images/load.gif') }}" alt="" srcset=""> -->
        </div>
    </div>
    <!-- Loder end -->
    <div>
        <header class="header position-relative top-0 w-full z-3">
            <!-- Header Bottom Area Start -->
            <div class="hader-bottom-area sticky-header">
                <div class="container-full px-50">
                    <div class="row align-items-center">
                        <div class="col-4 col-lg-2 ">
                            <!-- Logo Start -->
                            <div class="logo text-center text-lg-start">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('/frontend/assets/images/logo/karmic.png') }}" height="40" width="140" alt="logo" />
                                </a>
                            </div>
                            <!-- Logo Start -->
                        </div>

                        <div class="col-4 col-lg-10 ">
                            <!-- Main Menu Area Start -->
                            <nav class="nav-main-menu d-none d-lg-flex justify-content-end">
                                <!-- Main Menu Start -->
                                <ul class="main-menu justify-content-center align-items-center">
                                    <li class="main-menu-item has-children active">
                                        <a href="{{ route('home') }}" class="main-menu-link">Home</a>
                                    </li>
                                    <li class="main-menu-item has-children--mega">
                                        <a href="{{ route('about') }}" class="main-menu-link">About</a>
                                    </li>
                                    <li class="main-menu-item has-children">
                                        <a href="{{ route('shop') }}" class="main-menu-link">Shop</a>
                                    </li>
                                    <li class="main-menu-item has-children">
                                        <a href="{{ url('shop/filter?orderby=date') }}" class="main-menu-link">New
                                            Arrivals</a>
                                    </li>
                                    <li class="main-menu-item has-children">
                                        <a href="{{ route('contact') }}" class="main-menu-link">Contact Us</a>
                                    </li>
                                    @guest
                                    <li class="main-menu-item has-children">
                                        <a href="{{ route('normaluser.register') }}" class="main-menu-link">Login/Reg</a>
                                    </li>
                                    @endguest
                                    @auth
                                    <li class="main-menu-item has-children">
                                        <a href="{{ route('myaccount') }}" class="main-menu-link">Myaccount</a>
                                    </li>
                                    @endauth
                                    <li class="main-menu-item has-children">
                                        <button class="header-action-item d-none d-md-block" title="Search" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-search">
                                            <img src="{{ asset('./frontend/assets/images/headericon/search.png') }}" alt="" srcset="" width="22" class="op-6" />
                                        </button>
                                    </li>
                                    <li class="main-menu-item has-children">
                                        <a href="{{ route('wishlist') }}" class="header-action-item" title="Wishlist">
                                            <img src="{{ asset('./frontend/assets/images/headericon/hamburger.png') }}" alt="" srcset="" width="22" class="op-6" />
                                             <span class="header-action-item-count">
            @auth
                ({{ \App\Models\Wishlist::where('user_id', auth()->id())->count() }})
            @else
                (0)
            @endauth
        </span>
                                        </a>
                                    </li>
                                    <li class="main-menu-item has-children">
                                        <button class="header-action-item" title="Cart Bag" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-cart">
                                            <img src="{{ asset('./frontend/assets/images/headericon/shopping-cart.png') }}" alt="" srcset="" width="20" class="op-6" />
                                           <span class="header-action-item-count">
            @auth
                ({{ \App\Models\Cart::where('user_id', auth()->id())->count() }})
            @else
                ({{ session()->has('cart') ? count(session()->get('cart')) : 0 }})
            @endauth
        </span>
                                        </button>
                                    </li>

                                    <li class="main-menu-item has-children d-flex align-items-center">
                                        <div class="country-select">
    <form id="country-select-form" class="m-0" action="{{ route('setCountry') }}" method="POST">
        @csrf
        <select name="country" class="btn btn-black bg-black text-white p-1 rounded" id="country-select" onchange="document.getElementById('country-select-form').submit();">
             <option value="IN" {{ session('country') == 'IN' ? 'selected' : '' }}>India</option>
            <option value="US" {{ session('country') == 'US' ? 'selected' : '' }}>United States</option>    
            <option value="UK" {{ session('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
            <!-- Add more countries as needed -->
        </select>
    </form>
</div>

                                    </li>
                                </ul>

                                <!-- Main Menu End -->
                                <!-- Heaer Action Area Start -->
                            </nav>
                            <!-- Main Menu Area End -->
                           
                        </div>


                        <div class="col-4  d-flex flex-row-reverse">
                             <!-- Mobile Menu Toggole Button Start -->
                             <button class="header-action-item d-lg-none mobile-menu-action" aria-label="Mobile Menu Action Button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-mobile-menu" style="padding-left: 10px;">
                                <i class="icon-rt-bars-solid"></i>
                            </button>
                            <!-- Mobile Menu Toggole Button End -->
                            <!-- Search Button Start -->
                            <button class="header-action-item d-md-none" title="Search" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-search">
                                <i class="icon-rt-loupe"></i>
                            </button>
                            <!-- Search Button End -->
                        </div>
                    </div>
                </div>

            </div>
            <!-- Header Bottom Area End -->
           @php
$totalAmount = 0;
$exchangeRate = session('exchange_rate', 1);
$currencySymbol = session('currency_symbol', '₹'); 
@endphp

@foreach ($cart as $item)
    @php
        // Get the lowest offer price for the product color
        $offerPrice = \App\Models\ProductColor::where('product_id', $item->product_id)
            ->min('offer_price');

        // Fallback to the product's offer price if no offer price is found
        if (!$offerPrice) {
            $offerPrice = $item->product->offer_price;
        }

        // Calculate the total amount for each item
        $totalAmount += $item->quantity * $offerPrice;

        // Convert item price to selected currency
        $item->price = $offerPrice * $exchangeRate; // Update item price in selected currency
    @endphp
@endforeach

@php
// Convert total amount to selected currency
$totalAmountInCountryCurrency = $totalAmount * $exchangeRate;
@endphp
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-cart">
    <div class="offcanvas-cart-wrap">
        <div class="offcanvas-cart-header">
            <div class="offcanvas-cart-title">YOUR CART</div>
            <button type="button" class="btn-close text-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="cart-product">
                <!-- Cart Product Item Start -->
                @auth
                @if ($cart->isEmpty())
                    <p class="text-center">Your cart is empty.</p>
                @else
                    @foreach ($cart as $item)
                        @php
                            // Get the item’s converted price for display
                            $itemPriceInCountryCurrency = $item->price;
                        @endphp
                        <div class="cart-product-item">
                            <a href="product-details.html" class="cart-product-thum">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Product Cart One" />
                            </a>
                            <div class="cart-product-content">
                                <h6 class="cart-product-content-title">
                                    <a href="">{{ $item->name }}</a>
                                </h6>
                                <div class="cart-product-content-bottom">
                                    <span class="cart-product-content-quantity">{{ $item->quantity }} ×
                                    </span>
                                    <span class="cart-product-content-amount">
                                        <bdi>
                                            <span class="visually-hidden">Price:</span>
                                            {{ $currencySymbol }}<span class="item-total-price">{{ number_format($itemPriceInCountryCurrency, 2) }}</span>
                                        </bdi>
                                    </span>
                                </div>
                            </div>
                            <form action="{{ route('remove.from.cart', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="cart-product-close">x</button>
                            </form>
                        </div>
                    @endforeach
                @endif
                <!-- Cart Product Item End -->
            </div>
            <div class="offcanvas-cart-footer">
                <div class="mini-cart-total">
                    <strong class="mini-cart-subtotal">Subtotal</strong>
                    <span class="mini-cart-amount">
                        <bdi>
                            <span class="currency-symbol">{{ $currencySymbol }}</span>{{ number_format($totalAmountInCountryCurrency, 2) }}
                        </bdi>
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
@else
                    
               
                @if ($cart->isEmpty())
                    <p class="text-center">Your cart is empty.</p>
                @else
                    @foreach ($cart as $item)
                        @php
                            // Get the item’s converted price for display
                            $itemPriceInCountryCurrency = $item->price;
                        @endphp
                        <div class="cart-product-item">
                            <a href="product-details.html" class="cart-product-thum">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Product Cart One" />
                            </a>
                            <div class="cart-product-content">
                                <h6 class="cart-product-content-title">
                                    <a href="">{{ $item->name }}</a>
                                </h6>
                                <div class="cart-product-content-bottom">
                                    <span class="cart-product-content-quantity">{{ $item->quantity }} ×
                                    </span>
                                    <span class="cart-product-content-amount">
                                        <bdi>
                                            <span class="visually-hidden">Price:</span>
                                            {{ $currencySymbol }}<span class="item-total-price">{{ number_format($itemPriceInCountryCurrency, 2) }}</span>
                                        </bdi>
                                    </span>
                                </div>
                            </div>
                            {{-- <form action="{{ route('remove.from.cart', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="cart-product-close">x</button>
                            </form> --}}
                          
        <button type="button" class="cart-product-remove remove-from-cart" data-product-id="{{ $item->product_id }}">Remove</button>

                        </div>
                    @endforeach
                @endif
                <!-- Cart Product Item End -->
            </div>
            <div class="offcanvas-cart-footer">
                <div class="mini-cart-total">
                    <strong class="mini-cart-subtotal">Subtotal</strong>
                    <span class="mini-cart-amount">
                        <bdi>
                            <span class="currency-symbol">{{ $currencySymbol }}</span>{{ number_format($totalAmountInCountryCurrency, 2) }}
                        </bdi>
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
 @endauth
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
        <form action="{{ route('search') }}" method="GET" class="offcanvas-search-form">
            <input type="text" name="query" placeholder="Search..." class="offcanvas-search-input" />
            <button type="submit" class="offcanvas-search-submit">
                <i class="icon-rt-loupe"></i>
            </button>
        </form>
    </div>
</div>

                </div>
            </div>
            <!-- Offcanvas Mobile Menu Start -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-mobile-menu">
                <div class="offcanvas-header">
                    <!-- Logo Start -->
                    <div class="logo text-center text-lg-start">
                        <a href="index.html">
                        <img src="{{ asset('/frontend/assets/images/logo/karmic.png') }}" height="40" width="140" alt="logo" />
                        </a>
                    </div>
                    <!-- Logo Start -->
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <nav class="navbar-mobile-menu">
                        <ul class="mobile-menu">
                            <li class="mobile-menu-item">
                                <a href="index.html" class="mobile-menu-link">Home</a>
                            </li>
                            <li class="mobile-menu-item">
                                <a href="about-us.html" class="mobile-menu-link">About</a>
                            </li>
                            <li class="mobile-menu-item">
                                <a href="shop.html" class="mobile-menu-link">shop</a>
                            </li>
                            <li class="mobile-menu-item">
                                <a href="{{ url('shop/filter?orderby=date') }}" class="mobile-menu-link">New
                                    Arrivals</a>
                            </li>
                            <li class="mobile-menu-item">
                                <a href="contact-us.html" class="mobile-menu-link">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Offcanvas Mobile Menu End -->

        </header>
    </div>


    @yield('content')

    @php
    use App\Models\Footer;
    use App\Models\FooterLink;
    use App\Models\SocialMediaLink;
    @endphp

    @php

    $footer = Footer::all();

    $firstcolumn = FooterLink::where('column', 1)->get();
    $secondcolumn = FooterLink::where('column', 2)->get();
    $thirdcolumn = FooterLink::where('column', 3)->get();

    $medialink = SocialMediaLink::all();

    @endphp
    <!-- Footer Area Start -->
    @foreach ($footer as $footers)
    <footer class="footer-area">
        <div class="footer-top-area section-space-pt">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-8">
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3">
                            <div class="col">
                                <!-- Footer Widget Start -->
                                <div class="footer-widget m-0">
                                    <h4 class="footer-widget--title" title="Company">
                                        {{ $footers->first_column }}
                                    </h4>
                                    @foreach ($firstcolumn as $firstcolumns)
                                    <ul class="widget--menu">
                                        <li class="widget--menu-item">
                                            <a href="{{ $firstcolumns->link }}" class="widget--menu-link">{{ $firstcolumns->title }}
                                            </a>
                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                                <!-- Footer Widget End -->
                            </div>
                            <div class="col">
                                <!-- Footer Widget Start -->
                                <div class="footer-widget m-0">
                                    <h4 class="footer-widget--title" title="Information">
                                        {{ $footers->second_column }}
                                    </h4>

                                    @foreach ($secondcolumn as $secondcolumns)
                                    <ul class="widget--menu">
                                        <li class="widget--menu-item">
                                            <a href="{{ $secondcolumns->link }}" class="widget--menu-link">{{ $secondcolumns->title }}</a>
                                        </li>

                                    </ul>
                                    @endforeach
                                </div>
                                <!-- Footer Widget End -->
                            </div>
                            <div class="col">
                                <!-- Footer Widget Start -->
                                <div class="footer-widget m-0">
                                    <h4 class="footer-widget--title" title="Help"> {{ $footers->third_column }}
                                    </h4>
                                    @foreach ($thirdcolumn as $thirdcolumns)
                                    <ul class="widget--menu">
                                        <li class="widget--menu-item">
                                            <a href="{{ $thirdcolumns->link }}" class="widget--menu-link">{{ $thirdcolumns->title }}</a>
                                        </li>

                                    </ul>
                                    @endforeach
                                </div>
                                <!-- Footer Widget End -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-4">
                        <!-- Footer Widget Start -->
                        <div class="footer-widget m-0">
                            <h4 class="footer-widget--title" title="Sign Up Now & Get 10% Off">
                                Sign Up Now & Get 10% Off
                            </h4>
                            <div class="widget-newsletter">
                                <p class="fs-16 mb-3">
                                    Be the first to hear about special offers, new arrivals &
                                    more.
                                </p>

                                <ul class="d-flex gap-15 icon">
                                    @foreach ($medialink as $medialinks)
                                    <li>

                                        <a href="{{ $medialinks->link }}">
                                            <i class="{{ $medialinks->icon }}">

                                            </i>

                                        </a>


                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                        <!-- Footer Widget End -->
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom bg-dark py-3 my-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 text-center">
                        <p class="text-white mb-md-0 my-2 fs-16">
                            <!-- Copyright &copy; -->
                            <a href="https://hasthemes.com/" target="_blank">{{ $footers->copyright }}</a>.
                            <!-- All Rights Reserved. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @endforeach
    <!-- Footer Area End -->
    <!-- Bootstrap JS -->
    <!-- Vendors JS -->
    <script src="{{ asset('/frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('/frontend/assets/js/jquery.validate.min.js') }}"></script>
    <!-- Activation JS -->
    <script src="{{ asset('/frontend/assets/js/main.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/slider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const typedTextSpan = document.querySelector(".typed-text");
        const cursorSpan = document.querySelector(".cursor");

        const textArray = ["Welcome to", "Branded Leather Bags"];
        const typingDelay = 200;
        const erasingDelay = 100;
        const newTextDelay = 1000; // Delay between current and next text
        let textArrayIndex = 0;
        let charIndex = 0;

        function type() {
            if (charIndex < textArray[textArrayIndex].length) {
                if (!cursorSpan.classList.contains("typing"))
                    cursorSpan.classList.add("typing");
                typedTextSpan.textContent +=
                    textArray[textArrayIndex].charAt(charIndex);
                charIndex++;
                setTimeout(type, typingDelay);
            } else {
                cursorSpan.classList.remove("typing");
                setTimeout(erase, newTextDelay);
            }
        }

        function erase() {
            if (charIndex > 0) {
                if (!cursorSpan.classList.contains("typing"))
                    cursorSpan.classList.add("typing");
                typedTextSpan.textContent = textArray[textArrayIndex].substring(
                    0,
                    charIndex - 1
                );
                charIndex--;
                setTimeout(erase, erasingDelay);
            } else {
                cursorSpan.classList.remove("typing");
                textArrayIndex++;
                if (textArrayIndex >= textArray.length) textArrayIndex = 0;
                setTimeout(type, typingDelay + 1100);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            if (textArray.length) setTimeout(type, newTextDelay + 250);
        });
    </script>
    <script>
        // Function to check if the target swiper slide with a specific ID is active and auto-click the element with ID "auto-click"
        function checkAndAutoClick() {
            const targetSlideId = 'your-slide-id'; // ID of the target swiper slide
            const autoClickElement = document.getElementById('auto-click'); // Element to auto-click

            // Check if the swiper slide with the specified ID is active
            const activeSlide = document.querySelector('.mySwiper.animeslide .swiper-slide-active');
            if (activeSlide && activeSlide.id === targetSlideId) {
                setTimeout(function() {
                    // autoClickElement.click(); // Auto-click the element after 10 seconds
                }, 3000);
            }

            const mySwiper = document.querySelector('.mySwiper.animeslide').swiper;
            if (mySwiper.isEnd) {

                // setTimeout(function() {
                // mySwiper.slideTo(0); // Auto-click the element after 10 seconds
                mySwiper.mousewheel.disable();
                //  }, 1000);
                // Move back to the first slide
            }
        }

        const mySwiper = document.querySelector('.mySwiper.animeslide').swiper;

        // Function to disable mousewheel control
        function disableMousewheel() {
            mySwiper.mousewheel.disable();
        }

        // Function to enable mousewheel control
        function enableMousewheel() {
            mySwiper.mousewheel.enable();
        }

        // Check if swiper is at the end

        if (mySwiper.isEnd) {
            // Add an event listener for mousewheel event on swiper container
            const swiperContainer = document.querySelector('.mySwiper.animeslide');
            swiperContainer.addEventListener('mousewheel', function(event) {
                if (event.deltaY > 0) { // Scrolled down
                    disableMousewheel(); // Disable mousewheel control
                }
            });
        }
        // Event listener to re-enable mousewheel control when mouse moves
        document.addEventListener('mousemove', enableMousewheel);

        // Check for the target swiper slide with the specific ID periodically
        const interval = setInterval(checkAndAutoClick, 150); // Check every 100 milliseconds
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
       $(document).ready(function() {
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif

            @if (session('error'))
                toastr.error('{{ session('error') }}');
            @endif

            @if (session('info'))
                toastr.info('{{ session('info') }}');
            @endif

            @if (session('warning'))
                toastr.warning('{{ session('warning') }}');
            @endif
        });
        </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide the loader and show the content after the page has fully loaded
            const loader = document.getElementById('loader');
            const content = document.querySelector('.content');

            loader.style.display = 'none';
            content.style.display = 'block';

            // Show the loader before the page unloads (when reloading or navigating away)
            window.addEventListener('beforeunload', function() {
                loader.style.display = 'block';
                content.style.display = 'none';
            });
        });
    </script>
</body>

</html>