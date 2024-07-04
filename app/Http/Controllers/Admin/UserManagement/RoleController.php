<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\PermissionGroup;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
class RoleController extends Controller
{
     public function index()
     {
         $all_roles = Role::orderBy('id', 'DESC')->get();
        return view ('Admin.user_management.role.index',compact('all_roles'));
     }

      public function indexData()
    {
        
        $roles = Role::with('permissions')->get();
        
         return DataTables::of($roles)
        ->addColumn('permissions', function($role) {
            return $role->permissions->pluck('name')->implode(', '); // Format permissions as a string
        })
        ->make(true);
    }

     public function create()
     {
         $permissionGroups = PermissionGroup::with('permissions')->get();
          $permission = Permission::get();
          return view ('Admin.user_management.role.create',compact('permissionGroups','permission'));
     }

     public function store(Request $request)
    {
         $request->validate([
            'role' => 'required|regex:/^[A-Za-z ]+$/',
            'permission' => 'required|array',
        ]);

         $role = Role::create(['name' => $request->input('role')]);
         $permissionIds = $request->input('permission');
         $permissions = Permission::whereIn('id', $permissionIds)->pluck('name');
         $role->syncPermissions($permissions);

        if ($role) {
            return redirect()->route('roles.index')
                ->with('success', 'Role & Permission created successfully');
        }
        return back()->with('failure', 'Please try again');
    }

     public function edit($id)
    {
        $role = Role::find($id);
        $permissionGroups = PermissionGroup::with('permissions')->get();
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        // dd($rolePermissions);
        return view('Admin.user_management.role.edit', compact('role', 'permission', 'rolePermissions', 'permissionGroups'));
    }

     public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionIds = $request->input('permission'); // assuming this is an array of IDs
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name');
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Role & Permission updated successfully');
    }

    public function delete(string $id)
    {
        $role = Role::find($id);
        $role->delete();

        $result = "Role deleted successfully";
        return $result;

        if ($role) {
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
        }

        return back()->with('failure', 'Please try again');
    }

}
