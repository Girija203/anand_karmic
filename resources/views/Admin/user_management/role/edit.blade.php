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
                                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Role Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Roles Edit</h4>

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
                                                    action="{{ route('roles.update', $role->id) }}">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <label for="inputFirstName" class="form-label">Role Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $role->name }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        {{-- <hr /> --}}
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <table class="table table-bordered mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Module</th>
                                                                            <th scope="col">Permission</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($permissionGroups as $permissionGroup)
                                                                            <tr>
                                                                                <td>{{ $permissionGroup->name }}</td>
                                                                                <td>
                                                                                    @if ($permissionGroup->permissions->count())
                                                                                        @php
                                                                                            $permission = Spatie\Permission\Models\Permission::where(
                                                                                                'permission_group_id',
                                                                                                $permissionGroup->id,
                                                                                            )->get();
                                                                                        @endphp
                                                                                        @foreach ($permission as $key => $value)
                                                                                            <div
                                                                                                class="ml-3 d-flex flex-wrap">
                                                                                                <label>
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        name="permission[]"
                                                                                                        type="checkbox"
                                                                                                        value="{{ $value->id }}"
                                                                                                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}
                                                                                                        id="invalidCheck">
                                                                                                    {{ $value->name }}</label>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                    {{-- <tbody>
                                                        @if ($permissionGroups->count())
                                                            @foreach ($permissionGroups as $permissionGroup)
                                                                <tr>
                                                                    <td width="20%">{{ $permissionGroup->name }}</td>
                                                        <td>
                                                            <div class="row">
                                                                @if ($permissionGroup->permissions->count())
                                                                @php
                                                                $permission = Spatie\Permission\Models\Permission::where('permission_group_id', $permissionGroup->id)->get();
                                                                @endphp
                                                                @foreach ($permission as $key => $value)
                                                                <div class="d-flex flex-wrap">
                                                                    <label>
                                                                        <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} id="invalidCheck">
                                                                        {{ $value->name }}</label>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                        </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                        </tbody> --}}

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            Update
                                                        </button>
                                                        <a href="{{ route('roles.index') }}"
                                                            class="btn btn-secondary waves-effect m-l-5">
                                                            Cancel
                                                        </a>
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
