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
                                    <li class="breadcrumb-item"><a href="{{ route('footer_links.index') }}">First Column
                                            Link</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">First Column Link Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">First Column Link Edit</h4>

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
                                                    action="{{ route('footer_links.update', $firstColumn->id) }}">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Title</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="title"
                                                                id="" value="{{ $firstColumn->title }}">
                                                            @error('title')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Link</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input type="text" class="form-control" name="link"
                                                                id="" value="{{ $firstColumn->link }}">
                                                            @error('link')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                                            <a href="{{ route('footer_links.index') }}"
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
