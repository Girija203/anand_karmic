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
                                    <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">Coupon</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Coupon Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Coupon Create</h4>

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
                                                    {{-- action="{{ route('coupons.store') }}" --}}
                                                    @csrf
                                                <input type="text" value="2" hidden id="coupon_type_id" name="coupon_type_id">

                                                    <label for="name"
                                                        class="col-sm-2 col-form-label mandatory">Name</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text" name="name"
                                                            id="name">
                                                        @error('name')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <label for="code"
                                                        class="col-sm-2 col-form-label mandatory">Code</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text" name="code"
                                                            id="code">
                                                        @error('code')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <label for="start_date" class="col-sm-2 col-form-label mandatory">Start
                                                        Date</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="date" name="start_date"
                                                            id="start_date">
                                                        @error('start_date')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <label for="end_date" class="col-sm-2 col-form-label mandatory">End
                                                        Date</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="date" name="end_date"
                                                            id="end_date">
                                                        @error('end_date')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <label for="minimum_purchase_price"
                                                        class="col-sm-2 col-form-label mandatory">Minimum
                                                        Purchase Price(₹)</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text"
                                                            name="minimum_purchase_price" id="minimum_purchase_price">
                                                        @error('minimum_purchase_price')
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
                                                                    <option value="percentage">Percentage(%)</option>
                                                                    <option value="fixed">Amount(₹)</option>
                                                                </select>
                                                            </div>
                                                            <input type="text" name="discount_value" id="discount_value"
                                                                class="form-control" placeholder="Discount"
                                                                aria-label="Discount" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>

                                                    <label for="usage_limit" class="col-sm-2 col-form-label mandatory">Usage
                                                        Limit</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="number" name="usage_limit"
                                                            id="usage_limit">
                                                        @error('usage_limit')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div>

                                                        <label for="user"
                                                            class="col-sm-2 col-form-label mandatory">User</label>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-4 mb-4">
                                                                <select class="form-control select2" name="user"
                                                                    id="user" onchange="updateInputField()">
                                                                    <option value="">select</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-4 mb-4">
                                                                <ul id="userList" style="list-style-type: none;">
                                                                </ul>
                                                            </div>
                                                        </div>










                                                    </div>

                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">
                                                            <button
                                                                class="btn btn-primary waves-effect waves-light confim_btn">Submit</button>
                                                            <a href="{{ route('coupons.index') }}"
                                                                class="btn btn-secondary waves-effect m-l-5">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script>
        // Create an object to keep track of displayed users
        var displayedUsers = {};

        function updateInputField() {
            var select = document.getElementById("user");
            var userList = document.getElementById("userList");

            if (select.selectedIndex > 0) {
                var userName = select.options[select.selectedIndex].text;
                var userId = select.value;

                // Check if the user is already displayed
                if (!displayedUsers[userId]) {
                    var li = document.createElement("li");
                    li.setAttribute("id", "user-" + userId);

                    var idSpan = document.createElement("span");
                    var nameSpan = document.createElement("span");
                    idSpan.setAttribute('class', "selected_user_id");
                    idSpan.textContent = `${userId} `;
                    nameSpan.textContent = `Name: ${userName}  `;


                    var removeIcon = document.createElement("span");
                    removeIcon.textContent = "❌";
                    removeIcon.style.cursor = "pointer";
                    removeIcon.onclick = function() {
                        removeUser(userId);
                    };

                    li.appendChild(idSpan);
                    li.appendChild(nameSpan);
                    li.appendChild(removeIcon);
                    userList.appendChild(li);

                    // Add the user to the displayedUsers object
                    displayedUsers[userId] = true;
                }
            }
        }

        function removeUser(userId) {
            var li = document.getElementById("user-" + userId);
            li.parentNode.removeChild(li);
            delete displayedUsers[userId];
        }
    </script>
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
            //Select2 
            $("#user").select2({});
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
                var userId = $('.selected_user_id');
                console.log(userId);
                var selectet_userList = [];
                for (var span of userId) {
                    console.log(span.textContent);
                    selectet_userList.push(span.textContent);
                }
                console.log('selectet_userList...........', selectet_userList);
                $.ajax({
                    url: "{{ route('coupons.store') }}",
                    type: 'post',
                    data: {
                        coupon_type_id: coupon_type_id,
                        name: name,
                        code: code,
                        start_date: start_date,
                        end_date: end_date,
                        minimum_purchase_price: minimum_purchase_price,
                        discount_type: discount_type,
                        discount_type: discount_type,
                        discount_value: discount_value,
                        usage_limit: usage_limit,
                        selectet_userList: selectet_userList,
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
    </script>
@endsection
























{{-- 
                 // var name = $('.name').val();
                // var code = $('.code').val();
                // var start_date = $('.start_date').val();
                // var end_date = $('.end_date').val();
                // var minimum_purchase_price = $('.minimum_purchase_price').val();
                // var discount_type = $('.discount_type').val();
                // var discount_value = $('.discount_value').val();
                // var usage_limit = $('.usage_limit').val();
                
                
                // let data = {
                //         name: name,
                //         code: code,
                //         // start_date: start_date,
                //         // end_date: end_date,
                //         // minimum_purchase_price: minimum_purchase_price,
                //         // discount_type: discount_type,
                //         // discount_type: discount_type,
                //         // discount_value: discount_value,
                //         // usage_limit: usage_limit,
                //         // selectet_userList: selectet_userList,
                //     },

                // name:name,
                // code:code,
                // start_date:start_date,
                // end_date:end_date,
                // minimum_purchase_price:minimum_purchase_price,
                // discount_type:discount_type,
                // discount_type:discount_type,
                // discount_value:discount_value,
                // usage_limit:usage_limit,
                
                
                --}}
