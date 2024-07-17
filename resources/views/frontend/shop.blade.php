@extends('frontend.layouts.app')

@section('content')
    <main id="product-list">
        <section class="shop-page section-space-ptb border-bottom-1">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 ">
                        <aside class="shop-sidebar">
                            <div class="shop-sidebar-widget">
                                <h5 class="shop-sidebar-widget-title">Karmics Categories</h5>
                                <ul class="shop-sidebar-widget-list">
                                    @foreach ($categories as $category)
                                        <li class="shop-sidebar-widget-list-item">
                                            <a href="{{ route('shop.category', $category->id) }}"
                                                class="shop-sidebar-widget-list-link">{{ $category->name }}</a>
                                        </li>
                                    @endforeach



                                </ul>
                            </div>
                            <div class="shop-sidebar-widget">
                                <h5 class="shop-sidebar-widget-title">Filter By Price</h5>
                                <div class="sidebar-widget-item__filter price-range-filter">
                                    <form action="{{ route('products.filter') }}" method="GET">
                                        <div class="filter-slider">
                                            <div class="filter-progress"></div>
                                        </div>
                                        <div class="filter-range-input">
                                            <input type="range" name="min_price" id="range-min" class="range-min"
                                                min="0" max="10000" value="{{ request('min_price', 0) }}"
                                                step="100" aria-label="Min value" />
                                            <input type="range" name="max_price" id="range-max" class="range-max"
                                                min="0" max="10000" value="{{ request('max_price', 10000) }}"
                                                step="100" aria-label="Max value" />
                                        </div>
                                        <p class="filter-price-value">
                                            Price:
                                            <input type="text" id="input-min" class="input-min"
                                                value="{{ $currencySymbol }}{{ request('min_price', 0) }}"
                                                aria-label="Input min value" readonly />
                                            <span>—</span>
                                            <input type="text" id="input-max" class="input-max"
                                                value="{{ $currencySymbol }}{{ request('max_price', 10000) }}"
                                                aria-label="Input max value" readonly />
                                        </p>
                                        <button type="submit" class="filter-price-btn">Filter</button>
                                    </form>
                                </div>
                            </div>
                            <div class="shop-sidebar-widget">
                                <h5 class="shop-sidebar-widget-title">Size</h5>
                                <form action="{{ route('filter.bySpecifications') }}" method="GET">
                                    <ul class="shop-sidebar-widget-list shop-sidebar-widget-list-size">
                                        @foreach ($specifications as $item)
                                            <li class="shop-sidebar-widget-list-item">
                                                <input type="checkbox" id="spec_{{ $item->id }}"
                                                    name="specifications[]" value="{{ $item->specification }}" />
                                                <label for="spec_{{ $item->id }}">{{ $item->specification }}
                                                    ({{ $item->product()->count() }})
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <button type="submit" class="filter-price-btn">Filter</button>
                                </form>
                            </div>

                            <div class="shop-sidebar-widget">
                                <h5 class="shop-sidebar-widget-title">Product tags</h5>
                                <div class="shop-sidebar-widget-list shop-sidebar-widget-list-tags">
                                    <a href="shop.html" class="shop-sidebar-widget-list-link">Accessories</a>
                                    <a href="shop.html" class="shop-sidebar-widget-list-link">Collection</a>
                                    <a href="shop.html" class="shop-sidebar-widget-list-link">Clothing</a>
                                    <a href="shop.html" class="shop-sidebar-widget-list-link">Bags</a>
                                    <a href="shop.html" class="shop-sidebar-widget-list-link">New In Shop</a>

                                </div>
                            </div>
                        </aside>
                    </div>

                    <div class="col-12 col-lg-9  ps-xl-6">
                        <div class="shop-all-product-wrapper">
                            <div class="shop-toolbar">
                                <div class="shop-toolbar-left-side d-flex">
                                    <div class="shop-views shop-views-wrap">
                                        <button class="shop-display active" data-display="grid">
                                            <i class="icon-rt-apps-outline"></i>
                                            <span class="visually-hidden">Grid View</span>
                                        </button>
                                        <button class="shop-display" data-display="list">
                                            <i class="icon-rt-list-solid"></i>
                                            <span class="visually-hidden">List View</span>
                                        </button>
                                    </div>
                                    <p class="shop-products-result-count">
                                        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of
                                        {{ $totalProducts }} results
                                    </p>
                                </div>
                                <div class="shop-toolbar-right-side">
                                    <form action="{{ route('shop.filter') }}" method="GET">
                                        <select name="orderby" id="orderby" class="shop-selector-orderby"
                                            aria-label="Shop order" onchange="this.form.submit()">
                                            <option value="menu_order">Default sorting</option>
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="rating">Sort by average rating</option>
                                            <option value="date">Sort by latest</option>
                                            <option value="price-asc">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                                <span>{{ $product->colors->count() }} colors</span>
                                                <div class="d-flex justify-content-between align-items-center my-2">
                                                    <form action="{{ route('buy.now', $product->id) }}" method="POST">
                                                        @csrf
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const exchangeRate = {{ $exchangeRate }};
            const currencySymbol = '{{ $currencySymbol }}';

            const rangeMin = document.getElementById('range-min');
            const rangeMax = document.getElementById('range-max');
            const inputMin = document.getElementById('input-min');
            const inputMax = document.getElementById('input-max');

            function updatePriceInputs() {
                inputMin.value = currencySymbol + (rangeMin.value * exchangeRate).toFixed(2);
                inputMax.value = currencySymbol + (rangeMax.value * exchangeRate).toFixed(2);
            }

            rangeMin.addEventListener('input', updatePriceInputs);
            rangeMax.addEventListener('input', updatePriceInputs);

            updatePriceInputs();
        });
    </script>
@endsection
