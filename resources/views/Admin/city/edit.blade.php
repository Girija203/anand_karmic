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
                                    <li class="breadcrumb-item"><a href="{{ route('cities.index') }}">Cities</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Cities Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Cities Edit</h4>

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
                                                    action="{{ route('cities.update', $city->id) }}">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Country</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="country_id">
                                                                <option value="">Select</option>
                                                                @foreach ($country as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $city->country_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('status')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <label class="col-sm-2 col-form-label">State</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="state_id">
                                                                <option value="">Select</option>
                                                                @foreach ($state as $item)
                                                                    <option
                                                                        value="{{ $item->id }}"{{ $city->state_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('status')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label for="name"
                                                            class="col-sm-2 col-form-label mandatory">Name</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <input class="form-control" type="text" name="name"
                                                                id="name" value="{{ $city->name }}">
                                                            @error('name')
                                                                <span class="error"
                                                                    style="color: red;">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <label class="col-sm-2 col-form-label">Status</label>
                                                        <div class="col-sm-4 mb-4">
                                                            <select class="form-control select2" name="status">
                                                                <option value="1"
                                                                    {{ $city->status == 1 ? 'selected' : '' }}>Active
                                                                </option>
                                                                <option value="0"
                                                                    {{ $city->status == 0 ? 'selected' : '' }}>Inactive
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
                                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                                            <a href="{{ route('cities.index') }}"
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
