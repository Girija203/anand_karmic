<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class BlogCategoryController extends Controller
{
     public function index()
     {
        return view('Admin.blog_category.index');
     }

      public function indexData()
    {
        
        $blog_category = BlogCategory::with('parent')->get();

    return DataTables::of($blog_category)
        ->editColumn('status', function ($blog_category) {
            return $blog_category->status ? 'Active' : 'Inactive';
        })
        ->make(true);   
    }

     public function create()
     {
        $categories = BlogCategory::all();
        return view('Admin.blog_category.create',compact('categories'));
     }

      public function store(Request $request)
    {
        
        $request->validate([
            'parent_id' => 'nullable|integer|exists:blog_categories,id',
            'name' => 'required|string|max:255',
            // 'status' => 'required|boolean',
        ]);

        $auth_id = auth()->id();
   
        $blog_category = new BlogCategory([
            'parent_id' => $request->input('parent_id'),
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            // 'status' => $request->input('status'),
            'created_by' => $auth_id,
            'updated_by' => $auth_id,
        ]);

        
        $blog_category->save();

       
        return redirect()->route('blog_categories.index')->with('success', 'Blog category created successfully.');
    }

    public function edit($id)

    {
        $blog_category = BlogCategory::find($id);
        $categories = BlogCategory::all();
        return view('Admin.blog_category.edit',compact('blog_category','categories'));
    }

      public function update(Request $request, $id)
    {
        
        $request->validate([
            'parent_id' => 'nullable|integer|exists:blog_categories,id',
            'name' => 'required|string|max:255',
        ]);

        $auth_id = auth()->id();
   
    $blog_category = BlogCategory::find($id);

    
    $blog_category->parent_id = $request->input('parent_id');
    $blog_category->name = $request->input('name');
    $blog_category->slug = Str::slug($request->input('name'));
    $blog_category->status = $request->input('status');
    $blog_category->created_by = $auth_id;
    $blog_category->updated_by = $auth_id;

    $blog_category->save();

       
        return redirect()->route('blog_categories.index')->with('success', 'Blog category Update successfully.');
    }

    public function delete($id)

     {
        
        $blog_category = BlogCategory::find($id);

     
        $blog_category->delete();

        return redirect()->route('blog_categories.index')->with('success', 'Blog category Delete successfully!');
     }


}
