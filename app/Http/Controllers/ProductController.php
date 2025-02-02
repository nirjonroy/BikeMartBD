<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'subCategory', 'childCategory', 'brand')->get();

        // dd($products);
        return view('admin.product', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.create_product', compact('categories', 'subCategories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'categoryId' => 'required|integer',
            'subCategoryId' => 'required|integer',
            'childCategoryId' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // Add other validations as needed
        ]);

        $product = new Product();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $imageName = 'image-' . now()->format('Y-m-d-h-i-s') . '-' . rand(999, 9999) . '.' . $extension;
            $imagePath = 'uploads/custom-images/products/' . $imageName;

            Image::make($request->image)->save(public_path($imagePath));
            $product->image = $imagePath;
        }

        // Generate a Unique Slug
        $slug = $request->slug ?? Str::slug($request->name);
        $count = Product::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Store Data
        $product->name = $request->name;
        $product->slug = $slug;
        $product->categoryId = $request->categoryId;
        $product->subCategoryId = $request->subCategoryId;
        $product->childCategoryId = $request->childCategoryId;
        $product->shortDescription = $request->shortDescription;
        $product->longDescription = $request->longDescription;
        $product->current_price = $request->current_price;
        $product->old_price = $request->old_price;
        $product->brand_id = $request->brand_id;
        $product->product_code = $request->product_code;
        $product->videoUrl = $request->videoUrl;
        $product->stock_qty = $request->stock_qty;
        $product->sold_qty = $request->sold_qty;
        $product->weight = $request->weight;
        $product->color = $request->color;
        $product->measurement = $request->measurement;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->tags = $request->tags;

        $product->save();

        return redirect()->back()->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $categories = Category::all();
        $subCategories = SubCategory::all();
        $childCategories = ChildCategory::all();
        $brands = Brand::all();

        return view('admin.edit_product', compact('product', 'categories', 'subCategories', 'brands', 'childCategories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'categoryId' => 'required|integer',
            'subCategoryId' => 'required|integer',
            'childCategoryId' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // Add other validations as needed
        ]);

        $product->image = $this->updateImage($request->file('image'), $product->image, 'image');

        // Update other fields
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->categoryId = $request->categoryId;
        $product->subCategoryId = $request->subCategoryId;
        $product->childCategoryId = $request->childCategoryId;
        $product->shortDescription = $request->shortDescription;
        $product->longDescription = $request->longDescription;
        $product->current_price = $request->current_price;
        $product->old_price = $request->old_price;
        $product->brand_id = $request->brand_id;
        $product->product_code = $request->product_code;
        $product->videoUrl = $request->videoUrl;
        $product->stock_qty = $request->stock_qty;
        $product->sold_qty = $request->sold_qty;
        $product->weight = $request->weight;
        $product->color = $request->color;
        $product->measurement = $request->measurement;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->tags = $request->tags;
        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully');
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
        $path = 'uploads/custom-images/products/' . $filename;
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
        $product = Product::findOrFail($id);

        // Delete associated images
        $this->deleteImageIfExists($product->hero_banner);
        $this->deleteImageIfExists($product->Sporting_event_image);


        // Delete the record
        $product->delete();

        return redirect()->back()->with('success', 'Record deleted successfully');
    }

    public function getSubcategoryByCategory($id)
    {

        $subCategories = SubCategory::where('cat_id', $id)->get();
        $response = "<option value=''>" . trans('Select Sub Category') . "</option>";
        foreach ($subCategories as $subCategory) {
            $response .= "<option value=" . $subCategory->id . ">" . $subCategory->name . "</option>";
        }
        return response()->json(['subCategories' => $response]);
    }


    public function getChildcategoryBySubCategory($id)
    {
        $childCategories = ChildCategory::where('sub_category_id', $id)->get();
        $response = '<option value="">' . trans('Select Child Category') . '</option>';
        foreach ($childCategories as $childCategory) {
            $response .= "<option value=" . $childCategory->id . ">" . $childCategory->name . "</option>";
        }
        return response()->json(['childCategories' => $response]);
    }
}
