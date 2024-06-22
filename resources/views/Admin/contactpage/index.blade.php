<!-- resources/views/contact/index.blade.php -->

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
                                    <li class="breadcrumb-item"><a href="#">Contact Page</a></li>
                                    <li class="breadcrumb-item active">Update</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Contact Page Update</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Contact Page </h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <form action="{{ route('contactpage.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group col-12">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ $contact->email ?? '' }}">
                                                        @error('email')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label>Phone <span class="text-danger">*</span></label>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ $contact->phone ?? '' }}">
                                                        @error('phone')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label>Address <span class="text-danger">*</span></label>
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ $contact->address ?? '' }}">
                                                        @error('address')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label>Title <span class="text-danger">*</span></label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $contact->title ?? '' }}">
                                                        @error('title')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label>Description <span class="text-danger">*</span></label>
                                                        <textarea name="description" cols="30" rows="10" class="form-control text-area-5">{{ $contact->description ?? '' }}</textarea>
                                                        @error('description')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <label>Google Map <span class="text-danger">*</span></label>
                                                        <textarea name="map" cols="30" rows="10" class="form-control text-area-5">{{ $contact->map ?? '' }}</textarea>
                                                        @error('map')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
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
    </div>
@endsection
