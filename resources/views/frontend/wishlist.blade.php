
   @extends('frontend.layouts.app')
  
  @section('content')
<main>
<section class="wishlist-section section-space-ptb border-bottom-1">
        <div class="container">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <form class="cart-form" action="#">
                <div class="table-responsive">
   <table class="cart-wishlist-table table align-middle">
    <thead>
        <tr>
            <th class="remove"></th>
            <th class="name" colspan="2">Product</th>
            <th class="price">Price</th>
            <th class="quantity">Add To Cart</th>
        </tr>
    </thead>
    <tbody>
        @foreach($wishlist as $item)
            <tr>
                <td class="remove">
                    <a href="{{ route('wishlist.remove', $item->id) }}" class="remove-btn">×</a>
                </td>
                <td class="thumbnail">
                    <a href="product-details.html">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->title }}" width="100" height="100" loading="lazy" />
                    </a>
                </td>
                <td class="name">
                    <a href="product-details.html">{{ $item->product->title }}</a>
                </td>
                <td class="price"><span>₹ {{ $item->productColor->offer_price }}</span></td>
                <td class="quantity">
                    <button class="btn btn-primary btn-sm add-to-cart" data-product-id="{{ $item->product->id }}">Add To Cart</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- Wishlist Section End -->
    </main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            $.ajax({
                url: '{{ route('wishlist.addToCart') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = "{{ route('cart') }}";
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>
     @endsection