<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutSection;
use App\Models\AboutSectionImage;
use Yajra\DataTables\DataTables;

class AboutSectioncontroller extends Controller
{
    public function index()

    {
        return view('Admin.about_section.index');
    }
    public function indexData()
    {

        $about_section = AboutSection::get();

        return DataTables::of($about_section)->make(true);
    }
    public function create()

    {
        return view('Admin.about_section.create');
    }
    public function store(Request $request)
    {
        // dd($request);
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_left' => 'required|boolean',
            'image' => 'required|array|max:4',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:200000',
        ]);

        // Store about section data
        $aboutSection = AboutSection::create([
            'title' => $request->title,
            'content' => $request->content,
            'is_left' => $request->is_left,
        ]);

        // Check if images are uploaded
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imagePath = $image->store('About Section Images', 'public');
                // Store image data
                AboutSectionImage::create([
                    'about_section_id' => $aboutSection->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('about_sections.index')->with('success', 'About Section created successfully.');
    }

    public function edit ($id)
    {
        $about_section = AboutSection::with('images')->find($id);
        return view('Admin.about_section.edit',compact('about_section'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_left' => 'required|boolean',
            'image' => 'array|max:4',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:200000',
        ]);

        // Find the existing about section or return a 404 error if not found
        $aboutSection = AboutSection::findOrFail($id);

        // Update about section data
        $aboutSection->title = $request->title;
        $aboutSection->content = $request->content;
        $aboutSection->is_left = $request->is_left;
        $aboutSection->save();

        // Check if new images are uploaded
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imagePath = $image->store('About Section Images', 'public');
                // Store image data for the about section
                AboutSectionImage::create([
                    'about_section_id' => $aboutSection->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('about_sections.index')->with('success', 'About Section updated successfully.');
    }

    public function delete($id)
    {
        $aboutSection = AboutSection::find($id);
        $aboutSection->delete();
        $result = "About Section successfully";
        return $result;
    }

}
