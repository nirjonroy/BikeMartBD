<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\siteInformation;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteInformationController extends Controller
{
    // ✅ Fetch all site information
    public function index()
    {
        $siteinfos = siteInformation::all();

        return response()->json([
            'success' => true,
            'data' => $siteinfos,
        ], 200);
    }

    // ✅ Fetch single site information
    public function show($id)
    {
        $info = siteInformation::find($id);

        if (!$info) {
            return response()->json([
                'success' => false,
                'message' => 'Site information not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $info,
        ], 200);
    }

    // ✅ Update site information
    public function update(Request $request, $id)
    {
        $info = siteInformation::find($id);

        if (!$info) {
            return response()->json([
                'success' => false,
                'message' => 'Site information not found',
            ], 404);
        }

        if ($request->hasFile('logo')) {
            $existing_logo = $info->logo;
            $extension = $request->file('logo')->getClientOriginalExtension();
            $logo = 'logo'.date('-Y-m-d-h-i-s-').rand(999, 9999).'.'.$extension;
            $logo_path = 'uploads/website-images/'.$logo;
            $request->file('logo')->move(public_path('uploads/website-images'), $logo);
            $info->logo = $logo_path;

            // Remove old logo if it exists
            if ($existing_logo && File::exists(public_path($existing_logo))) {
                unlink(public_path($existing_logo));
            }
        }

        // Update other fields
        $info->site_name = $request->site_name;
        $info->phone1 = $request->phone1;
        $info->phone2 = $request->phone2;
        $info->phone3 = $request->phone3;
        $info->email1 = $request->email1;
        $info->email2 = $request->email2;
        $info->email3 = $request->email3;
        $info->address1 = $request->address1;
        $info->address2 = $request->address2;
        $info->copyright = $request->copyright;
        $info->description = $request->description;
        $info->save();

        return response()->json([
            'success' => true,
            'message' => 'Site information updated successfully',
            'data' => $info,
        ], 200);
    }

    // ✅ Delete site information
    public function destroy($id)
    {
        $info = siteInformation::find($id);

        if (!$info) {
            return response()->json([
                'success' => false,
                'message' => 'Site information not found',
            ], 404);
        }

        $existing_logo = $info->logo;
        $info->delete();

        // Remove old logo if it exists
        if ($existing_logo && File::exists(public_path($existing_logo))) {
            unlink(public_path($existing_logo));
        }

        return response()->json([
            'success' => true,
            'message' => 'Site information deleted successfully',
        ], 200);
    }

    public function brand(){
        $brands = Brand::all();
        return response()->json([
         'success' => true,
         'data' => $brands,
     ], 200);
    }

    public function category(){
        $category = Category::all();
        return response()->json([
         'success' => true,
         'data' => $category,
     ], 200);
    }

    public function subcategory(){
        $subcategory = SubCategory::all();
        return response()->json([
         'success' => true,
         'data' => $subcategory,
     ], 200);
    }

    public function childcategory(){
        $childcategory = ChildCategory::all();
        return response()->json([
         'success' => true,
         'data' => $childcategory,
     ], 200);
    }

    public function product(){
        $product = Product::all();
        return response()->json([
         'success' => true,
         'data' => $product,
     ], 200);
    }

    public function blog(){
        $blog = Blog::all();
        return response()->json([
         'success' => true,
         'data' => $blog,
     ], 200);
    }

}
