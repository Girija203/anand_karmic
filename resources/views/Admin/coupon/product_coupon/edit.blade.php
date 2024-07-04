@extends('Admin.layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">Product Coupon</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Product Coupon Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Product Coupon Edit</h4>

                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>

                                            </div>
                                            <div>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <div class="row g-3">
                                                    {{-- <form class="row g-3" method="POST" action="{{ route('coupons.store') }}"> --}}
                                                    @csrf
                                                    <input type="text" value="3" hidden id="coupon_type_id"
                                                        name="coupon_type_id">
                                                    <label for="name"
                                                        class="col-sm-2 col-form-label mandatory">Name</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text" name="name"
                                                            id="name" value="{{ old('name', $coupon->name) }}">
                                                        @error('shipping_rule')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <label for="name"
                                                        class="col-sm-2 col-form-label mandatory">Code</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text" name="code"
                                                            id="code" value="{{ old('code', $coupon->code) }}">
                                                        @error('condition_to')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <label for="name" class="col-sm-2 col-form-label mandatory">Start
                                                        Date</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="date" name="start_date"
                                                            id="start_date"
                                                            value="{{ old('start_date', $coupon->start_date) }}">
                                                        @error('start_date')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <label for="name" class="col-sm-2 col-form-label mandatory">End
                                                        Date</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="date" name="end_date"
                                                            id="end_date" value="{{ old('end_date', $coupon->end_date) }}">
                                                        @error('end_date')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <label for="name" class="col-sm-2 col-form-label mandatory">Minimum
                                                        Purchase Price(₹)</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text"
                                                            name="minimum_purchase_price" id="minimum_purchase_price"
                                                            value="{{ old('minimum_purchase_price', $coupon->minimum_purchase_price) }}">
                                                        @error('condition_to')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label class="col-sm-2 col-form-label">Discount (₹)<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <select name="discount_type" id="discount_type"
                                                                    class="form-control">
                                                                    <option
                                                                        value="percentage"{{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>
                                                                        Percentage(%)</option>
                                                                    <option
                                                                        value="fixed"{{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>
                                                                        Amount(Rs.)</option>
                                                                </select>
                                                            </div>
                                                            <input type="text" name="discount_value" class="form-control"
                                                                placeholder="Discount" aria-label="Discount"
                                                                aria-describedby="basic-addon1" id="discount_value"
                                                                value="{{ old('discount_value', $coupon->discount_value) }}">
                                                        </div>
                                                    </div>

                                                    <label for="usage_limit" class="col-sm-2 col-form-label mandatory">Usage
                                                        Limit</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="number" name="usage_limit"
                                                            id="usage_limit"
                                                            value="{{ old('usage_limit', $coupon->usage_limit) }}">
                                                        @error('usage_limit')
                                                            <span class="error"
                                                                style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label for="product"
                                                            class="col-sm-2 col-form-label mandatory">Product</label>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-4 mb-4">
                                                                <select class="form-control select2" name="product"
                                                                    id="product" onchange="updateProductInputField()">
                                                                    <option value="">select</option>
                                                                    @foreach ($products as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-4 mb-4">
                                                                <ul id="productList" style="list-style-type: none;"></ul>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <label class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <select class="form-control select2" name="status"
                                                            id="statuses">
                                                            <option value="1"
                                                                {{ $coupon->status == 1 ? 'selected' : '' }}>Active
                                                            </option>
                                                            <option value="0"
                                                                {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive
                                                            </option>
                                                        </select>
                                                        @error('status')
                                                            <span class="error"
                                                                style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>




                                                </div>

                                                <div class="form-group">
                                                    <div class="d-flex justify-content-evenly">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light confim_btn">Submit</button>
                                                        <a href="{{ route('coupons.index') }}"
                                                            class="btn btn-secondary waves-effect m-l-5">Cancel</a>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div> <!-- end row-->








            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Karmic - Theme by <b>Syscorp</b>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--These jQuery libraries for
                                                                            chosen need to be included-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href= 
"https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />

    <!--These jQuery libraries for select2
                                                                             need to be included-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <link rel="stylesheet" href= 
"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />

    

    <script>
        $(document).ready(function() {

            var displayedProducts = {}
             var removedProducts = [];
            var ExistProducts = @json($productCoupons);
            var productList = document.getElementById("productList");
            console.log('ExistProducts...................', ExistProducts);
            ExistProducts.map((product) => {
                if (!displayedProducts[product.product_id]) {
                    var li = document.createElement("li");
                    li.setAttribute("id", "product-" + product.product_id);

                    var idSpan = document.createElement("span");
                    var nameSpan = document.createElement("span");
                    idSpan.setAttribute('class', "selected_product_id");
                    idSpan.textContent = `${product.product_id} `;
                    nameSpan.textContent = `Name: ${product.product.title}  `;

                    var removeIcon = document.createElement("span");
                    removeIcon.textContent = "❌";
                    removeIcon.style.cursor = "pointer";
                    removeIcon.onclick = function() {
                        removeProduct(product.product_id);
                    };

                    li.appendChild(idSpan);
                    li.appendChild(nameSpan);
                    li.appendChild(removeIcon);
                    productList.appendChild(li);
                    displayedProducts[product.product_id] = true;
                }

            });

            function removeProduct(productId) {
                var li = document.getElementById("product-" + productId);
                li.parentNode.removeChild(li);
                 removedProducts.push(productId);
                delete displayedProducts[productId];
            }
            $("#product").select2({});
            $(".confim_btn").on('click', function(e) {
                e.preventDefault();
                var coupon_type_id = $('#coupon_type_id').val();
                var name = $('#name').val();
                var code = $('#code').val();
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                var minimum_purchase_price = $('#minimum_purchase_price').val();
                var discount_type = $('#discount_type').val();
                var discount_value = $('#discount_value').val();
                var usage_limit = $('#usage_limit').val();
                var status = $('#statuses').val();
                var productId = $('.selected_product_id');
                var selected_productList = [];
                for (var span of productId) {
                    selected_productList.push(span.textContent);
                }
                console.log('selectet_userList...........', selected_productList);
                $.ajax({
                    url: `{{ route('coupons.update', ['id' => $coupon->id]) }}`,
                    type: 'POST',
                    data: {
                        coupon_type_id: coupon_type_id,
                        name: name,
                        code: code,
                        start_date: start_date,
                        end_date: end_date,
                        minimum_purchase_price: minimum_purchase_price,
                        discount_type: discount_type,
                        discount_value: discount_value,
                        usage_limit: usage_limit,
                        status: status,
                        selected_productList: selected_productList,
                        removedProducts: removedProducts,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        // alert('success.,............');  
                        window.location.href = "{{ route('coupons.index') }}";
                    },
                    error: function(result) {
                        alert('error.,............');
                    },

                });



            });



        });


        var displayedProducts = {};

        function updateProductInputField() {
            var select = document.getElementById("product");
            var productList = document.getElementById("productList");

            if (select.selectedIndex > 0) {
                var productName = select.options[select.selectedIndex].text;
                var productId = select.value;

                // Check if the user is already displayed
                if (!displayedProducts[productId]) {
                    var li = document.createElement("li");
                    li.setAttribute("id", "product-" + productId);

                    var idSpan = document.createElement("span");
                    var nameSpan = document.createElement("span");
                    idSpan.setAttribute('class', "selected_product_id");
                    idSpan.textContent = `${productId} `;
                    nameSpan.textContent = `Name: ${productName}  `;

                    var removeIcon = document.createElement("span");
                    removeIcon.textContent = "❌";
                    removeIcon.style.cursor = "pointer";
                    removeIcon.onclick = function() {
                        removeProduct(productId);
                    };

                    li.appendChild(idSpan);
                    li.appendChild(nameSpan);
                    li.appendChild(removeIcon);
                    productList.appendChild(li);


                    // Add the user to the displayedUsers object
                    displayedProducts[productId] = true;
                }
            }
        }

        function removeProduct(productId) {
            var li = document.getElementById("product-" + productId);
            li.parentNode.removeChild(li);
            delete displayedProducts[productId];
        }
    </script>
    
@endsection
