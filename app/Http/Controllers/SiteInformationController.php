<?php

namespace App\Http\Controllers;

use App\Models\siteInformation;
use Illuminate\Http\Request;
use File;

class SiteInformationController extends Controller
{
    public function index(){
        $siteinfos = siteInformation::all();
        return view('admin.siteinfo',compact('siteinfos'));
    }

    public function edit($id){
        $info = siteInformation::where('id', $id)->first();
        return view('admin.edit_siteInfo', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $info = siteInformation::find($id);
        if ($request->hasFile('logo')) {
            $existing_logo = $info->logo;
            $extension = $request->file('logo')->getClientOriginalExtension();
            $logo = 'logo'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extension;
            $logo_path = 'uploads/website-images/'.$logo;
            $request->file('logo')->move(public_path('uploads/website-images'), $logo);
            $info->logo = $logo_path;
            $info->save();
            if ($existing_logo) {
                if (File::exists(public_path($existing_logo))) {
                    unlink(public_path($existing_logo));
                }
            }
        }

        // Update other fields
        $info->site_name = $request->site_name; // Updated field name
        $info->phone1 = $request->phone1; // Updated field name
        $info->phone2 = $request->phone2; // Updated field name
        $info->phone3 = $request->phone3; // Updated field name
        $info->email1 = $request->email1;
        $info->email2 = $request->email2;
        $info->email3 = $request->email3;
        $info->address1 = $request->address1; // Updated field name
        $info->address2 = $request->address2; // Updated field name
        $info->copyright = $request->copyright; // Updated field name
        $info->description = $request->description; // Updated field name
        $info->save();

        return redirect()->route('site-information.index');
    }

    public function destroy($id){
        $info = siteInformation::find($id);
        $existing_logo = $info->logo;
        $info->delete();
        if($existing_logo){
            if(File::exists(public_path().'/'.$existing_logo)) unlink(public_path().'/'.$existing_logo);
        }

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
