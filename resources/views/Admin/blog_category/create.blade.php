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

                                    <li class="breadcrumb-item"><a href="{{ route('blog_categories.index') }}">Blog
                                            Category</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Blog Category Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Blog Category Create</h4>

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
                                                    action="{{ route('blog_categories.store') }}">
                                                    @csrf
                                                    <div class="form-group row">

                                                        <label class="col-sm-2 col-form-label">Parent ID

                                                        </label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="parent_id"
                                                                id="parent">
                                                                <option value="">Select Parent id</option>
                                                                @foreach ($categories as $parentCategory)
                                                                    <option value="{{ $parentCategory->id }}">
                                                                        {{ $parentCategory->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('parent_id')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="wages_product"
                                                            class="col-sm-2 col-form-label mandatory">Name</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="name"
                                                                id="name">
                                                            @error('name')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <!-- <label class="col-sm-2 col-form-label">Status
                                            
                                            </label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="form-control select2" name="status">
                                                    <option value="">Select Status</option>
                                                   <option value="1">Active</option>
                                                   <option value="0">Inactive</option>
                                                </select>
                                                @error('status')
        <span class="error" style="color: red;">{{ $message }}</span>
    @enderror
                                            </div> -->




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
@endsection
