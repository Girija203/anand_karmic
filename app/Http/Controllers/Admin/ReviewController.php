<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviews;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
   public function index(){

    $review=ProductReview::all();

    return view('Admin.review.index',compact('review'));
    
   }

   public function indexData()
   {
       
    $review=ProductReview::with('user','product')->get();
       
       return DataTables::of($review)

       ->addColumn('user_name', function($row) {
         return $row->user ? $row->user->name : 'N/A';
     })

       ->addColumn('product_name', function($row) {
        return $row->product ? $row->product->title : 'N/A';
    })
       ->make(true);
   }

   public function store(Request $request)
   {
    //   dd($request);
  $request->validate([
           'product_id' => 'required|exists:products,id',
           'review' => 'required|string|max:255',
       ]);
      // dd($data);

       $review = new ProductReview();
       $review->product_id = $request->product_id;
       $review->user_id = 1;
       $review->rating =  $request->rating;
       $review->review = $request->review;
       $review->status = 0; // or 1, based on your moderation policy
       $review->save();

       return redirect()->back()->with('success', 'Review submitted successfully!');
   }
}
