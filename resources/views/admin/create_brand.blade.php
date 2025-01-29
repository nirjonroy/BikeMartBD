@extends('admin.app')

@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Brand</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">

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

        <div class="form-group">
            <label for="exampleInputName">name</label>
            <input type="text" class="form-control" id="title" placeholder="Add title of brand" name="name" onkeyup="generateSlug()">
        </div>

        <div class="form-group">
            <label for="exampleInputName">Slug</label>
            <input type="text" class="form-control" id="slug" placeholder="Slug will be generated automatically" name="slug" readonly>
        </div>

        

        <div class="form-group">
            <label for="exampleInputName">Priority</label>
            <input type="number" class="form-control" id="seo_title" placeholder="Add priority " name="priority" >
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
