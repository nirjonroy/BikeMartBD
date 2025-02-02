@extends('admin.app')

@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
   
    <div class="card-body">
        <img src="{{asset($product->image)}}" alt="" width="300px" height="auto">
        <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
        </div>
        
        <div class="form-group col-12">
            <label>{{__('Category')}} <span class="text-danger">*</span></label>
            <select name="categoryId" class="form-control select2" id="category">
                <option value="">{{__('Select Category')}}</option>
                @foreach ($categories as $category)
                    <option {{ $product->categoryId == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12">
            <label>{{__('Sub Category')}}</label>
            <select name="subCategoryId" class="form-control select2" id="sub_category">
                <option value="">{{__('Select Sub Category')}}</option>
                @if ($product->categoryId != 0)
                    @foreach ($subCategories as $subCategory)
                    <option {{ $product->subCategoryId == $subCategory->id ? 'selected' : '' }} value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group col-12">
            <label>{{__('Child Category')}}</label>
            <select name="childCategoryId" class="form-control select2" id="child_category">
                <option value="">{{__('Select Child Category')}}</option>
                @if ($product->subCategoryId != 0)
                    @foreach ($childCategories as $childCategory)
                    <option {{ $product->childCategoryId == $childCategory->id ? 'selected' : '' }} value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputName">name</label>
            <input type="text" class="form-control" value="{{$product->name}}" id="title" placeholder="Add title of child Category" name="name" onkeyup="generateSlug()">
        </div>

        <div class="form-group">
            <label for="exampleInputName">Slug</label>
            <input type="text" class="form-control" value="{{$product->slug}}" id="slug" placeholder="Slug will be generated automatically" name="slug" readonly>
        </div>

        <div class="form-group">
            <label for="exampleInputName">Short Description</label>
            <div class="mb-3">
                <textarea class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" 
                          name="shortDescription">{{$product->shortDescription}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputName">Long Description</label>
            <div class="mb-3">
                <textarea class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" 
                          name="longDescription">
                          {{$product->longDescription}}        
                </textarea>
            </div>
        </div>



        <div class="form-group">
            <label for="exampleInputName">Current Price</label>
            <input type="number" class="form-control" id="seo_title" value="{{$product->current_price}}" placeholder="Current Price " name="current_price" >
        </div>

        <div class="form-group">
            <label for="exampleInputName">Old Price</label>
            <input type="number" class="form-control" id="seo_title" placeholder="Old Price " value="{{$product->old_price}}" name="old_price" >
        </div>

        <div class="form-group">
            <label>{{__('Brand')}}</label>
            <select name="brand_id" class="form-control select2" id="brand">
                <option value="">{{__('Select Brand')}}</option>
                @foreach ($brands as $brand)
                    <option {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputName">Product Code</label>
            <input type="text" class="form-control" id="seo_title" value="{{$product->product_code}}" placeholder="Product Code " name="product_code" >
        </div>

        <div class="form-group">
            <label for="exampleInputName">Video URL</label>
            <input type="text" class="form-control" id="seo_title" value="{{$product->videoUrl}}" placeholder="Video URL " name="videoUrl" >
        </div>

        <div class="form-group">
            <label for="exampleInputName">Stock Quantity </label>
            <input type="number" class="form-control" id="seo_title" value="{{$product->stock_qty}}" placeholder="Stock Quantity " name="stock_qty" >
        </div>

       

        <div class="form-group">
            <label for="exampleInputName">Weight </label>
            <input type="text" class="form-control" value="{{$product->weight}}" id="seo_title" placeholder="weight " name="weight" >
        </div>

        <div class="form-group">
            <label for="exampleInputName">color </label>
            <input type="text" class="form-control" id="seo_title" value="{{$product->color}}" placeholder="color " name="color" >
        </div>

        <div class="form-group">
            <label for="exampleInputName">Measurement </label>
            <input type="text" class="form-control" id="seo_title" placeholder="measurement " value="{{$product->measurement}}" name="measurement" >
        </div>

        <div class="form-group">
            <label for="exampleInputName">SEO Title</label>
            <input type="text" class="form-control" id="seo_title" placeholder="Add title of blog" value="{{$product->seo_title}}" name="seo_title" >
        </div>

        <div class="form-group">
            <label for="exampleInputName">SEO Descriptions</label>
            <div class="mb-3">
                <textarea class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" 
                          name="seo_description">
                    {{$product->seo_description}}        
                </textarea>
            </div>
        </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>



          </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    (function($) {
        "use strict";
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            $("#category").on("change",function(){
                var categoryId = $("#category").val();
                if(categoryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/subcategory-by-category/')}}"+"/"+categoryId,
                        success:function(response){
                            $("#sub_category").html(response.subCategories);
                            var response= "<option value=''>{{__('admin.Select Child Category')}}</option>";
                            $("#child_category").html(response);
                        },
                        error:function(err){
                            console.log(err);

                        }
                    })
                }else{
                    var response= "<option value=''>{{__('admin.Select Sub Category')}}</option>";
                    $("#sub_category").html(response);
                    var response= "<option value=''>{{__('admin.Select Child Category')}}</option>";
                    $("#child_category").html(response);
                }


            })

            $("#sub_category").on("change",function(){
                var SubCategoryId = $("#sub_category").val();
                if(SubCategoryId){
                    $.ajax({
                        type:"get",
                        url:"{{url('/childcategory-by-subcategory/')}}"+"/"+SubCategoryId,
                        success:function(response){
                            $("#child_category").html(response.childCategories);
                        },
                        error:function(err){
                            console.log(err);

                        }
                    })
                }else{
                    var response= "<option value=''>{{__('admin.Select Child Category')}}</option>";
                    $("#child_category").html(response);
                }

            })

            $("#is_return").on('change',function(){
                var returnId = $("#is_return").val();
                if(returnId == 1){
                    $("#policy_box").removeClass('d-none');
                }else{
                    $("#policy_box").addClass('d-none');
                }

            })

            $("#addNewSpecificationRow").on('click',function(){
                var html = $("#hidden-specification-box").html();
                $("#specification-box").append(html);
            })

            $(document).on('click', '.deleteSpeceficationBtn', function () {
                $(this).closest('.delete-specification-row').remove();
            });


            $("#manageSpecificationBox").on("click",function(){
                if(specification){
                    specification = false;
                    $("#specification-box").addClass('d-none');
                }else{
                    specification = true;
                    $("#specification-box").removeClass('d-none');
                }


            })

        });
    })(jQuery);

    function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-');
        }
</script>

<script>
    function generateSlug() {
        let title = document.getElementById("title").value;
        let slug = title.toLowerCase() // Convert to lowercase
                        .replace(/ /g, "-") // Replace spaces with hyphens
                        .replace(/[^\w-]+/g, ""); // Remove special characters
        document.getElementById("slug").value = slug;
    }
</script>
@endsection
