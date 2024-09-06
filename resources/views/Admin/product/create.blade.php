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
                            <h4 class="page-title">Product Create</h4>
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
                                        <a class="nav-link active rounded-0 pt-2 pb-2" href="#">Create
                                            Product</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body p-0 pt-4 justify-content-center">
                                            <form class="row" method="post" action="{{ route('product.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="border rounded-1 p-2">
                                                            <div class="col-md-12">
                                                                <label for="name" class="col-form-label mandatory">
                                                                    Product Name</label>
                                                                <input class="form-control" type="text" name="title"
                                                                    id="title" value="{{ old('title') }}">
                                                                @error('title')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="name" class="col-form-label mandatory">Short
                                                                    description </label>
                                                                <div class="">
                                                                    <textarea class="form-control" rows="3" name="short_description" id="short_description"
                                                                        value="{{ old('short_description') }}"></textarea>
                                                                    @error('short_description')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="name" class="col-form-label">Long
                                                                    description</label>
                                                                <div class="">
                                                                    <textarea id="summernote" name="long_description" value="{{ old('long_description') }}"></textarea>
                                                                    @error('long_description')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mt-4">
                                                                <hr class="hr-text" data-content="PRODUCT VARIENT">
                                                                <div class="col-md-6">
                                                                    <label for="color_id"
                                                                        class="col-form-label">Color</label>
                                                                    <select id="color_id" class="form-control"
                                                                        name="color_id" value="{{ old('color_id') }}">
                                                                        @foreach ($color as $item)
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('color_id')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror

                                                                    <label for="main_image" class="col-form-label">Thumbnail
                                                                        Image</label>

                                                                    <input class="form-control" type="file"
                                                                        name="main_image" id="main_image"
                                                                        value="{{ old('image') }}">

                                                                    @error('main_image')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror

                                                                    <label for="multiple_images" class="col-form-label">
                                                                        Select Multiple
                                                                        Image</label>

                                                                    <input class="form-control" type="file" name="multiple_images[]" id="multiple_images" multiple>


                                                                    @error('multiple_images')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5> Image Preview</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            Thumbnail
                                                                            <img id="thumbnail" src="#"
                                                                                alt="Image Preview"
                                                                                style="display: none; width: 100px; height: auto;">
                                                                        </div>
                                                                        <div class="col-md-8" id="image-preview">
                                                                            Multiple
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="price"
                                                                        class="col-form-label mandatory">Price (₹)</label>
                                                                    <input type="text" class="form-control"
                                                                        name="price" id="price"
                                                                        value="{{ old('price') }}">
                                                                    @error('price')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="offer_price" class="col-form-label">Offer
                                                                        Price (₹)</label>
                                                                    <input type="text" class="form-control"
                                                                        name="offer_price"
                                                                        value="{{ old('offer_price') }}">
                                                                    @error('offer_price')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="sku"
                                                                        class="col-form-label">SKU</label>
                                                                    <input type="text" class="form-control"
                                                                        name="sku" value="{{ old('sku') }}">
                                                                    @error('sku')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="col-form-label"> Quantity</label>
                                                                    <input type="number" min="0"
                                                                        class="form-control" name="qty"
                                                                        value="{{ old('qty') }}">
                                                                    @error('qty')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <hr class="hr-text" data-content="ADVANCE SETTINGS">
                                                                <div class="col-md-12">
                                                                    <ul class="nav nav-tabs" id="myTab"
                                                                        role="tablist">
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link active"
                                                                                id="specification-key-tab"
                                                                                data-bs-toggle="tab"
                                                                                data-bs-target="#specification-key"
                                                                                type="button" role="tab"
                                                                                aria-controls="specification-key"
                                                                                aria-selected="true">Specification
                                                                                Keys</button>
                                                                        </li>
                                                                        <li class="nav-item" role="presentation">
                                                                            <button class="nav-link" id="seo-tab"
                                                                                data-bs-toggle="tab" data-bs-target="#seo"
                                                                                type="button" role="tab"
                                                                                aria-controls="seo"
                                                                                aria-selected="false">SEO</button>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active"
                                                                    id="specification-key" role="tabpanel"
                                                                    aria-labelledby="specification-key-tab">
                                                                    <div id="meta-fields-container">
                                                                        <div class="form-group row meta-fields">
                                                                            <div class="col-sm-4 mb-4">
                                                                                <label class="col-form-label">Key</label>
                                                                                <select class="form-control select2"
                                                                                    name="product_specification_key_id[]"
                                                                                    id="meta_typeproduct_specification_key_id">
                                                                                    <option value="">Select Key
                                                                                    </option>
                                                                                    @foreach ($productspecificationkey as $item)
                                                                                        <option
                                                                                            value="{{ $item->id }}">
                                                                                            {{ $item->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('product_specification_key_id')
                                                                                    <span class="error"
                                                                                        style="color: red;">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-sm-4 mb-4">
                                                                                <label
                                                                                    class="col-form-label">Specification</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="specification[]" value="">
                                                                                @error('specification')
                                                                                    <span class="error"
                                                                                        style="color: red;">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-1 mb-4 d-flex align-items-end">
                                                                                <button type="button"
                                                                                    class="btn btn-primary add-meta-fields">+</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="seo" role="tabpanel"
                                                                    aria-labelledby="seo-tab">
                                                                    <div id="meta-fields">
                                                                        <div class="form-group row meta-fields">
                                                                            <div class="col-sm-2 mb-2">
                                                                                <label class="col-form-label">Meta
                                                                                    Type</label>
                                                                                <select class="form-control select2"
                                                                                    name="meta_types_id[]" id="meta_type">
                                                                                    <option value="">Select meta type
                                                                                    </option>
                                                                                    @foreach ($meta_type as $item)
                                                                                        <option
                                                                                            value="{{ $item->id }}">
                                                                                            {{ $item->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-4 mb-4">
                                                                                <label class="col-form-label">Meta
                                                                                    Key</label>
                                                                                <select
                                                                                    class="form-control select2 meta_keys"
                                                                                    id="metakey" name="meta_keys_id[]">
                                                                                    <option value="">Select Meta Key
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-4 mb-4">
                                                                                <label
                                                                                    class="col-form-label">Content</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="content[]" value="">
                                                                                @error('content')
                                                                                    <span class="error"
                                                                                        style="color: red;">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-1 mb-4 d-flex align-items-end">
                                                                                <button type="button"
                                                                                    class="btn btn-primary add-meta-fields">+</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>





                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="border rounded-1 p-2">

                                                            <div>
                                                                <h5> Required to Create Product</h5>

                                                                <ul>
                                                                    <li id="title-li">Product Name</li>
                                                                    <li id="short-description-li">Short Description</li>
                                                                    <li id="price-li">Price</li>
                                                                </ul>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="d-flex justify-content-evenly">
                                                                    <button type="submit"
                                                                        class="btn btn-light waves-effect waves-light"
                                                                        name="action" value="save_and_new">
                                                                        Save Draft
                                                                    </button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light"
                                                                        name="action" value="save">
                                                                        Publish
                                                                    </button>
                                                                    <a href="{{ route('product.index') }}"
                                                                        class="btn btn-secondary waves-effect m-l-5">
                                                                        Clear
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="category_id"
                                                                    class="col-form-label">Category</label>
                                                                <select id="category_id" class="form-control"
                                                                    name="category_id" value="{{ old('category_id') }}">
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
                                                                <label for="subcategory_id"
                                                                    class="col-form-label">SubCategory</label>
                                                                <select id="subcategory_id" class="form-control"
                                                                    name="subcategory_id"
                                                                    value="{{ old('subcategory_id') }}">
                                                                    <option value="">Select SubCategory</option>
                                                                </select>
                                                                @error('subcategory_id')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="childcategory_id"
                                                                    class="col-form-label">ChildCategory</label>
                                                                <select id="childcategory_id" class="form-control"
                                                                    name="childcategory_id"
                                                                    value="{{ old('childcategory_id') }}">
                                                                    <option value="">Select ChildCategory
                                                                    </option>
                                                                </select>
                                                                @error('childcategory_id')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="category_id">Brand</label>
                                                                <select id="brand_id" class="form-control"
                                                                    name="brand_id" value="{{ old('brand_id') }}">
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
                                                        </div>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $('textarea#summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 300,
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
        // Verification and Required
        document.addEventListener("DOMContentLoaded", function() {
            const titleInput = document.getElementById("title");
            const shortDescriptionInput = document.getElementById("short_description");
            const priceInput = document.getElementById("price");
            const saveDraftButton = document.querySelector("button[value='save_and_new']");
            const publishButton = document.querySelector("button[value='save']");

            const titleLi = document.getElementById("title-li");
            const shortDescriptionLi = document.getElementById("short-description-li");
            const priceLi = document.getElementById("price-li");

            function checkInputs() {
                const isTitleFilled = titleInput.value.trim() !== "";
                const isShortDescriptionFilled = shortDescriptionInput.value.trim() !== "";
                const isPriceFilled = priceInput.value.trim() !== "";

                if (isTitleFilled) {
                    titleLi.classList.add("checkmark");
                } else {
                    titleLi.classList.remove("checkmark");
                }

                if (isShortDescriptionFilled) {
                    shortDescriptionLi.classList.add("checkmark");
                } else {
                    shortDescriptionLi.classList.remove("checkmark");
                }

                if (isPriceFilled) {
                    priceLi.classList.add("checkmark");
                } else {
                    priceLi.classList.remove("checkmark");
                }

                if (isTitleFilled && isShortDescriptionFilled && isPriceFilled) {
                    saveDraftButton.disabled = false;
                    publishButton.disabled = false;
                } else {
                    saveDraftButton.disabled = true;
                    publishButton.disabled = true;
                }
            }

            titleInput.addEventListener("input", checkInputs);
            shortDescriptionInput.addEventListener("input", checkInputs);
            priceInput.addEventListener("input", checkInputs);

            checkInputs(); // Initial check on page load
        });


        document.getElementById('main_image').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById('thumbnail');
                imgElement.src = reader.result;
                imgElement.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        // document.getElementById('multiple_images').addEventListener('change', function() {
        //     var preview = document.getElementById('image-preview');
        //     preview.innerHTML = 'Multiple'; // Clear existing content except the title

        //     var files = Array.from(this.files);
        //     var dataTransfer = new DataTransfer(); // To manage files to be uploaded

        //     files.forEach((file, index) => {
        //         var reader = new FileReader();
        //         reader.onload = function(e) {
        //             var imgContainer = document.createElement('div');
        //             imgContainer.style.display = 'inline-block';
        //             imgContainer.style.position = 'relative';
        //             imgContainer.style.margin = '10px';

        //             var img = document.createElement('img');
        //             img.src = e.target.result;
        //             img.style.width = '100px'; // Adjust the size as needed

        //             var removeButton = document.createElement('button');
        //             removeButton.innerText = 'X';
        //             removeButton.style.position = 'absolute';
        //             removeButton.style.top = '-10px';
        //             removeButton.style.right = '-10px';
        //             removeButton.style.background = 'red';
        //             removeButton.style.color = 'white';
        //             removeButton.style.border = 'none';
        //             removeButton.style.cursor = 'pointer';
        //             removeButton.style.borderRadius = '50%';

        //             removeButton.addEventListener('click', function() {
        //                 imgContainer.remove();
        //                 files.splice(index, 1); // Remove the file from the array
        //                 updateInputFiles();
        //             });

        //             imgContainer.appendChild(img);
        //             imgContainer.appendChild(removeButton);
        //             preview.appendChild(imgContainer);

        //             dataTransfer.items.add(file); // Add file to DataTransfer
        //         }
        //         reader.readAsDataURL(file);
        //     });

        //     function updateInputFiles() {
        //         dataTransfer.items.clear(); // Clear the current files in DataTransfer
        //         files.forEach(file => dataTransfer.items.add(file)); // Re-add remaining files
        //         document.getElementById('multiple_images').files = dataTransfer.files; // Update the input element
        //     }

        //     updateInputFiles();
        // });

        
    document.addEventListener("DOMContentLoaded", function () {
        const imageInput = document.getElementById("multiple_images");
        const imagePreviewContainer = document.getElementById("image-preview");


        imageInput.addEventListener("change", function (event) {
            imagePreviewContainer.innerHTML = ""; // Clear previous previews

            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imagePreview = document.createElement("img");
                    imagePreview.src = e.target.result;
                    imagePreview.style.maxWidth = "100px"; // Adjust the image size as needed
                    imagePreviewContainer.appendChild(imagePreview);
                };

                reader.readAsDataURL(file);
            }
        });
    });

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
