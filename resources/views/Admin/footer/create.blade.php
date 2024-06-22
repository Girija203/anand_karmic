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
                                    <li class="breadcrumb-item"><a href="{{ route('footers.index') }}">Footer</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Footer Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Footer Create</h4>

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
                                                <form class="row g-3" method="POST" action="{{ route('footers.store') }}">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">About us</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="about_us"
                                                                id="">
                                                            @error('about_us')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Phone</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="phone"
                                                                id="">
                                                            @error('phone')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Email</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="email"
                                                                id="">
                                                            @error('email')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Address</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="address"
                                                                id="">
                                                            @error('address')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">First Column</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="first_column"
                                                                id="">
                                                            @error('first_column')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Second Column</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="second_column"
                                                                id="">

                                                            @error('second_column')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Third Column</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="third_column"
                                                                id="">

                                                            @error('third_column')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Copyright</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="copyright"
                                                                id="">

                                                            @error('third_column')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                                            <a href="{{ route('footers.index') }}"
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
@endsection
