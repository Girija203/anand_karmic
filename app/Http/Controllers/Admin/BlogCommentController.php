<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class BlogCommentController extends Controller
{
      public function index()
      {
        return view('Admin.blog_comment.index');
      }

       public function indexData()
    {
        
        $blog_comment = BlogComment::get();
        
        return DataTables::of($blog_comment)->make(true);
    }
}
