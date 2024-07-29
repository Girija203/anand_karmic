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
                                    <li class="breadcrumb-item">Manage Product</li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                
                            <h4 class="page-title ">Add variant for <span class="text-muted">{{$product->title}}</span> </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link rounded-0 pt-2 pb-2" aria-current="page"
                                            href="{{ route('product.index') }}">Products List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-0 pt-2 pb-2" href="#">Add Main Product
                                            Product</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body p-0 pt-4 justify-content-center">
                                          <form class="row g-3" method="POST" action="{{ route('product-variant-color.store') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input class="form-control" type="hidden" name="main_product_id" id="main_product_id" value="{{$product->id}}">
            @error('main_product_id')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <label for="color_id" class="col-form-label">Color</label>
            <select class="form-control" name="color_id" id="color_id">
                <option value="">Select Color</option>
                @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
            @error('color_id')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <label for="product_id" class="col-form-label">Product</label>
            <select id="product_id" class="form-control" name="product_id">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                @endforeach
            </select>
            @error('product_id')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="d-flex justify-content-evenly">
            <button type="submit" class="btn btn-primary waves-effect waves-light" name="action" value="save">
                Save
            </button>
            <button type="submit" class="btn btn-light waves-effect waves-light" name="action" value="save_and_new">
                Save and New
            </button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary waves-effect m-l-5">
                Cancel
            </a>
        </div>
    </div>
</form>
                                       {{-- <div class="m-b-30">

                                            </div> --}}
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
