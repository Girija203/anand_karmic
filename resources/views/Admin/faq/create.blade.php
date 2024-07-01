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
                                    <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">Faq</a></li>
                                    <li class="breadcrumb-item active">Create</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Faq</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Faq</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="card-body">
                                            <div class="m-b-30">
                                                <form action="{{ route('faq.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="col-md-12">
                                                        <label for="name">Question <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="questions"
                                                            id="title" value="">
                                                        @error('questions')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="name">Answer <span
                                                                class="text-danger">*</span></label>
                                                        <div class="">
                                                            <textarea id="summernote" name="answers" value=""></textarea>
                                                            @error('answers')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="status" class=" col-form-label">Status<span
                                                                class="text-danger">*</span></label>
                                                        <select id="inputState" class="form-control" name="status"
                                                            value="">
                                                            <option>select option</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>

                                                        @error('status')
                                                            <span class="error" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px !important">
                                                <div class="form-group">
                                                    <div class="d-flex justify-content-evenly">
                                                        <button type="submit"
                                                            class="btn btn_primary_color waves-effect waves-light">
                                                            Submit
                                                        </button>
                                                        <a href="{{ route('faq.index') }}"
                                                            class="btn btn-secondary waves-effect m-l-5">
                                                            Cancel
                                                        </a>
                                                    </div>
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $('textarea#summernote').summernote({
            placeholder: 'Hello bootstrap 4',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                //['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                //['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    </script>
@endsection
