<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class BrandController extends Controller
{
   
    public function index()
    {
        $brands = Brand::all();
    
    return view('admin.brands', compact('brands'));
    }

    
    public function create()
    {
        return view('admin.create_brand');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:brands,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
            
        ]);
    
        $brand = new Brand();
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $imageName = 'image-' . now()->format('Y-m-d-h-i-s') . '-' . rand(999, 9999) . '.' . $extension;
            $imagePath = 'uploads/custom-images/brands/' . $imageName;
    
            Image::make($request->image)->save(public_path($imagePath));
            $brand->image = $imagePath;
        }
    
        // Generate a Unique Slug
        $slug = $request->slug ?? Str::slug($request->title); // Use input slug or generate from title
        $count = Brand::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number if slug exists
        }
    
        // Store Data
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->priority = $request->priority;
        $brand->save();
    
        return redirect()->back()->with('success', 'Created Successfully');
    }

    

    
    public function edit($id)
    {
        $brand = Brand::find($id);
        
        return view('admin.edit_brand', compact('brand'));
    }

   
    public function update(Request $request,  $id)
    {
        $brand = Brand::find($id);

        // Update hero_banner image
        $brand->image = $this->updateImage($request->file('image'), $brand->image, 'image');




        // Update other fields
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->priority = $request->priority;


        $brand->save();

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
        $path = 'uploads/custom-images/brands/' . $filename;
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
        $brand = Brand::findOrFail($id);
    
        // Delete associated images
        $this->deleteImageIfExists($brand->hero_banner);
        $this->deleteImageIfExists($brand->Sporting_event_image);
    
    
        // Delete the record
        $brand->delete();
    
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
