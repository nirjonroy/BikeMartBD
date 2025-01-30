<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('admin.categories', compact('categories'));
    }


    public function create()
    {
        return view('admin.create_category');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation

        ]);

        $category = new Category();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $imageName = 'image-' . now()->format('Y-m-d-h-i-s') . '-' . rand(999, 9999) . '.' . $extension;
            $imagePath = 'uploads/custom-images/categories/' . $imageName;

            Image::make($request->image)->save(public_path($imagePath));
            $category->image = $imagePath;
        }

        // Generate a Unique Slug
        $slug = $request->slug ?? Str::slug($request->title); // Use input slug or generate from title
        $count = Category::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number if slug exists
        }

        // Store Data
        $category->name = $request->name;
        $category->slug = $slug;
        $category->priority = $request->priority;
        $category->save();

        return redirect()->back()->with('success', 'Created Successfully');
    }




    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.edit_category', compact('category'));
    }


    public function update(Request $request,  $id)
    {
        $category = Category::find($id);

        // Update hero_banner image
        $category->image = $this->updateImage($request->file('image'), $category->image, 'image');




        // Update other fields
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->priority = $request->priority;
        $category->save();

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
        $path = 'uploads/custom-images/categories/' . $filename;
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
        $category = Category::findOrFail($id);
    
        // Delete associated images
        $this->deleteImageIfExists($category->hero_banner);
        $this->deleteImageIfExists($category->Sporting_event_image);
    
    
        // Delete the record
        $category->delete();
    
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
