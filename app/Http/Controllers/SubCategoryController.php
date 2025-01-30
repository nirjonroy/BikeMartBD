<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
   
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();
        // dd($subCategories);

        return view('admin.sub_categories', compact('subCategories'));
    }

   
    public function create()
    {
        $categories=Category::all();
        return view('admin.create_sub_category',compact('categories'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'slug' => 'nullable|string|max:255|unique:sub_categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation

        ]);

        $subCategory = new SubCategory();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $imageName = 'image-' . now()->format('Y-m-d-h-i-s') . '-' . rand(999, 9999) . '.' . $extension;
            $imagePath = 'uploads/custom-images/sub_categories/' . $imageName;

            Image::make($request->image)->save(public_path($imagePath));
            $subCategory->image = $imagePath;
        }

        // Generate a Unique Slug
        $slug = $request->slug ?? Str::slug($request->title); // Use input slug or generate from title
        $count = SubCategory::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number if slug exists
        }

        // Store Data
        $subCategory->name = $request->name;
        $subCategory->cat_id = $request->cat_id;
        $subCategory->slug = $slug;
        $subCategory->priority = $request->priority;
        $subCategory->save();

        return redirect()->back()->with('success', 'Created Successfully');
    }

    

    
    public function edit( $id)
    {
        $subCategory = SubCategory::find($id);
        $categories=Category::all();
        return view('admin.edit_sub_category',compact('subCategory','categories'));
    }

   
    public function update(Request $request,  $id)
    {
        $subCategory = SubCategory::find($id);

        // Update hero_banner image
        $subCategory->image = $this->updateImage($request->file('image'), $subCategory->image, 'image');




        // Update other fields
        $subCategory->name = $request->name;
        $subCategory->cat_id = $request->cat_id;
        $subCategory->slug = $request->slug;
        $subCategory->priority = $request->priority;
        $subCategory->save();

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
        $path = 'uploads/custom-images/sub_categories/' . $filename;
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
        $subCategory = SubCategory::findOrFail($id);
    
        // Delete associated images
        $this->deleteImageIfExists($subCategory->hero_banner);
        $this->deleteImageIfExists($subCategory->Sporting_event_image);
    
    
        // Delete the record
        $subCategory->delete();
    
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
