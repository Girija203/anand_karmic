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
                                    <li class="breadcrumb-item"><a href="{{ route('shippings.index') }}">Shipping</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Shipping Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Shipping Create</h4>

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
                                                    action="{{ route('shippings.store') }}">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">City/Delivery Area</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="city_id">
                                                                <option value="">Select</option>
                                                                @foreach ($city as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}, {{ $item->state->name }},
                                                                        {{ $item->country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('city_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Shipping Rule</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="shipping_rule"
                                                                id="name">
                                                            @error('shipping_rule')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label class="col-sm-2 col-form-label">Type</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="type">
                                                                <option value="">Select</option>
                                                                <option value="Based on Product Price">Based on Product
                                                                    Price</option>
                                                                <option value="Based on Product Weight">Based on Product
                                                                    Weight</option>
                                                                <option value="Based on Product Quantity">Based on Product
                                                                    Quantity</option>

                                                            </select>
                                                            @error('type')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Condition From($)</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="condition_from"
                                                                id="name">
                                                            @error('condition_from')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Condition To($)</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="condition_to"
                                                                id="name">
                                                            @error('condition_to')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Shipping Fee($)</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="shipping_fee"
                                                                id="name">
                                                            @error('condition_to')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>



                                                    </div>

                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                                            <a href="{{ route('shippings.index') }}"
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
