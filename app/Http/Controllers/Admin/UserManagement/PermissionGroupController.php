<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PermissionGroupController extends Controller
{
     public function index()
     {
        $permission_group = PermissionGroup::get();

        return view ('Admin.user_management.permission_group.index',compact('permission_group'));
     }

     public function indexData()
    {
        
        $permission_group = PermissionGroup::get();
        
        return DataTables::of($permission_group)->make(true);
    }

     public function create ()
     {
        return view ('Admin.user_management.permission_group.create');
     }

        public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $permission_group = new PermissionGroup;
        $permission_group->name = $request->input('name');
     
        
       
   
        $permission_group->save();

        return redirect()->route('permission_groups.index')->with('success', 'Permission Group added successfully!');


     }

      public function edit($id)
     {
         $permission_group = PermissionGroup::find($id);

        return view ('Admin.user_management.permission_group.edit',compact('permission_group'));
     }


      public function update(Request $request, $id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $permission_group = PermissionGroup::find($id);
        $permission_group->name = $request->input('name');
     
        
       
   
        $permission_group->save();

        return redirect()->route('permission_groups.index')->with('success', 'Permission Group Update successfully!');


     }

     public function delete ($id)

     {
          $permission_group = PermissionGroup::find($id);
          $permission_group->delete();
          $result = "Permission group deleted successfully";
          return $result;
          return redirect()->route('permission_groups.index')->with('success', 'Permission Group Delete successfully!');
     }

}
