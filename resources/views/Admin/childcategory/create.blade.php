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
                                    <li class="breadcrumb-item">Category Management</li>
                                    <li class="breadcrumb-item"><a href="{{ route('childcategory.index') }}">Child
                                            Category</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Child Category Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-1 pt-2">
                                <a href="{{ route('childcategory.index') }}" title="Child Category List">
                                    <button class="header-title btn btn-gery">ChildCategory List</button>
                                </a>
                                <a href="#" title="Child Category Create">
                                    <button class="header-title btn btn_primary_color"> <i
                                            class="mdi mdi-plus-box pe-1"></i>Create
                                        ChildCategory</button>
                                </a>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight"></div>
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <form class="row g-3" method="POST"
                                                    action="{{ route('childcategory.store') }}">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="category_id">Category<span class="text text-danger">*</span></label>
                                                            <select id="category_id" class="form-control" name="category_id"
                                                                required>
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

                                                        <div class="col-md-6">
                                                            <label for="subcategory_id">SubCategory<span class="text text-danger">*</span></label>
                                                            <select id="subcategory_id" class="form-control"
                                                                name="subcategory_id" required>
                                                                <option value="">Select SubCategory</option>
                                                            </select>
                                                            @error('status')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="name">Name<span class="text text-danger">*</span></label>
                                                            <div>
                                                                <input class="form-control" type="text" name="name"
                                                                    id="name" >
                                                                @error('name')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="status" class="">Status<span class="text text-danger">*</span></label>
                                                            <select id="inputState" class="form-control" name="status"
                                                               >
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

                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">
                                                            <button type="submit"
                                                                class="btn btn_primary_color waves-effect waves-light">Submit</button>
                                                            <a href="{{ route('subcategory.index') }}"
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_id').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/subcategories/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append(
                                '<option value="">Select SubCategory</option>');
                            $.each(data, function(key, value) {
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
        });
    </script>
@endsection
