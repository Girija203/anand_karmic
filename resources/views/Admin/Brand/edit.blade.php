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
                                    <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Brands</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Brand Edit</h4>
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
                                            href="{{ route('brand.index') }}">Brands List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-0 pt-2 pb-2" href="#">Edit
                                            Brand</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body mt-4">
                                            <div class="m-b-30">
                                                <form class="row g-3" method="POST"
                                                    action="{{ route('brand.update', $brand->id) }}"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <label for="name" class="col-form-label mandatory">Name
                                                            </label>
                                                            <div class="">
                                                                <input class="form-control" type="text"
                                                                    value="{{ $brand->name }}" name="name"
                                                                    id="name" required>
                                                                @error('name')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <label for="slug" class="col-form-label mandatory">Slug
                                                            </label>
                                                            <div class="">
                                                                <input class="form-control" type="text"
                                                                    value="{{ $brand->slug }}" name="slug"
                                                                    id="slug" required>
                                                                @error('slug')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <label for="logo" class="col-form-label">Logo</label>
                                                            <div>
                                                                @if (isset($brand->logo))
                                                                    <img src="{{ url('storage/' . $brand->logo) }}"
                                                                        alt="Brand Logo"
                                                                        style="max-width: 100px; max-height: 100px;">
                                                                @endif
                                                            </div>
                                                            <input class="form-control" type="file" name="logo"
                                                                id="logo">
                                                            @error('logo')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <label for="status" class="col-form-label">Status</label>
                                                            <select id="inputState" class="form-control" name="status">
                                                                <option
                                                                    value="1"{{ $brand->status == 1 ? 'selected' : '' }}>
                                                                    Active</option>
                                                                <option
                                                                    value="0"{{ $brand->status == 0 ? 'selected' : '' }}>
                                                                    Inactive</option>
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
                                                                class="btn btn-primary waves-effect waves-light">
                                                                Save
                                                            </button>
                                                            <a href="{{ route('brand.index') }}"
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
