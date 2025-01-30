@extends('admin.app')

@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Sub category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('sub-category.update', $subCategory->id)}}" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">



                    <img src="{{asset($subCategory->image)}}" alt="" width="300px" height="auto">
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label>Category <span class="text-danger">*</span></label>
                        <select name="cat_id" id="category" class="form-control">
                            <option value="">Category Select</option>
                            @foreach ($categories as $category)
                                <option {{ $subCategory->cat_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName"> Name </label>
                        <input type="text" class="form-control" id="title" placeholder="add title of blog" name="name"
                            value="{{$subCategory->name}}" onkeyup="generateSlug()">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName"> Slug </label>
                        <input type="text" class="form-control" id="slug" placeholder="add title of blog" name="slug"
                            value="{{$subCategory->slug}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">Priority</label>
                        <input type="number" class="form-control" id="seo_title" placeholder="Add priority "
                            value="{{$subCategory->priority}}" name="priority">
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <script>
                function generateSlug() {
                    let title = document.getElementById("title").value;
                    let slug = title.toLowerCase() // Convert to lowercase
                        .replace(/ /g, "-") // Replace spaces with hyphens
                        .replace(/[^\w-]+/g, ""); // Remove special characters
                    document.getElementById("slug").value = slug;
                }
            </script>
        </div>
    </div>
</div>



@endsection