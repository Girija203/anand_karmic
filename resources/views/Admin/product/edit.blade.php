@extends('Admin.layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
                                    <li class="breadcrumb-item">Product Management</li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Product Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-1 pt-2">
                                <a href="{{ route('product.index') }}" title="Product List">
                                    <button class="header-title btn btn-gery">Product List</button>
                                </a>
                                <a href="{{ route('product.create') }}" title="Product Create">
                                    <button class="header-title btn  btn_primary_color"> <i
                                            class="mdi mdi-plus-box  pe-1"></i>Create
                                        Product</button>
                                </a>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">

                                        </div>
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <form class="row g-3" method="post"
                                                    action="{{ route('product.update', $product->id) }}"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')

                                                    @csrf

                                                    {{-- @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif --}}

                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label for="main_image">Thumbnail image</label>

                                                            @if (isset($product->image))
                                                                <img src="{{ url('storage/' . $product->image) }}"
                                                                    alt="product Logo"
                                                                    style="max-width: 100px; max-height: 100px;">
                                                            @endif

                                                            <input class="form-control" type="file" name="main_image"
                                                                id="main_image">

                                                            @error('main_image')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>



                                                        <div class="col-md-12">
                                                            <label for="name" class=""> Product Name<span class="text text-danger">*</span> </label>
                                                            <div class="">
                                                                <input class="form-control" type="text" name="title"
                                                                    id="title"  value="{{ $product->title }}">
                                                                @error('title')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12">
                                                            <label for="multiple_images"> Select Multiple image<span class="text text-danger">*</span></label>

                                                            <input class="form-control" type="file"
                                                                name="multiple_images[]" id="multiple_images" multiple
                                                                value="{{ old('image') }}">

                                                            @error('multiple_images')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="col-md-12">
                                                            <label for="category_id">Category<span class="text text-danger">*</span></label>
                                                            <select id="category_id" class="form-control" name="category_id"
                                                                value="{{ old('category_id') }}" >
                                                                <option value="">Select Category</option>
                                                                @foreach ($category as $categories)
                                                                    <option value="{{ $categories->id }}"
                                                                        {{ $categories->id == $product->category_id ? 'selected' : '' }}>
                                                                        {{ $categories->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('category_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="subcategory_id">SubCategory</label>
                                                            <select id="subcategory_id" class="form-control"
                                                                name="subcategory_id" value="{{ old('subcategory_id') }}"
                                                               >
                                                                <option value="">Select SubCategory</option>
                                                                @foreach ($subcategory as $subcategories)
                                                                    <option
                                                                        {{ $subcategories->id == $product->subcategory_id ? 'selected' : '' }}
                                                                        value="{{ $subcategories->id }}">
                                                                        {{ $subcategories->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('subcategory_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="childcategory_id">ChildCategory</label>
                                                            <select id="childcategory_id" class="form-control"
                                                                name="childcategory_id"
                                                                value="{{ old('childcategory_id') }}">
                                                                <option value="">Select ChildCategory</option>
                                                                @foreach ($childcategory as $childcategories)
                                                                    <option
                                                                        {{ $childcategories->id == $product->childcategory_id ? 'selected' : '' }}
                                                                        value="{{ $childcategories->id }}">
                                                                        {{ $childcategories->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('childcategory_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="category_id">Brand<span class="text text-danger">*</span></label>

                                                            <select id="inputState" class="form-control" name="brand_id"
                                                                required value="{{ old('brand_id') }}">
                                                                <option>select Brand</option>
                                                                @foreach ($brand as $brands)
                                                                    <option value="{{ $brands->id }}"
                                                                        {{ $brands->id == $product->brand_id ? 'selected' : '' }}>
                                                                        {{ $brands->name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>

                                                            @error('status')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="name">Short description<span class="text text-danger">*</span> </label>
                                                            <div class="">
                                                                <textarea class="form-control" rows="3" name="short_description" value="{{ $product->short_description }}">{{ $product->short_description }}</textarea>
                                                                @error('short_description')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="name">Long description<span class="text text-danger">*</span> </label>
                                                            <div class="">
                                                                <textarea id="summernote" name="long_description" value="{{ $product->long_description }}">{{ $product->long_description }}</textarea>
                                                                @error('long_description')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>SKU</label>
                                                            <input type="text" class="form-control" name="sku"
                                                                value="{{ $product->sku }}">
                                                            @error('sku')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Price &#40;$&#41;<span class="text text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="price"
                                                                value="{{ $product->price }}">
                                                            @error('price')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Offer Price &#40;$&#41;<span class="text text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="offer_price"
                                                                value="{{ $product->offer_price }}">
                                                            @error('offer_price')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label> Quantity<span class="text text-danger">*</span></label>
                                                            <input type="number" min="0" class="form-control"
                                                                name="qty" value="{{ $product->qty }}">
                                                            @error('qty')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        {{-- <div class="form-group col-md-12">
                                                            <label>Highlight</label>
                                                            <div>
                                                                <input type="checkbox" name="is_top" id="top_product"
                                                                    value="1"{{ $product->is_top ? 'checked' : '' }}>
                                                                <label for="top_product" class="mr-3">Top
                                                                    Product</label>

                                                                <input type="checkbox" name="new_product"
                                                                    id="new_product"
                                                                    value="1"{{ $product->new_product ? 'checked' : '' }}>
                                                                <label for="new_product" class="mr-3">New
                                                                    Arrival</label>

                                                                <input type="checkbox" name="is_best" id="is_best"
                                                                    value="1"
                                                                    {{ $product->is_best ? 'checked' : '' }}> <label
                                                                    for="is_best" class="mr-3">Best Product</label>

                                                                <input type="checkbox" name="is_featured"
                                                                    id="is_featured" value="1"
                                                                    {{ $product->is_featured ? 'checked' : '' }}> <label
                                                                    for="is_featured" class="mr-3">Featured
                                                                    Product</label>
                                                            </div>
                                                        </div> --}}

                                                        {{-- <div class="form-group col-md-12">
                                                            <label>Specification</label>
                                                            <div>
                                                                <input type="checkbox" name="top_product" id="is_specification"> <label for="is_specification" class="mr-3"></label>
                        
                                                               
                                                            </div>
                                                        </div> --}}

                                                        <div class="col-md-12">
                                                            <label for="status"
                                                                class="col-form-label">Status<span class="text text-danger">*</span></label>
                                                            <select id="inputState" class="form-control" name="status"
                                                                value="{{ old('status') }}" required>
                                                                <option>select option</option>
                                                                <option value="1"
                                                                    {{ $product->status == 1 ? 'selected' : '' }}>Active
                                                                </option>
                                                                <option value="0"
                                                                    {{ $product->status == 0 ? 'selected' : '' }}>Inactive
                                                                </option>
                                                            </select>

                                                            @error('status')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div id="meta-fields-container">
                                                        @foreach ($productSpecifications as $specification)
                                                            <div class="form-group row meta-fields">
                                                                <div class="col-sm-4 mb-4">
                                                                    <label class="col-form-label">Key</label>
                                                                    <select class="form-control select2"
                                                                        name="product_specification_key_id[]">
                                                                        <option value="">Select Key</option>
                                                                        @foreach ($productspecificationkey as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $item->id == $specification->product_specification_key_id ? 'selected' : '' }}>
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('product_specification_key_id')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-4 mb-4">
                                                                    <label class="col-form-label">Specification</label>
                                                                    <input type="text" class="form-control"
                                                                        name="specification[]"
                                                                        value="{{ $specification->specification }}">
                                                                    @error('specification')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-1 mb-4 d-flex align-items-end">
                                                                    <button type="button"
                                                                        class="btn btn-primary add-meta-fields">+</button>
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-meta-fields">-</button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>


                                                    <div id="meta-fields">
                                                        @foreach ($productmeta as $meta)
                                                            <div class="form-group row meta-fields">

                                                                <div class="col-sm-2 mb-2">
                                                                    <label class="col-form-label">Meta Type</label>
                                                                    <select class="form-control select2"
                                                                        name="meta_types_id[]" id="meta_type">
                                                                        <option value="">Select meta type</option>
                                                                        @foreach ($meta_type as $type)
                                                                            <option value="{{ $type->id }}"
                                                                                {{ $type->id == $meta->metaKey->metaType->id ? 'selected' : '' }}>
                                                                                {{ $type->name }}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4 mb-4">
                                                                    <label class="col-form-label">Metakey</label>
                                                                    <select class="form-control select2"
                                                                        name="meta_keys_id[]" id="meta_keys_id">
                                                                        <option value="">Select metakey</option>
                                                                        @foreach ($meta_key as $item)
                                                                            <option
                                                                                value="{{ $item->id }}"{{ $item->id == $meta->meta_keys_id ? 'selected' : '' }}>
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('meta_keys_id')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-4 mb-4">
                                                                    <label class="col-form-label">Content</label>
                                                                    <input type="text" class="form-control"
                                                                        name="content[]" value="{{ $meta->content }}">
                                                                    @error('content')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-1 mb-4 d-flex align-items-end">
                                                                    <button type="button"
                                                                        class="btn btn-primary add-meta-fields">+</button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">


                                                            <button type="submit"
                                                                class="btn btn_primary_color waves-effect waves-light">
                                                                Submit
                                                            </button>
                                                            <a href="{{ route('product.index') }}"
                                                                class="btn btn-secondary waves-effect m-l-5">
                                                                Cancel
                                                            </a>
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $('textarea#summernote').summernote({
            placeholder: 'Hello bootstrap 4',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                //['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                //['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    </script>

    {{-- for subcategory and childcategory --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_id').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/categories/' + categoryId + '/subcategories',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append(
                                '<option value="">Select SubCategory</option>');
                            $.each(data.subcategories, function(key, value) {
                                $('#subcategory_id').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="">Select SubCategory</option>');
                }
            });

            $('#subcategory_id').change(function() {
                var subcategoryId = $(this).val();
                if (subcategoryId) {
                    $.ajax({
                        url: '/subcategories/' + subcategoryId + '/childcategories',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#childcategory_id').empty();
                            $('#childcategory_id').append(
                                '<option value="">Select ChildCategory</option>');
                            $.each(data.childcategories, function(key, value) {
                                $('#childcategory_id').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#childcategory_id').empty();
                    $('#childcategory_id').append('<option value="">Select ChildCategory</option>');
                }
            });
        });
    </script>


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Hidden template for cloning
            var hiddenTemplate = `
                <div class="form-group row meta-fields-template" style="display: none;">
                    
                    <div class="col-sm-4 mb-4">
                        <label class="col-form-label">Key</label>
                        <select class="form-control select2" name="product_specification_key_id[]" id="meta_typeproduct_specification_key_id">
                            <option value="">Select Key</option>
                            @foreach ($productspecificationkey as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('product_specification_key_id')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-4">
                        <label class="col-form-label">Specification</label>
                        <input type="text" class="form-control" name="specification[]" value="">
                        @error('specification')
                            <span class="error" style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-1 mb-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary add-meta-fields">+</button>
                        <button type="button" class="btn btn-danger remove-meta-fields">-</button>
                    </div>
                </div>
            `;

            // Add meta fields
            $('#meta-fields-container').on('click', '.add-meta-fields', function() {
                var newMetaFields = $(hiddenTemplate).clone().removeClass('meta-fields-template').show();
                $('#meta-fields-container').append(newMetaFields);
                updateAddRemoveButtons();
            });

            // Remove meta fields
            $('#meta-fields-container').on('click', '.remove-meta-fields', function() {
                $(this).closest('.form-group').remove(); // Modified selector
                updateAddRemoveButtons();
            });

            // Update add and remove buttons visibility
            function updateAddRemoveButtons() {
                var metaFields = $('#meta-fields-container .meta-fields');
                metaFields.each(function(index) {
                    var addBtn = $(this).find('.add-meta-fields');
                    var removeBtn = $(this).find('.remove-meta-fields');
                    if (index === metaFields.length - 1) {
                        addBtn.show();
                    } else {
                        addBtn.hide();
                    }
                    if (metaFields.length > 1) {
                        removeBtn.show();
                    } else {
                        removeBtn.hide();
                    }
                });
            }

            updateAddRemoveButtons(); // Initialize buttons visibility
        });
    </script>


    <!--metakey-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Hidden template for cloning
            var hiddenTemplate = `
        <div class="form-group row meta-fields-template" style="display: none;">
            <div class="col-sm-2 mb-2">
                <label class="col-form-label">Meta Type</label>
                <select class="form-control select2 meta_type" name="meta_types_id[]">
                    <option value="">Select meta type</option>
                    @foreach ($meta_type as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 mb-4">
                <label class="col-form-label">Meta Key</label>
                <select class="form-control select2 meta_keys" name="meta_keys_id[]">
                    <option value="">Select Meta Key</option>
                </select>
            </div>
            <div class="col-sm-4 mb-4">
                <label class="col-form-label">Content</label>
                <input type="text" class="form-control" name="content[]" value="">
                @error('content')
                    <span class="error" style="color: red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-1 mb-4 d-flex align-items-end">
                <button type="button" class="btn btn-primary add-meta-fields">+</button>
                <button type="button" class="btn btn-danger remove-meta-fields">-</button>
            </div>
        </div>
    `;

            // Function to handle meta type change event
            function handleMetaTypeChange() {
                $(document).on('change', '.meta_type', function() {
                    var metaTypeId = $(this).val();
                    var $metaKeyDropdown = $(this).closest('.meta-fields').find('.meta_keys');

                    if (metaTypeId) {
                        $.ajax({
                            url: '/meta-keys/' + metaTypeId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $metaKeyDropdown.empty();
                                $metaKeyDropdown.append(
                                    '<option value="">Select Meta Key</option>');
                                $.each(data, function(key, value) {
                                    $metaKeyDropdown.append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
                                });
                            }
                        });
                    } else {
                        $metaKeyDropdown.empty();
                        $metaKeyDropdown.append('<option value="">Select Meta Key</option>');
                    }
                });
            }

            // Add meta fields
            $('#meta-fields').on('click', '.add-meta-fields', function() {
                var newMetaFields = $(hiddenTemplate).clone().removeClass('meta-fields-template').addClass(
                    'meta-fields').show();
                $('#meta-fields').append(newMetaFields);
                updateAddRemoveButtons();
            });

            // Remove meta fields
            $('#meta-fields').on('click', '.remove-meta-fields', function() {
                $(this).closest('.form-group').remove();
                updateAddRemoveButtons();
            });

            // Update add and remove buttons visibility
            function updateAddRemoveButtons() {
                var metaFields = $('#meta-fields .meta-fields');
                metaFields.each(function(index) {
                    var addBtn = $(this).find('.add-meta-fields');
                    var removeBtn = $(this).find('.remove-meta-fields');
                    if (index === metaFields.length - 1) {
                        addBtn.show();
                    } else {
                        addBtn.hide();
                    }
                    if (metaFields.length > 1) {
                        removeBtn.show();
                    } else {
                        removeBtn.hide();
                    }
                });
            }

            handleMetaTypeChange(); // Initialize the change event handler
            updateAddRemoveButtons(); // Initialize buttons visibility
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle the change event on meta_type dropdown
            $('#meta_type').on('change', function() {
                var metaTypeId = $(this).val();

                if (metaTypeId) {
                    $.ajax({
                        url: '/meta-keys/' + metaTypeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Empty the meta key dropdown
                            $('#metakey').empty();
                            $('#metakey').append('<option value="">Select Meta Key</option>');

                            // Populate the meta key dropdown with the fetched data
                            $.each(data, function(key, value) {
                                $('#metakey').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    // If no meta type is selected, reset the meta key dropdown
                    $('#metakey').empty();
                    $('#metakey').append('<option value="">Select Meta Key</option>');
                }
            });
        });
    </script>

@endsection
