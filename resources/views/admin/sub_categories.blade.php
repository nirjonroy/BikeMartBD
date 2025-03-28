@extends('admin.app')

@section('content')
<!-- /.card -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Sub Category Informations</h3>
        <a href="{{route('sub-category.create')}}" class="btn btn-success float-right">Add</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category Name</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subCategories as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td><img src="{{asset($item->image)}}" alt="" width="100px" height="80px"></td>
                        <td>{{$item->name}}</td>
                        <td>{{ $item->category->name }}</td>

                        <td>
                            <a href="{{route('sub-category.edit', $item->id)}}" class="btn btn-warning">Edit</a>

                            <form action="{{route('sub-category.destroy', $item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection