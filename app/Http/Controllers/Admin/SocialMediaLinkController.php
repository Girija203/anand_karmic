<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaLink;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class SocialMediaLinkController extends Controller
{
   public function index()
   {
      return view('Admin.social_mdeia_link.index');
   }
   public function indexData()
   {

      $social_mdeia_link = SocialMediaLink::get();

      return DataTables::of($social_mdeia_link)->make(true);
   }
   public function create()
   {
      return view('Admin.social_mdeia_link.create');
   }
   public function store(Request $request)
   {

      //   dd($request);
      $request->validate([
         'link' => 'required',
         'icon' => 'required',

      ]);

      $social_mdeia_link = new SocialMediaLink;
      $social_mdeia_link->link = $request->input('link');
      $social_mdeia_link->icon = $request->input('icon');


      $social_mdeia_link->save();

      return redirect()->route('social_media_links.index')->with('success', 'Social Mdeia Link added successfully!');
   }

   public function edit($id)
   {
      $social_media_link = SocialMediaLink::find($id);
      return view('Admin.social_mdeia_link.edit', compact('social_media_link'));
   }

   public function update(Request $request, $id)
   {

      //   dd($request);
      $request->validate([
         'link' => 'required',

      ]);

      $social_mdeia_link = SocialMediaLink::find($id);
      $social_mdeia_link->link = $request->input('link');
      $social_mdeia_link->icon = $request->input('icon');


      $social_mdeia_link->save();

      return redirect()->route('social_media_links.index')->with('success', 'Social Mdeia Link updated successfully!');
   }

   public function delete($id)
   {


      $social_mdeia_link = SocialMediaLink::find($id);

      $social_mdeia_link->delete();
      $result = "Social media link deleted successfully";
      return $result;

      return redirect()->route('social_media_links.index')->with('success', 'Social Mdeia Link Delete successfully!');
   }
}
