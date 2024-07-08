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
                                    <li class="breadcrumb-item">Product Management</li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Product Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header m-0 p-0">
                                <a href="{{ route('product.index') }}" title="Product List">
                                    <button class="header-title btn btn-gery">Product List</button>
                                </a>
                                <a href="#" title="Create Product">
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
                                                <form class="row g-3" method="post" action="{{ route('product.store') }}"
                                                    enctype="multipart/form-data">
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
                                                            <label for="name" class=""> Product Name<span
                                                                    class="text text-danger">*</span> </label>
                                                            <div class="">
                                                                <input class="form-control" type="text" name="title"
                                                                    id="title" value="{{ old('title') }}">
                                                                @error('title')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="color_id">Color<span
                                                                    class="text text-danger">*</span></label>
                                                            <select id="color_id" class="form-control" name="color_id"
                                                                value="{{ old('color_id') }}">
                                                                <option value="">Select color</option>
                                                                @foreach ($color as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('color_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="main_image">Thumbnail image<span
                                                                    class="text text-danger">*</span></label>

                                                            <input class="form-control" type="file" name="main_image"
                                                                id="main_image" value="{{ old('image') }}">

                                                            @error('main_image')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="col-md-12">
                                                            <label for="multiple_images"> Select Multiple image<span
                                                                    class="text text-danger">*</span></label>

                                                            <input class="form-control" type="file"
                                                                name="multiple_images[]" id="multiple_images" multiple
                                                                value="{{ old('image') }}">

                                                            @error('multiple_images')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="col-md-12">
                                                            <label for="category_id">Category<span
                                                                    class="text text-danger">*</span></label>
                                                            <select id="category_id" class="form-control" name="category_id"
                                                                value="{{ old('category_id') }}">
                                                                <option value="">Select Category</option>
                                                                @foreach ($category as $categories)
                                                                    <option value="{{ $categories->id }}">
                                                                        {{ $categories->name }}</option>
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
                                                                name="subcategory_id" value="{{ old('subcategory_id') }}">
                                                                <option value="">Select SubCategory</option>
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
                                                            </select>
                                                            @error('childcategory_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="category_id">Brand<span
                                                                    class="text text-danger">*</span></label>

                                                            <select id="brand_id" class="form-control" name="brand_id"
                                                                value="{{ old('brand_id') }}">
                                                                <option value="">select Brand</option>
                                                                @foreach ($brand as $brands)
                                                                    <option value="{{ $brands->id }}">
                                                                        {{ $brands->name }}</option>
                                                                @endforeach

                                                            </select>

                                                            @error('brand_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="name">Short description<span
                                                                    class="text text-danger">*</span> </label>
                                                            <div class="">
                                                                <textarea class="form-control" rows="3" name="short_description" value="{{ old('short_description') }}"></textarea>
                                                                @error('short_description')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="name">Long description<span
                                                                    class="text text-danger">*</span> </label>
                                                            <div class="">
                                                                <textarea id="summernote" name="long_description" value="{{ old('long_description') }}"></textarea>
                                                                @error('long_description')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>SKU</label>
                                                            <input type="text" class="form-control" name="sku"
                                                                value="{{ old('sku') }}">
                                                            @error('sku')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Price &#40;₹&#41;<span
                                                                    class="text text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="price"
                                                                value="{{ old('price') }}">
                                                            @error('price')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>Offer Price &#40;₹&#41;<span
                                                                    class="text text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="offer_price"
                                                                value="{{ old('offer_price') }}">
                                                            @error('offer_price')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label> Quantity<span class="text text-danger">*</span></label>
                                                            <input type="number" min="0" class="form-control"
                                                                name="qty" value="{{ old('qty') }}">
                                                            @error('qty')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        {{-- <div class="form-group col-md-12">
                                                            <label>Specification</label>
                                                            <div>
                                                                <input type="checkbox" name="top_product" id="is_specification"> <label for="is_specification" class="mr-3"></label>
                        
                                                               
                                                            </div>
                                                        </div> --}}

                                                        <div class="col-md-12">
                                                            <label for="status" class=" col-form-label">Status<span
                                                                    class="text text-danger">*</span></label>
                                                            <select id="inputState" class="form-control" name="status">
                                                                <option value="">select option</option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>

                                                            @error('status')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div id="meta-fields-container">
                                                        <div class="form-group row meta-fields">
                                                            <div class="col-sm-4 mb-4">
                                                                <label class="col-form-label">Key</label>
                                                                <select class="form-control select2"
                                                                    name="product_specification_key_id[]"
                                                                    id="meta_typeproduct_specification_key_id">
                                                                    <option value="">Select Key</option>
                                                                    @foreach ($productspecificationkey as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->name }}</option>
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
                                                                    name="specification[]" value="">
                                                                @error('specification')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-sm-1 mb-4 d-flex align-items-end">
                                                                <button type="button"
                                                                    class="btn btn-primary add-meta-fields">+</button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div id="meta-fields">
                                                        <div class="form-group row meta-fields">
                                                            <div class="col-sm-2 mb-2">
                                                                <label class="col-form-label">Meta Type</label>
                                                                <select class="form-control select2"
                                                                    name="meta_types_id[]" id="meta_type">
                                                                    <option value="">Select meta type</option>
                                                                    @foreach ($meta_type as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4 mb-4">
                                                                <label class="col-form-label">Meta Key</label>
                                                                <select class="form-control select2 meta_keys"
                                                                    id="metakey" name="meta_keys_id[]">
                                                                    <option value="">Select Meta Key</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4 mb-4">
                                                                <label class="col-form-label">Content</label>
                                                                <input type="text" class="form-control"
                                                                    name="content[]" value="">
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






    <!-- Include jQuery -->
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



    <!-- Include jQuery -->
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
