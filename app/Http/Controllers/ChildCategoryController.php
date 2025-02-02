<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class ChildCategoryController extends Controller
{
    
    public function index()
    {

        $childCategories=ChildCategory::with('subCategory','category')->get();

        return view('admin.child_category',compact('childCategories'));
    }
    
    
    public function create()
    {
      
        $categories=Category::all();
        $SubCategories=SubCategory::all();
        return view('admin.create_child_category',compact('categories','SubCategories'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'slug' => 'nullable|string|max:255|unique:sub_categories,slug',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation

        ]);

        $childCategory = new ChildCategory();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $imageName = 'image-' . now()->format('Y-m-d-h-i-s') . '-' . rand(999, 9999) . '.' . $extension;
            $imagePath = 'uploads/custom-images/child_categories/' . $imageName;

            Image::make($request->image)->save(public_path($imagePath));
            $childCategory->image = $imagePath;
        }

        // Generate a Unique Slug
        $slug = $request->slug ?? Str::slug($request->title); // Use input slug or generate from title
        $count = ChildCategory::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1); // Append a number if slug exists
        }

        // Store Data
        $childCategory->name = $request->name;
        $childCategory->category_id = $request->category_id;
        $childCategory->sub_category_id = $request->sub_category_id;
        $childCategory->slug = $slug;
        $childCategory->priority = $request->priority;
        $childCategory->save();

        return redirect()->back()->with('success', 'Created Successfully');
    }

   

   public function edit($id)
{
    $childCategory = ChildCategory::find($id);
    if (!$childCategory) {
        return redirect()->back()->with('error', 'Child Category not found');
    }

    $categories = Category::all();
    $subCategories = SubCategory::where('cat_id', $childCategory->category_id)->get();

    return view('admin.edit_child_category', compact('childCategory', 'categories', 'subCategories'));
}

   
public function update(Request $request,  $id)
{
    $childCategory = ChildCategory::find($id);

    // Update hero_banner image
    $childCategory->image = $this->updateImage($request->file('image'), $childCategory->image, 'image');




    // Update other fields
    $childCategory->name = $request->name;
    $childCategory->category_id = $request->category_id;
    $childCategory->sub_category_id = $request->sub_category_id;
    $childCategory->slug = $request->slug;
    $childCategory->priority = $request->priority;
    $childCategory->save();

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
        $path = 'uploads/custom-images/child_categories/' . $filename;
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
        $childCategory = ChildCategory::findOrFail($id);
    
        // Delete associated images
        $this->deleteImageIfExists($childCategory->hero_banner);
        $this->deleteImageIfExists($childCategory->Sporting_event_image);
    
    
        // Delete the record
        $childCategory->delete();
    
        return redirect()->back()->with('success', 'Record deleted successfully');
    }

    public function getSubcategoryByCategory($id){

        $subCategories=SubCategory::where('cat_id',$id)->get();
        $response="<option value=''>".trans('Select Sub Category')."</option>";
        foreach($subCategories as $subCategory){
            $response .= "<option value=".$subCategory->id.">".$subCategory->name."</option>";
        }
        return response()->json(['subCategories'=>$response]);
    }


    public function getChildcategoryBySubCategory($id){
        $childCategories=ChildCategory::where('sub_category_id',$id)->get();
        $response='<option value="">'.trans('Select Child Category').'</option>';
        foreach($childCategories as $childCategory){
            $response .= "<option value=".$childCategory->id.">".$childCategory->name."</option>";
        }
        return response()->json(['childCategories'=>$response]);
    }
}
