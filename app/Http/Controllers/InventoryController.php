<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\siteInformation;
use Illuminate\Http\Request;


class InventoryController extends Controller
{
   

    public function index(){
        
          $products = Product::orderBy('id','desc')->get();
  
          $setting = siteInformation::first();
  
          return view('admin.inventory')->with(['products' => $products, 'setting' => $setting]);
      }

    

      public function show_inventory($id){
        
          $product = Product::where('id', $id)->first();
  
          $histories = Inventory::where('product_id', $id)->orderBy('id','desc')->get();
  
          return view('admin.stock_history')->with(['product' => $product, 'histories' => $histories]);
      }

    


      public function add_stock(Request $request){
      
        
 
         $inventory = new Inventory();
         $inventory->product_id = $request->product_id;
         $inventory->stock_in = $request->stock_in;
         $inventory->save();
 
         $product = Product::where('id', $request->product_id)->first();
         $product->stock_qty = $product->stock_qty + $request->stock_in;
         $product->save();
 
         $notification=trans('Added Successfully');
         $notification=array('messege'=>$notification,'alert-type'=>'success');
         return redirect()->back()->with($notification);
 
     }

     public function delete_stock($id){
      
        
        
          $inventory = Inventory::find($id);
          $product = Product::where('id', $inventory->product_id)->first();
          $update_qty = $product->stock_qty - $inventory->stock_in;
          $product->stock_qty = $update_qty < 0 ? 0 : $update_qty;
          $product->save();
          $inventory->delete();
  
          $notification=trans('Deleted Successfully');
          $notification=array('messege'=>$notification,'alert-type'=>'success');
          return redirect()->back()->with($notification);
  
      }
}
