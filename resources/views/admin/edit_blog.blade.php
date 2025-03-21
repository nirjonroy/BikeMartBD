@extends('admin.app')

@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Blog</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('blog.update', $blog->id)}}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">



                    <img src="{{asset($blog->image)}}" alt="" width="300px" height="auto">
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


                    <div class="form-group">
                        <label for="exampleInputName"> Title </label>
                        <input type="text" class="form-control" id="title" placeholder="add title of blog" name="title"
                            value="{{$blog->title}}" onkeyup="generateSlug()">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName"> Slug </label>
                        <input type="text" class="form-control" id="slug" placeholder="add title of blog" name="slug"
                            value="{{$blog->slug}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName"> Descriptions</label>
                        <div class="mb-3">
                            <textarea class="textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                name="description">
                        {{$blog->description}}
                       </textarea>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">SEO Title</label>
                        <input type="text" class="form-control" id="seo_title" placeholder="Add title of blog"
                            name="seo_title" value="{{$blog->seo_title}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName">SEO Descriptions</label>
                        <div class="mb-3">
                            <textarea class="textarea" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                name="seo_description">
                                  {{$blog->seo_description}}        
                        </textarea>
                        </div>
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