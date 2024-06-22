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
                                    <li class="breadcrumb-item"><a href="{{ route('product_show_cases.index') }}">Product Show
                                            Case</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Product Show Case Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Product Show Case Edit</h4>

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
                                                    action="{{ route('product_show_cases.update', $ProductShowCase->id) }}">
                                                    @csrf
                                                    <div class="form-group row">

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Title</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="title"
                                                                id="title" value="{{ $ProductShowCase->title }}">
                                                            @error('title')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Description</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="description"
                                                                id="description"
                                                                value="{{ $ProductShowCase->description }}">
                                                            @error('description')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Status</label>
                                                        <div class="col-sm-4 mb-4">

                                                            <select class="form-control select2" name="status">
                                                                <option value="1"
                                                                    {{ $ProductShowCase->status == 1 ? 'selected' : '' }}>
                                                                    Active</option>
                                                                <option value="0"
                                                                    {{ $ProductShowCase->status == 0 ? 'selected' : '' }}>
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
                                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                                            <a href="{{ route('shippings.index') }}"
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
