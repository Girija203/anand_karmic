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
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Coupon Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Coupon Edit</h4>

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
                                                <form class="row g-3" method="POST"
                                                    action="{{ route('coupons.update', $coupon->id) }}">
                                                    @csrf

                                                    <label for="name"
                                                        class="col-sm-2 col-form-label mandatory">Name</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text" name="name"
                                                            id="name" value="{{ $coupon->name }}">
                                                        @error('shipping_rule')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <label for="name"
                                                        class="col-sm-2 col-form-label mandatory">Code</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text" name="code"
                                                            id="name" value="{{ $coupon->code }}">
                                                        @error('condition_to')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <label for="name" class="col-sm-2 col-form-label mandatory">Start
                                                        Date</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="date" name="start_date"
                                                            id="name" value="{{ $coupon->start_date }}">
                                                        @error('start_date')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <label for="name" class="col-sm-2 col-form-label mandatory">End
                                                        Date</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="date" name="end_date"
                                                            id="name" value="{{ $coupon->end_date }}">
                                                        @error('end_date')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <label for="name" class="col-sm-2 col-form-label mandatory">Minimum
                                                        Purchase Price($)</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <input class="form-control" type="text"
                                                            name="minimum_purchase_price" id="name"
                                                            value="{{ $coupon->minimum_purchase_price }}">
                                                        @error('condition_to')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label class="col-sm-2 col-form-label">Discount($)<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <select name="discount_type" id=""
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
                                                                aria-describedby="basic-addon1"
                                                                value="{{ $coupon->discount_value }}">
                                                        </div>
                                                    </div>
                                                    <label class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-4 mb-4">
                                                        <select class="form-control select2" name="status">
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
                                                        class="btn btn-primary waves-effect waves-light">Submit</button>
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
@endsection
