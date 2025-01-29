<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    
   public function index()
{
    $blogs = Blog::where('status', 1)->paginate(10);
    
    return view('admin.blogs', compact('blogs'));
}

    
    public function create()
    {
        return view('admin.create_blog');
    }

    
    
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:blogs,slug',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
        'seo_title' => 'nullable|string|max:255',
        'seo_description' => 'nullable|string|max:500',
    ]);

    $blog = new Blog();

    // Handle Image Upload
    if ($request->hasFile('image')) {
        $extension = $request->image->getClientOriginalExtension();
        $imageName = 'image-' . now()->format('Y-m-d-h-i-s') . '-' . rand(999, 9999) . '.' . $extension;
        $imagePath = 'uploads/custom-images/blogs/' . $imageName;

        Image::make($request->image)->save(public_path($imagePath));
        $blog->image = $imagePath;
    }

    // Generate a Unique Slug
    $slug = $request->slug ?? Str::slug($request->title); // Use input slug or generate from title
    $count = Blog::where('slug', 'like', $slug . '%')->count();
    if ($count > 0) {
        $slug .= '-' . ($count + 1); // Append a number if slug exists
    }

    // Store Data
    $blog->title = $request->title;
    $blog->slug = $slug;
    $blog->description = $request->description;
    $blog->seo_title = $request->seo_title;
    $blog->seo_description = $request->seo_description;
    $blog->save();

    return redirect()->back()->with('success', 'Created Successfully');
}


   
    public function edit( $id)
    {
        $blog = Blog::find($id);
        
        return view('admin.edit_blog', compact('blog'));
    }

    

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        // Update hero_banner image
        $blog->image = $this->updateImage($request->file('image'), $blog->image, 'image');




        // Update other fields
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;


        $blog->save();

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    private function updateImage($file, $previousImagePath, $fieldName)
    {
        if ($file) {
            // Delete previous image if it exists
            $this->deleteImageIfExists($previousImagePath);

            // Upload new image
            return $this->uploadImage($file, $fieldName);
        }

        // If no new image is uploaded, return the previous image path
        return $previousImagePath;
    }

    // Helper function to upload an image
    private function uploadImage($file, $fieldName)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $fieldName . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extension;
        $path = 'uploads/custom-images/blogs/' . $filename;
        Image::make($file)->save(public_path($path));
        return $path;
    }

    // Helper function to delete an image if it exists
    private function deleteImageIfExists($path)
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
    
        // Delete associated images
        $this->deleteImageIfExists($blog->hero_banner);
        $this->deleteImageIfExists($blog->Sporting_event_image);
    
    
        // Delete the record
        $blog->delete();
    
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
