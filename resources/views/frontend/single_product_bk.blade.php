@extends('frontend.layouts.app')


@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            font-size: 2rem;
            /* Adjust the size of the stars */
        }

        .rating input {
            display: none;
        }

        .rating label {
            color: #ddd;
            cursor: pointer;
        }

        .rating input:checked~label,
        .rating input:checked~label~label {
            color: #f5b301;
            /* Color of the selected stars */
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #f5b301;
            /* Color of the stars on hover */
        }
    </style>

    <style>
        .star-rating .fa-star {
            font-size: 24px;
            cursor: pointer;
            color: antiquewhite;
        }

        .star-rating .fa-star.checked {
            color: gold;
        }

        #toggle-description {
            color: blue;
            cursor: pointer;

        }

        /* count incre and dec Starts */
        .quantity {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .quantity__minus,
        .quantity__plus {
            display: block;
            width: 33px;
            height: 33px;
            margin: 0;
            background: #dee0ee;
            text-decoration: none;
            text-align: center;
            line-height: 23px;
        }

        .quantity__minus:hover,
        .quantity__plus:hover {
            background: #575b71;
            color: #fff;
        }

        .quantity__minus {
            border-radius: 3px 0 0 3px;
        }

        .quantity__plus {
            border-radius: 0 3px 3px 0;
        }

        .quantity__input {
            /* width: 32px;
                                                        height: 19px; */
            width: 70px;
            height: 35px;
            margin: 0;
            padding: 0;
            text-align: center;
            border-top: 2px solid #dee0ee;
            border-bottom: 2px solid #dee0ee;
            border-left: 1px solid #dee0ee;
            border-right: 2px solid #dee0ee;
            background: #fff;
            color: #8184a1;
        }

        .quantity__minus:link,
        .quantity__plus:link {
            color: #8184a1;
        }

        .quantity__minus:visited,
        .quantity__plus:visited {
            color: #fff;
        }

        .comment-form-textarea {
            min-height: 100px !important;
            height: 100px !important;
        }

        /* count incre and dec Ends */
    </style>



    <main>
        <section class="breadcrumb-section border-top-1 py-5">
            <div class="container ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-start">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Karmic Model One
                        </li>
                    </ol>
                </nav>
            </div>
        </section>
        <!-- Product Details Section Start -->
        <section class="product-details-section">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-md-6">
                        <div class="product-item-details-box">
                            <h4 class="product-item-details-title">{{ $products->title }}</h4>
                            <div class="d-flex justify-content-between my-3">
                                <div class="product-card-price mt-2">
                                    @php
                                        $selectedColor = $productColors->first(); // Default to the first color
                                        $price = $selectedColor ? $selectedColor->price * $exchangeRate : 0;
                                        $offerPrice = $selectedColor ? $selectedColor->offer_price * $exchangeRate : 0;
                                    @endphp
                                    <span
                                        class="product-card-old-price"><del>{{ $currencySymbol }}{{ number_format($price, 2) }}</del></span>
                                    <span
                                        class="product-card-regular-price">{{ $currencySymbol }}{{ number_format($offerPrice, 2) }}</span>
                                </div>
                                <div class="product-item-details-rating d-flex align-items-center gap-2 text-black">
                                    <div class="product-item-details-rating-list d-flex">
                                        <i class="icon-rt-star-solid"></i>
                                        <i class="icon-rt-star-solid"></i>
                                        <i class="icon-rt-star-solid"></i>
                                        <i class="icon-rt-star-solid"></i>
                                        <i class="icon-rt-star-solid"></i>
                                    </div>
                                </div>
                            </div>

                            <p class="product-item-details-description mt-2" id="product-description">
                                {{ Str::limit($products->short_description, 150) }} <!-- Initial short description -->
                                <span id="more-text"
                                    style="display: none;">{{ substr($products->short_description, 150) }}</span>
                                <a href="javascript:void(0);" id="toggle-description" onclick="toggleDescription()">Show
                                    More</a>
                            </p>

                            <form class="product-color-radio-form">
                                <fieldset class="product-color-radio-wrap">
                                    <h6 class="mb-0 title">Color</h6>
                                    <div class="product-color-radio-buttons">
                                        @foreach ($productColors as $productColor)
                                            <input type="radio" id="color-lable-{{ $productColor->color->name }}"
                                                name="color" value="{{ $productColor->color->name }}"
                                                {{ $loop->first ? 'checked' : '' }}
                                                data-price="{{ $productColor->price }}"
                                                data-offer-price="{{ $productColor->offer_price }}">
                                            <label class="color-lable color-lable-{{ $productColor->color->name }}"
                                                for="color-lable-{{ $productColor->color->name }}">

                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </form>


                            <div class="product-item-stock in-stock mb-3">
                                <span class="stock-label visually-hidden">Availability:</span>
                                <span class="product-item-stock-in">{{ $productColor->qty }} In Stock</span>
                            </div>

                            <form action="{{ route('cart.add', $products->id) }}" method="post" id="addToCartForm">
                                @csrf


                                {{-- test Starts --}}
                                <div class="product-item-action-box d-flex gap-2 align-items-center">
                                    <div class="quantity">
                                        <button
                                            class="quantity__minus product-item-quantity-decrement product-item-quantity-button"><span>-</span></button>
                                        <input type="number" class="quantity__input" name="quantity" id="quantity"
                                            min="1"
                                            value="{{ $cart->where('product_id', $products->id)->first()->quantity ?? 1 }}">
                                        <button
                                            class="quantity__plus product-item-quantity-increment product-item-quantity-button"><span>+</span></button>
                                    </div>
                                    <a href="">
                                        <button type="submit" class="btn btn-primary btn-lg">Add to cart</button>
                                    </a>
                                </div>
                                {{-- test Ends --}}
                            </form>
                        </div>
                        <div>
                            @if (in_array($products->id, $wishlistProductIds))
                                <a href="{{ route('wishlist.delete', $products->id) }}">
                                    <i class="fa-solid fa-heart" filled></i>
                                    <span>Added to wishlist</span>
                                </a>
                            @else
                                <a href="#" class="product-item-wishlist-action mt-3"
                                    data-product-id="{{ $products->id }}" data-action="add">
                                    <i class="icon-rt-heart2"></i><span>Add to wishlist</span>
                                </a>
                            @endif
                        </div>


                        @if (!empty($product_sml_share))
                            <div class="social-share-wrap d-flex gap-1 mt-3">

                                <div class="social-share social-share-in-color d-flex gap-2">
                                    <p>Share:</p>
                                    @foreach ($product_sml_share as $items)
                                        <a class="social-share-link facebook" href="{{ $items->link }}" target="_blank"
                                            aria-label="facebook">
                                            <i class="{{ $items->icon }}"></i>
                                        </a>
                                    @endforeach
                                </div>

                            </div>

                            <a class="social-share-link copy-link" href="javascript:void(0);" onclick="copyToClipboard()"
                                aria-label="copy link">
                                <i class="fas fa-copy"></i>
                            </a>
                        @endif

                    </div>
                    <div class="col-md-6">
                        <div class="swiper product-details-lg-active">
                            <div class="swiper-wrapper">
                                @if ($products->colors->first()->images)
                                    @foreach ($products->colors->first()->images as $image)
                                        <div class="swiper-slide">
                                            <img class="w-75" src="{{ asset('storage/' . $image->multi_image) }}"
                                                alt="{{ $products->title }} Image" />
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <img class="w-75" src="{{ asset('images/products/default-image.jpg') }}"
                                            alt="Default Product Image" />
                                    </div>
                                @endif
                            </div>

                            <div class="product-details-button-next product-details-navigation-next">
                                <i class="icon-rt-arrow-right"></i>
                            </div>
                            <div class="product-details-button-prev product-details-navigation-prev">
                                <i class="icon-rt-arrow-left"></i>
                            </div>
                        </div>
                        <div class="swiper product-details-sm-thum-active mt-2">
                            <div class="swiper-wrapper">
                                @foreach ($products->colors->first()->images as $image)
                                    <div class="swiper-slide">

                                        <img src="{{ asset('storage/' . $image->multi_image) }}"
                                            alt="{{ $products->title }} Image" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->



        <!-- product Info Section Start -->
        <section class="product-info-wrapper section-space-ptb">
            <div class="container">
                <div class="nav product-tab-info justify-content-center" role="tablist">
                    <button class="product-tab-info-link active" data-bs-toggle="tab" data-bs-target="#nav-description"
                        type="button" role="tab">
                        Description
                    </button>
                    <button class="product-tab-info-link" data-bs-toggle="tab"
                        data-bs-target="#nav-additional-information" type="button" role="tab">
                        Additional Information
                    </button>
                    <button class="product-tab-info-link" data-bs-toggle="tab" data-bs-target="#nav-reviews"
                        type="button" role="tab">
                        Reviews
                    </button>
                </div>
                <div class="tab-content mt-6">
                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel" tabindex="0">
                        <p class="fs-16">
                            {!! $products->long_description !!}
                        </p>

                    </div>
                    <div class="tab-pane fade" id="nav-additional-information" role="tabpanel" tabindex="0">
                        <table class="additional-info-table">
                            <tbody>
                                @foreach ($specifications as $specification)
                                    <tr class="additional-info-table-tr">
                                        <th class="additional-info-table-item__label">{{ $specification->key->name }}</th>
                                        <td class="additional-info-table-item__value">
                                            <p>{{ $specification->specification }}</p>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-reviews" role="tabpanel" tabindex="0">
                        <div class="row container">
                            <div class="col-md-6">
                                <div class="product-info">
                                    <h2>{{ $products->name }}</h2>
                                    <!-- Display other product details here -->
                                    <!-- Product reviews -->
                                    <div class="product-reviews">
                                        <h3>Product Reviews</h3>
                                        @if ($reviews->count() > 0)
                                            <ul>
                                                @foreach ($reviews as $review)
                                                    <li>
                                                        <div class="review-header">
                                                            <span>Rating:
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="fas fa-star text-warning"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </span>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>{{ $review->review }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No reviews for this product yet.</p>
                                        @endif
                                    </div>
                                    <!-- Add your form for submitting new reviews here -->
                                </div>

                            </div>


                            <div class="col-md-6">
                                <!-- Product comments section start -->
                                <div class="product-add-new-comment">
                                    <h4 class="product-add-new-comment">Add a review</h4>
                                    <p>Your email address will not be published.</p>
                                    <div class="comment-form-rating">
                                        <form action="{{ route('reviews.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                                            <!-- <input type="hidden" name="rating" id="rating" value=""> -->

                                            <div class="comment-form-group">
                                                <label class="comment-form-label" for="comment">Your review&nbsp;<span
                                                        class="required">*</span></label>
                                                <textarea id="comment" name="review" class="comment-form-textarea" required></textarea>
                                                @error('review')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class=" d-flex flex-column">
                                                <div>
                                                    <label class="comment-form-label" for="rating">Your
                                                        rating&nbsp;<span class="required">*</span></label>

                                                </div>
                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rating"
                                                        value="5" /><label for="star5" title="5 stars"><i
                                                            class="fas fa-star"></i></label>
                                                    <input type="radio" id="star4" name="rating"
                                                        value="4" /><label for="star4" title="4 stars"><i
                                                            class="fas fa-star"></i></label>
                                                    <input type="radio" id="star3" name="rating"
                                                        value="3" /><label for="star3" title="3 stars"><i
                                                            class="fas fa-star"></i></label>
                                                    <input type="radio" id="star2" name="rating"
                                                        value="2" /><label for="star2" title="2 stars"><i
                                                            class="fas fa-star"></i></label>
                                                    <input type="radio" id="star1" name="rating"
                                                        value="1" /><label for="star1" title="1 star"><i
                                                            class="fas fa-star"></i></label>
                                                </div>
                                                @error('rating')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="comment-form-group">
                                                <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Product review End -->

                    <!-- Product Comments Section End -->
                </div>
            </div>
        </section>
        <!-- product Info Section End -->



        <section class="related-products-section section-space-pb border-bottom-1 container">
            <div class="container">
                <div class="section-title text-center my-4">
                    <h2 class="title">Related Products</h2>
                </div>
            </div>

            <!-- <swiper-container class="mySwiper position-relative" pagination="true" pagination-clickable="true" slides-per-view="4" space-between="15" free-mode="true" autoplay="true" loop="true"> -->

            <!-- test start -->
            <div class="row">
                @if ($relatedProducts->isEmpty())
                    <p>There is no relative products for this Product</p>
                @else
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-md-3">
                            <div class="card position-relative box-shad">
                                <div class="position-absolute r-0 card_icon">
                                    <i class="fa-solid fa-lock fs-15"></i>
                                </div>
                                <div class="p-2">
                                    @if ($relatedProduct->colors->isNotEmpty() && $relatedProduct->colors->first()->single_image)
                                        <img class="card-img-top object-fit-cover"
                                            src="{{ asset('storage/' . $relatedProduct->colors->first()->single_image) }}"
                                            alt="Card image cap" width="100%">
                                    @else
                                        <img class="card-img-top object-fit-cover"
                                            src="{{ asset('assets/admin/images/product_image_not_found.png') }}"
                                            alt="Default image" width="100%">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">{{ $relatedProduct->title }}</h6>
                                    <span>{{ $relatedProduct->color_count }} colors</span>
                                    <div class="d-flex justify-content-between align-items-center my-2">
                                        <a href="{{ route('single.product', $relatedProduct->id) }}">
                                            <button class="btn btn-black">Shop Now</button>
                                        </a>
                                        <span
                                            class="product-card-old-price"><del>{{ $currencySymbol }}{{ number_format($relatedProduct->getPriceInSelectedCurrency(), 2) }}</del></span>
                                        <span
                                            class="product-card-regular-price">{{ $currencySymbol }}{{ number_format($relatedProduct->getOfferPriceInSelectedCurrency(), 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- test end -->
            <!-- </swiper-container> -->
        </section>

    </main>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('/frontend/assets/js/modernizr-3.11.7.min.js') }}"></script>


    <!-- Plugins JS -->
    <script src="{{ asset('/frontend/assets/js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('/frontend/assets/js/ajax.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}


    <!-- <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const stars = document.querySelectorAll('.star-rating .fa-star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', (e) => {
                    const selectedRating = e.target.getAttribute('data-rating');
                    ratingInput.value = selectedRating; // Set the rating value to the hidden input
                    updateStarColors(selectedRating);
                });
            });

            const updateStarColors = (rating) => {
                stars.forEach(star => {
                    if (star.getAttribute('data-rating') <= rating) {
                        star.classList.add('checked');
                    } else {
                        star.classList.remove('checked');
                    }
                });
            };
        });
    </script> -->
    <script>
        $(document).ready(function() {
            $('.product-item-wishlist-action').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');

                $.ajax({
                    url: "{{ route('wishlist.add') }}",
                    method: 'POST',
                    data: {
                        product_id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = "{{ route('wishlist') }}";
                    },
                    error: function(response) {
                        alert(response.responseJSON.message);
                    }
                });
            });
        });
    </script>

    <script>
        function toggleDescription() {
            var moreText = document.getElementById("more-text");
            var toggleButton = document.getElementById("toggle-description");

            if (moreText.style.display === "none") {
                moreText.style.display = "inline";
                toggleButton.innerText = "Show Less";
            } else {
                moreText.style.display = "none";
                toggleButton.innerText = "Show More";
            }
        }
    </script>

    <script>
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
    </script>


    <script>
        function copyToClipboard() {
            var tempInput = document.createElement('input');
            var productUrl = window.location.href;
            tempInput.value = productUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            // Change the text of the icon to indicate the link has been copied
            var copyLinkButton = document.querySelector('.social-share-link.copy-link i');
            var originalText = copyLinkButton.className;
            copyLinkButton.className = 'fas fa-check'; // Change to a check mark icon or any other indicator

            // Optional: Revert the icon back to the original after a delay
            setTimeout(function() {
                copyLinkButton.className = originalText;
            }, 2000);
        }
    </script>



    <script></script>
@endsection
