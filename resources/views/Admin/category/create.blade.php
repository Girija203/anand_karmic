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
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Category Create</h4>
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
                                            href="{{ route('category.index') }}">Category List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-0 pt-2 pb-2" href="#">Create
                                            Category</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body mt-4">
                                            <div class="m-b-30">
                                                <form class="row g-3" method="POST" action="{{ route('category.store') }}">
                                                    @csrf
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <label for="name" class="col-form-label mandatory">Name
                                                            </label>
                                                            <div class="">
                                                                <input class="form-control" type="text" name="name"
                                                                    id="name">
                                                                @error('name')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <label for="status"
                                                                class="col-form-label mandatory">Status</label>
                                                            <select id="inputState" class="form-control" name="status">
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
                                                                class="btn btn-primary waves-effect waves-light"
                                                                name="action" value="save">
                                                                Save
                                                            </button>
                                                            <button type="submit"
                                                                class="btn btn-light waves-effect waves-light"
                                                                name="action" value="save_and_new">
                                                                Save and New
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
