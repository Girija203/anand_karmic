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
                                    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Permission Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Permission Edit</h4>
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
                                                    action="{{ route('permissions.update', ['id' => $permissionGroup->id]) }}">
                                                    @csrf
                                                    <div class="form-group row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="name"
                                                                        class="form-label mandatory">Permission
                                                                        Group</label>
                                                                    <input type="text" class="form-control"
                                                                        name="permission_group_id"
                                                                        value="{{ $permissionGroup->name }}" readonly>
                                                                    @error('name')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label mandatory">Permissions</label><br>
                                                                @foreach ($allPermissions as $perm)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="permissions[]" value="{{ $perm->id }}"
                                                                            {{ $permissionGroup->permissions->contains($perm->id) ? 'checked' : '' }}>
                                                                        <label
                                                                            class="form-check-label">{{ $perm->name }}</label>
                                                                    </div>
                                                                @endforeach
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
                                                <hr>
                                                <br>
                                                <form class="row g-3" method="POST"
                                                    action="{{ route('permissions.storepermission', ['id' => $permissionGroup->id]) }}">
                                                    @csrf
                                                    <div class="form-group row justify-content-center">
                                                        <div class="col-md-6">
                                                            @php
                                                                use App\Models\PermissionGroup;
                                                                use Spatie\Permission\Models\Permission;

                                                                // Retrieve the permission group with ID 1
                                                                $permissionGroup = PermissionGroup::find(1);

                                                                // Retrieve all permissions associated with the permission group ID 1
                                                                $allPermissions = Permission::where(
                                                                    'permission_group_id',
                                                                    1,
                                                                )->get();
                                                            @endphp

                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="name"
                                                                        class="form-label mandatory">Individual</label>
                                                                    <input type="text" class="form-control"
                                                                        name="permission_group_id"
                                                                        value="{{ $permissionGroup->name }}" readonly>
                                                                    @error('name')
                                                                        <span class="error"
                                                                            style="color: red;">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label mandatory">Permissions</label><br>
                                                                @if ($allPermissions->isEmpty())
                                                                    <p>No permissions available.</p>
                                                                @else
                                                                    @foreach ($allPermissions as $perm)
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="permissions[]"
                                                                                value="{{ $perm->name }}">
                                                                            <label
                                                                                class="form-check-label">{{ $perm->name }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>

                                                            <div class="d-flex justify-content-between">
                                                                <div class="">
                                                                    <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        Add
                                                                    </button>

                                                                </div>
                                                                <div>
                                                                    <a href="{{ route('permissions.index') }}"
                                                                        class="btn btn-secondary waves-effect m-l-5 ">
                                                                        Close
                                                                    </a>

                                                                </div>
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
