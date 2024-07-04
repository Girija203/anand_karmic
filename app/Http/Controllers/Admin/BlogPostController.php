<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetaType;
use App\Models\MetaKey;
use App\Models\MetaDetail;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class  BlogPostController extends Controller
{
     public function index()
     {
        return view('Admin.blog_post.index');
     }

      public function indexData()
    {
        
        $blog_post = BlogPost::with('user')->get();
        
        return DataTables::of($blog_post)->make(true);
    }

     public function create()
     {
      $meta_type = MetaType::all();
      $meta_key = MetaKey::all();
      $categories = BlogCategory::all();
      $blog_tag = BlogTag::all();
      return view('Admin.blog_post.create',compact('meta_type','meta_key','categories','blog_tag'));
     }

     public function getMetaKeys($metaTypeId)
    {
        $metaKeys = MetaKey::where('meta_types_id', $metaTypeId)->get();
        return response()->json($metaKeys);
    }

  public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
 
    ]);

   // $user = Auth::user()->id;
   // dd($user);

    // Create a new blog post
    $blog_post = new BlogPost;
    $blog_post->title = $request->input('title');
    $blog_post->slug = Str::slug($request->input('title'));
   $blog_post->content = $request->input('content');
   $blog_post->excerpt = $request->input('excerpt');
    $blog_post->is_draft = $request->input('is_draft');
   $blog_post->user_id = Auth::user()->id;
    $blog_post->created_by  = Auth::user()->id;
    $blog_post->updated_by  = Auth::user()->id;

if ($request->hasFile('featured_image')) {
        $filename = $request->file('featured_image')->store('Blog/Featured Images', 'public');
        $blog_post['featured_image'] = $filename;
    }

    $blog_post->save();

    
    $meta_keys_id = $request->input('meta_keys_id');
    $content = $request->input('meta_content');

    if ($meta_keys_id && $content) {
        foreach ($meta_keys_id as $index => $meta_key_id) {
            MetaDetail::create([
                'blog_posts_id' => $blog_post->id,
                'meta_keys_id' => $meta_key_id,
                'content' => $content[$index],
            ]);
        }
    }
    // Redirect back with a success message
    return redirect()->route('blog_posts.index')->with('success', 'Blog Post created successfully.');
}

public function edit($id)
{
    $blog_post = BlogPost::find($id);
     $meta_type = MetaType::all();
      $meta_key = MetaKey::all();
    $meta_details = MetaDetail::where('blog_posts_id', $id)->get();
    //    dd($meta_details);
    return view('Admin.blog_post.edit',compact('blog_post','meta_type','meta_key','meta_details'));
}

 public function update(Request $request,$id)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
 
    ]);

 
    $blog_post =  BlogPost::find($id);
    $blog_post->title = $request->input('title');
    $blog_post->slug = Str::slug($request->input('title'));
   $blog_post->content = $request->input('content');
   $blog_post->excerpt = $request->input('excerpt');
   $blog_post->user_id = Auth::user()->id;
    $blog_post->created_by  = Auth::user()->id;
    $blog_post->updated_by  = Auth::user()->id;
    $blog_post->save();

    
    $meta_keys_id = $request->input('meta_keys_id');
    $content = $request->input('meta_content');

    if ($meta_keys_id && $content) {
    foreach ($meta_keys_id as $index => $meta_key_id) {
        // Check if a MetaDetail record already exists for the given meta_key_id and blog_posts_id
        $existingMetaDetail = MetaDetail::where('blog_posts_id', $blog_post->id)
            ->where('meta_keys_id', $meta_key_id)
            ->first();

        if ($existingMetaDetail) {
            // If the MetaDetail record exists, update its content
            $existingMetaDetail->content = $content[$index];
            $existingMetaDetail->save();
        } else {
            // If the MetaDetail record doesn't exist, create a new one
            MetaDetail::create([
                'blog_posts_id' => $blog_post->id,
                'meta_keys_id' => $meta_key_id,
                'content' => $content[$index],
            ]);
        }
    }
}

    // Redirect back with a success message
    return redirect()->route('blog_posts.index')->with('success', 'Blog Post update successfully.');
}

public function delete($id)
{
    $blog_post = BlogPost::find($id);
    $blog_post->delete();
    $result='Blog poste deleted successfully';

    return $result;

    }

}