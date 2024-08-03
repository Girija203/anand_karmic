@extends('frontend.layouts.app')

@section('content')
    <main id="product-list">
        <section class="shop-page section-space-ptb border-bottom-1">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 ">
                        <!-- Filter sidebar or any other content can go here -->
                    </div>

                    <div class="col-12 col-lg-9 ps-xl-6">
                        <div class="shop-all-product-wrapper">
                            <div class="shop-toolbar">
                                <!-- Toolbar content can go here -->
                            </div>
                        </div>
                        <div class="container">
    <h4>Search Results for "{{ $query }}"</h4>

    @if($products->isEmpty())
        <p>No products found.</p>
    @else
        <p>{{ $products->count() }} products found.</p>
        <div class="products-wrapper shop-view-item-grid">
            <div id="product-list"
                class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 mb-15 mt-4">

                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-4 mb-5">
                        <!-- Product Card Start -->
                        <div class="card position-relative box-shad h-100 mb-4">
                            <div class="p-2">
                                <a href="{{ route('single.product', $product->id) }}"
                                    class="card_height">
                                    @if ($product->colors->isNotEmpty() && $product->colors->first()->single_image)
                                        <img class="card-img-top object-fit-cover"
                                            src="{{ asset('storage/' . $product->colors->first()->single_image) }}"
                                            alt="Card image cap" width="100%">
                                    @else
                                        <img class="card-img-top object-fit-cover"
                                            src="{{ asset('assets/admin/images/product_image_not_found.png') }}"
                                            alt="Default image" width="100%">
                                    @endif
                                </a>
                            </div>

                            <div class="card-body">
                                <h6 class="card-title">{{ $product->title }}</h6>
                                <span>Category: {{ $product->category->name }}</span>
                                <span>{{ $product->colors->count() }} colors</span>
                                <div class="d-flex justify-content-between align-items-center my-2">
                                    <form action="{{ route('buy.now', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_color_id" value="{{ $product->colors->first()->id }}">
                                        <button class="btn btn-black">Buy Now</button>
                                    </form>

                                    <div class="d-flex flex-column">
                                        @php
                                            $productColor = $product->colors->first(); // Assuming you want the first color, adjust as necessary
                                        @endphp
                                        @if ($productColor)
                                            @if (is_null($productColor->offer_price))
                                                <span class="product-card-regular-price fw-600">
                                                    {{ $currencySymbol }}{{ number_format($productColor->price * $exchangeRate, 2) }}
                                                </span>
                                            @else
                                                <span class="product-card-old-price">
                                                    <del>{{ $currencySymbol }}{{ number_format($productColor->price * $exchangeRate, 2) }}</del>
                                                </span>
                                                <span class="product-card-regular-price fw-600">
                                                    {{ $currencySymbol }}{{ number_format($productColor->offer_price * $exchangeRate, 2) }}
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Card End -->
                    </div>
                @endforeach
                                    </div>
                                    <!-- Shop Pagination Area Start -->
                                    <div class="pagination-area">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                        <span aria-hidden="true">←</span>
                                                    </a>
                                                </li>
                                                <li class="page-item active" aria-current="page">
                                                    <a class="page-link" href="#">1</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                        <span aria-hidden="true">→</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- Shop Pagination Area End -->
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('/frontend/assets/js/modernizr-3.11.7.min.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('/frontend/assets/js/swiper-bundle.min.js') }}"></script>
    <!-- <script src="{{ asset('/frontend/assets/js/ajax.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
