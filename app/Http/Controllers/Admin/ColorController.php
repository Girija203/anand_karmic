<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ColorController extends Controller
{
     public function index()
     {
        return view('Admin.color.index');
     }

    public function indexData()
    {

        $color = Color::get();

        return DataTables::of($color)
            ->editColumn('status', function ($color) {
                return $color->status ? 'Active' : 'Inactive';
            })
            ->make(true);
    }

    public function create()
    {
        return view('Admin.color.create');
    }

    public function store(Request $request)
    {

        //   dd($request);
        $request->validate([
            'name' => 'required',
             'code'=>'required'
        ]);

        $color = new Color();
        $color->name = $request->input('name');
        $color->code = $request->input('code');
        $color->status = 1;

        $color->save();

        return redirect()->route('colors.index')->with('success', 'color added successfully!');
    }

    public function edit($id)
    {
        $color = Color::find($id);
        return view('Admin.color.edit',compact('color'));
    }

    public function Update(Request $request,$id)
    {

        //   dd($request);
        $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);

        $color = Color::find($id);
        $color->name = $request->input('name');
        $color->code = $request->input('code');
        $color->status = $request->input('status');

        $color->save();

        return redirect()->route('colors.index')->with('success', 'color Update successfully!');
    }

    public function delete($id)
    {

    
        $color = Color::find($id);
      

        $color->delete();

        $result = "Color deleted successfully";
        return $result;
    }
}
