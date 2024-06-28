<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
     public function index()
     {
        $user = User::all();
        return view('Admin.user_management.user.index',compact('user'));
     }
      public function indexData()
    {
        
        $user = User::get();
        
        return DataTables::of($user)->make(true);
    }




     public function create()
     {
        $roles = Role::all();
        return view('Admin.user_management.user.create',compact('roles'));
     }

      public function store(Request $request)
    {
        $auth_id = auth()->id();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);
        
        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $input['created_by'] = $auth_id;
        $input['updated_by'] = $auth_id;
        $user = User::create($input);
        $role = Role::findById($request->input('role'));
        $user->assignRole($role);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

     public function edit(Role $roles, $id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::all();
        $userRole = $user->roles->first();
        return view('Admin.user_management.user.edit', compact('user', 'userRole', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',

        ]);


        $input = $request->all();
        // dd($input);
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
     
        $user = User::with('roles')->find($id);
        // dd($user);
        $user->update($input);
        $user->syncRoles($input['role']);
        if ($user) {
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        }

        return back()->with('failure', 'Please try again');
    }

    public function delete($id)
    {
      $user = User::find($id);
      $user->delete();
      $result = "User deleted successfully";
      return $result;
    

    }

}
