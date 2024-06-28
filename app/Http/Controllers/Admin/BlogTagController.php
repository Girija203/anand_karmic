<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogTag;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class BlogTagController extends Controller
{
     public function index()
     {
        return view ('Admin.blog_tag.index');
     }
     public function indexData()
    {
        
        $blog_tag = BlogTag::get();
        
        return DataTables::of($blog_tag)->make(true);
    }


     public function create()
     {
        return view ('Admin.blog_tag.create');
     }

     public function store(Request $request)
     {
//   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $blog_tag = new BlogTag;
        $blog_tag->name = $request->input('name');
     
        $blog_tag->save();

        return redirect()->route('blog_tags.index')->with('success', 'Blog Tag added successfully!');

     }

     public function edit($id)

     {
          $blog_tag = BlogTag::find($id);

          return view('Admin.blog_tag.edit',compact('blog_tag'));
     }


       public function update(Request $request, $id)
     {
//   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $blog_tag = BlogTag::find($id);
        $blog_tag->name = $request->input('name');
     
        $blog_tag->save();

        return redirect()->route('blog_tags.index')->with('success', 'Blog Tag Update successfully!');

     }

     public function delete($id)

     {
        $blog_tag = BlogTag::find($id);

     
        $blog_tag->delete();

        $result = "Blog tag deleted successfully";
        return $result;



       
     }
}
