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
                
                            <h4 class="page-title ">Edit variant for <span class="text-muted">{{$product->title}}</span> </h4>
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
                                        <a class="nav-link active rounded-0 pt-2 pb-2" href="#">Edit Main Product
                                            Product</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body p-0 pt-4 justify-content-center">
  <form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <input class="form-control" type="hidden" name="main_product_id" id="main_product_id" value="{{$product->id}}">
            @error('main_product_id')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
   @foreach ($productVariantColors as $variant)
   <div class="row">
    <div class="col-10">
<div class="row border rounded p-2 mb-3">
    <div class="col-8">
        <label for="variant_colors[{{ $variant->id }}][color_id]" class="col-form-label">Color</label>
            <select class="form-control" name="variant_colors[{{ $variant->id }}][color_id]" id="variant_colors_{{ $variant->id }}_color_id">
                <option value="">Select Color</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}" {{ $color->id == $variant->color_id ? 'selected' : '' }}>{{ $color->name }}</option>
                @endforeach
            </select>
            @error('variant_colors.{{ $variant->id }}.color_id')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror

            <label for="variant_colors[{{ $variant->id }}][product_id]" class="col-form-label">Product</label>
            <select id="variant_colors_{{ $variant->id }}_product_id" class="form-control" name="variant_colors[{{ $variant->id }}][product_id]">
                <option value="">Select Product</option>
                @foreach ($products as $productItem)
                    <option value="{{ $productItem->id }}" {{ $productItem->id == $variant->product_id ? 'selected' : '' }}>{{ $productItem->title }}</option>
                @endforeach
            </select>
            @error('variant_colors.{{ $variant->id }}.product_id')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        
    </div>
    <div class="col-4 d-flex align-content-center justify-content-center flex-wrap">
    <button class="delete-variant-color btn btn-danger" data-id="{{ $variant->id }}">Delete</button>
    </div>
   </div>
    </div>
   </div>
   
    
@endforeach    
<div class="form-group m-2 pt-2">
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

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-variant-color').on('click', function(e) {
            e.preventDefault();
            var variantId = $(this).data('id');

            if (confirm('Are you sure you want to delete this variant color?')) {
                $.ajax({
                    url: '/variant-color/' + variantId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            // Optionally, remove the deleted variant's row from the DOM
                            setTimeout(function() {
                                location.reload(); // Reload after a slight delay to show the success message
                            }, 1000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Something went wrong. Please try again.');
                    }
                });
            }
        });
    });
</script>


@endsection
