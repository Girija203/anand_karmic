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

                                    <li class="breadcrumb-item"><a href="{{ route('blog_posts.index') }}">Blog Post</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Blog Post Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Blog Post Create</h4>

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
                                                    action="{{ route('blog_posts.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">


                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Title</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="title"
                                                                id="">
                                                            @error('title')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Content</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="content"
                                                                id="">
                                                            @error('content')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Excerpt</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="excerpt"
                                                                id="">
                                                            @error('excerpt')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Blog Category</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="blog_category_id"
                                                                id="parent">
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $parentCategory)
                                                                    <option value="{{ $parentCategory->id }}">
                                                                        {{ $parentCategory->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('blog_category_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Blog Tag</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="blog_tag_id"
                                                                id="">
                                                            @error('blog_tag_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Draft</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="is_draft">
                                                                <option value="">Select Draft</option>
                                                                <option value="1">Yes</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                            @error('is_draft')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Featured Image</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="file" class="form-control" name="featured_image"
                                                                id="">
                                                            @error('featured_image')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row" id="meta-fields-container">
                                                            <div class="col-sm-4 mb-4">
                                                                <label class="col-form-label">Meta Type</label>
                                                                <select class="form-control select2" name="meta_types_id[]"
                                                                    id="meta_type">
                                                                    <option value="">Select meta type</option>
                                                                    @foreach ($meta_type as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('meta_types_id')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-sm-4 mb-4">
                                                                <label class="col-form-label">Meta Key</label>
                                                                <select class="form-control select2" name="meta_keys_id[]"
                                                                    id="meta_key">
                                                                    <option value="">Select meta key</option>
                                                                </select>
                                                                @error('meta_keys_id')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-sm-3 mb-4">
                                                                <label for="meta_content"
                                                                    class="col-form-label mandatory">Meta Content</label>
                                                                <input class="form-control" type="text"
                                                                    name="meta_content[]" id="">
                                                                @error('meta_content')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-sm-1 mb-4 d-flex align-items-end">
                                                                <button type="button"
                                                                    class="btn btn-primary add-meta-fields">+</button>

                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="d-flex justify-content-evenly">
                                                                <button type="submit"
                                                                    class="btn btn-primary waves-effect waves-light">
                                                                    Submit
                                                                </button>

                                                                <a href="{{ route('blog_categories.index') }}"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#meta_type').on('change', function() {
                var metaTypeId = $(this).val();
                if (metaTypeId) {
                    $.ajax({
                        url: '/meta-keys/' + metaTypeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#meta_key').empty();
                            $('#meta_key').append('<option value="">Select meta key</option>');
                            $.each(data, function(key, value) {
                                $('#meta_key').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#meta_key').empty();
                    $('#meta_key').append('<option value="">Select meta key</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.add-meta-fields', function() {
                var newFields = `
            <div class="form-group row">
                <div class="col-sm-4 mb-4">
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
                    <select class="form-control select2 meta_key" name="meta_keys_id[]">
                        <option value="">Select meta key</option>
                    </select>
                </div>
                <div class="col-sm-3 mb-4">
                    <label for="meta_content" class="col-form-label mandatory">Meta Content</label>
                    <input class="form-control" type="text" name="meta_content[]">
                </div>
                <div class="col-sm-1 mb-4 d-flex align-items-end">
                    <button type="button" class="btn btn-primary add-meta-fields">+</button>
                    <button type="button" class="btn btn-danger remove-meta-fields">-</button>
                </div>
            </div>
        `;
                $('#meta-fields-container').append(newFields);

                // Reinitialize select2 for the new elements
                $('.select2').select2();
            });

            $(document).on('click', '.remove-meta-fields', function() {
                $(this).closest('.form-group').remove();
            });

            $(document).on('change', '.meta_type', function() {
                var metaTypeId = $(this).val();
                var $metaKeySelect = $(this).closest('.form-group').find('.meta_key');
                if (metaTypeId) {
                    $.ajax({
                        url: '/meta-keys/' + metaTypeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $metaKeySelect.empty();
                            $metaKeySelect.append('<option value="">Select meta key</option>');
                            $.each(data, function(key, value) {
                                $metaKeySelect.append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $metaKeySelect.empty();
                    $metaKeySelect.append('<option value="">Select meta key</option>');
                }
            });
        });
    </script>
@endsection
