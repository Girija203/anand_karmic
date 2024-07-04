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
                                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Category Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-1 pt-2">
                                <a href="{{ route('category.index') }}" title="Category List">
                                    <button class="header-title btn btn-gery">Category List</button>
                                </a>
                                <a href="#" title="Category Edit">
                                    <button class="header-title btn  btn_primary_color">Edit
                                        Category</button>
                                </a>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            {{-- <div>

                                            </div>
                                            <div>

                                            </div> --}}
                                        </div>
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <form class="row g-3" method="POST"
                                                    action="{{ route('category.update', $category->id) }}">
                                                    @method('PUT')
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="name" class=" col-form-label">Name<span class="text text-danger">*</span>
                                                            </label>
                                                            <div class="">
                                                                <input class="form-control" type="text" name="name"
                                                                    id="name" value="{{ $category->name }}">
                                                                @error('name')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="status"
                                                                class=" col-form-label">Status<span class="text text-danger">*</span></label>
                                                            <select id="inputState" class="form-control" name="status"
                                                                required>
                                                                <option>select option</option>
                                                                <option value="1"
                                                                    {{ $category->status == 1 ? 'selected' : '' }}>Active
                                                                </option>
                                                                <option value="0"
                                                                    {{ $category->status == 0 ? 'selected' : '' }}>Inactive
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
                                                                class="btn btn_primary_color waves-effect waves-light">
                                                                Submit
                                                            </button>
                                                            <a href="{{ route('category.index') }}"
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
