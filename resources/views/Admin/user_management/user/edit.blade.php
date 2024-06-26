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
                                    <li class="breadcrumb-item">User Management</li>
                                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">User Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-0">
                                <a href="{{ route('users.index') }}" title="User List">
                                    <button class="header-title btn btn-gery">User List</button>
                                </a>
                                <a href="{{ route('users.create') }}" title="User Create">
                                    <button class="header-title btn btn-gery"> <i class="mdi mdi-plus-box  pe-1"></i>Create
                                        User</button>
                                </a>
                                <a href="#" title="Create New role">
                                    <button class="header-title btn btn_primary_color">Edit List</button>
                                </a>
                                <a href="" title="user Delete">
                                    <button class="header-title btn btn-gery"> <i class="mdi mdi-plus-box  pe-1"></i>Delete
                                        User</button>
                                </a>
                            </div>
                            <hr class="mt-1 mb-0" />
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        {{-- <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>

                                            </div>
                                            <div>

                                            </div>
                                        </div> --}}
                                        <div class="card-body mt-3">
                                            <div class="m-b-30">
                                                <form class="row g-3" method="POST"
                                                    action="{{ route('users.update', $user->id) }}">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="name" class="col-form-label mandatory">Name</label>
                                                            <div class="">
                                                                <input class="form-control" type="text" name="name"
                                                                    id="name" value="{{ $user->name }}">
                                                                @error('name')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">

                                                            <label for="email" class="col-form-label mandatory">Email</label>
                                                            <div class="">
                                                                <input class="form-control" type="email" name="email"
                                                                    id="email" value="{{ $user->email }}">
                                                                @error('email')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-2 mt-2">
                                                        <div class="col-md-6">
                                                            <label for="password" class="col-form-label mandatory">Password</label>
                                                            <div class="">
                                                                <input type="password" id="password" class="form-control"
                                                                    name="password" placeholder="Password" />
                                                                @error('password')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label for="password_confirmation"
                                                                class="col-form-label mandatory">Confirm
                                                                Password</label>
                                                            <div class="">
                                                                <input type="password" name="password_confirmation"
                                                                    class="form-control" placeholder="Re-Type Password" />
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label mandatory">Select</label>
                                                            <div class="">
                                                                <select class="form-control" name="role">
                                                                    <option value="">Select</option>
                                                                    @foreach ($roles as $item)
                                                                        <option value="{{ $item->name }}"
                                                                            @if ($userRole && $userRole->name === $item->name) selected @endif>
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('role')
                                                                    <span class="error"
                                                                        style="color: red;">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-evenly">


                                                            <button type="submit"
                                                                class="btn btn_primary_color waves-effect waves-light">
                                                                Submit
                                                            </button>
                                                            <a href="{{ route('users.index') }}"
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
