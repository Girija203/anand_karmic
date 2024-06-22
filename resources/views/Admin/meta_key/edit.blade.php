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

                                    <li class="breadcrumb-item"><a href="{{ route('meta_keys.index') }}">Meta Key</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Meta Key Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Meta Key Edit</h4>
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
                                                    action="{{ route('meta_keys.update', $meta_key->id) }}">
                                                    @csrf
                                                    <div class="form-group row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label mandatory">Meta
                                                                        Type</label>
                                                                    <select class="form-control" name="meta_types_id">
                                                                        @foreach ($meta_type as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $meta_key->meta_types_id == $item->id ? 'selected' : '' }}>
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('meta_types_id')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label mandatory">Name</label>
                                                                <input type="text"class="form-control" name="name"
                                                                    id="" value="{{ $meta_key->name }}">

                                                            </div>
                                                            <div class="col-12">
                                                                <button type="submit"
                                                                    class="btn btn-primary waves-effect waves-light">
                                                                    Update
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row-->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
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
