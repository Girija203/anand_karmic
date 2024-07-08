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
                                    <li class="breadcrumb-item"><a href="{{ route('about_sections.index') }}">About
                                            Section</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">About Section Create</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">About Section Create</h4>

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
                                                <form class="row g-3" method="POST" action="{{ route('about_sections.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label mandatory">Title</label>
        <div class="col-sm-4 mb-4">
            <input class="form-control" type="text" name="title" id="title">
            @error('title')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <label for="content" class="col-sm-2 col-form-label mandatory">Content</label>
        <div class="col-sm-4 mb-4">
            <input class="form-control" type="text" name="content" id="content">
            @error('content')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <label for="is_left" class="col-sm-2 col-form-label mandatory">Position</label>
        <div class="col-sm-4 mb-4">
            <select class="form-control" name="is_left" id="is_left">
                <option value="">Select position</option>
                <option value="1">Left</option>
                <option value="0">Right</option>
            </select>
            @error('is_left')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <label for="image" class="col-sm-2 col-form-label mandatory">Image <span style="color: red">(only 4)</span></label>
        <div class="col-sm-4 mb-4">
            <input class="form-control" type="file" name="image[]" id="image" multiple>
            @error('image')
                <span class="error" style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="d-flex justify-content-evenly">
            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
            <a href="{{ route('about_sections.index') }}" class="btn btn-secondary waves-effect m-l-5">Cancel</a>
        </div>
    </div>
</form>                                            </div>
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
