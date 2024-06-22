<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PermissionController extends Controller
{
     public function index()

     {
         $all_permission_groups = PermissionGroup::with('permissions')->get();
        return view ('Admin.user_management.permission.index',compact('all_permission_groups'));
     }
     public function indexData()
    {
        
      $all_permission_groups = PermissionGroup::with('permissions')->get();

    return DataTables::of($all_permission_groups)
        ->addColumn('permissions', function($permissionGroup) {
            if ($permissionGroup->permissions->isEmpty()) {
                return 'No permissions available';
            } else {
                return $permissionGroup->permissions->pluck('name')->implode(', ');
            }
        })
        ->make(true);   
    }

      public function create()
     {
         $permission_group = PermissionGroup::with('permissions')->get();
          $permission = Permission::get();
          return view ('Admin.user_management.permission.create',compact('permission_group','permission'));
     }

          public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $permission_control = new Permission;
        $permission_control->name = $request->input('name');
        $permission_control->permission_group_id = $request->input('permission_group_id');
        
       
   
        $permission_control->save();

        return redirect()->route('permissions.index')->with('success', 'Permission added successfully!');


     }

     public function edit($id)
{  
  
   $permissionGroup = PermissionGroup::find($id);
  
    $allPermissions = Permission::where('permission_group_id', $id)->get();
   //  dd($allPermissions);
  
    return view('Admin.user_management.permission.edit', compact('permissionGroup', 'allPermissions'));
}

public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'permissions' => 'array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $permissionGroup = PermissionGroup::findOrFail($id);

    // dd($permissionGroup);

    // Get all permissions for the given permission group ID or replace with ID 1 if not found
    $allPermissions = Permission::where('permission_group_id', $id)->get();
    $missingPermissions = collect();

    // dd($allPermissions,$missingPermissions);
    
    // Collect the IDs of permissions that are missing from the request data
    foreach ($allPermissions as $permission) {
        if (!in_array($permission->id, $request->input('permissions', []))) {
            $missingPermissions->push($permission->id);
        }
    }
    // dd($missingPermissions);
    
    // If there are missing permissions, associate them with permission_group_id 1
    if (!$missingPermissions->isEmpty()) {
        $missingPermissionsData = Permission::whereIn('id', $missingPermissions)->get();
        foreach ($missingPermissionsData as $missingPermission) {
            $missingPermission->permission_group_id = 1;
            $missingPermission->save();
        }
        
    }

    return redirect()->back()->with('success', 'Permissions updated successfully.');
}

public function storePermission(Request $request, $id)
{
    $permissionGroup = PermissionGroup::findOrFail($id);

    if ($request->has('permissions')) {
        foreach ($request->input('permissions') as $permissionName) {
            // Check if the permission already exists in any group
            $existingPermission = Permission::where('name', $permissionName)->first();

            if ($existingPermission) {
                // If the existing permission is in a different group, remove it
                if ($existingPermission->permission_group_id !== $permissionGroup->id) {
                    $existingPermission->delete();
                } else {
                    // If it's in the same group, skip adding it again
                    continue;
                }
            }

            // Create a new Permission instance
            $newPermission = new Permission();
            $newPermission->name = $permissionName;
            $newPermission->permission_group_id = $permissionGroup->id;
            $newPermission->save();
        }
    }

    return redirect()->route('permissions.index')->with('success', 'Permissions added successfully.');
}


  
 public function delete(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();


        if ($permission) {
            return redirect()->route('permissions.index')
                ->with('success', 'Permission deleted successfully');
        }

        return back()->with('failure', 'Please try again');
    }


}
