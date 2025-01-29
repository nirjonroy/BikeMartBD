<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index(){
        $sliders = slider::where('status', 1)->get();
        return view('admin.slider', compact('sliders'));
    }

    public function create(){
        return view('admin.create_slider');
    }

    public function store(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,gif,bmp,webp|max:2048', // Validate image
            'text_1' => 'required|string',
            'text_2' => 'required|string',
        ]);

        try {
            $slider = new slider();

            if ($request->image) {
                $extention = $request->image->getClientOriginalExtension();
                $image = 'image' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extention;
                $image = 'uploads/website-images/' . $image;
                Image::make($request->image)
                    ->save(public_path() . '/' . $image);
                $slider->image = $image;
            }

            $slider->text_1 = $request->text_1;
            $slider->text_2 = $request->text_2;

            $slider->save();
            return redirect()->back()->with('success', 'Created Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Image upload failed: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $slider = slider::find($id);
        return view('admin.edit_slider', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = slider::find($id);
        $slider->image = $this->updateImage($request->file('image'), $slider->image, 'image');
        $slider->text_1 = $request->text_1;
        $slider->text_2 = $request->text_2;
        $slider->save();
        return redirect()->back()->with('success', 'Updated Successfully');
    }

    private function updateImage($file, $previousImagePath, $fieldName)
    {
        if ($file) {
            $this->deleteImageIfExists($previousImagePath);
            return $this->uploadImage($file, $fieldName);
        }
        return $previousImagePath;
    }

    private function uploadImage($file, $fieldName)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $fieldName . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extension;
        $path = 'uploads/website-images/' . $filename;
        Image::make($file)->save(public_path($path));
        return $path;
    }

    private function deleteImageIfExists($path)
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    public function destroy($id)
    {
        $slider = slider::findOrFail($id);
        $this->deleteImageIfExists($slider->hero_banner);
        $this->deleteImageIfExists($slider->Sporting_event_image);
        $slider->delete();
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
