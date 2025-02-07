@extends('admin.app')

@section('content')
<!-- /.card -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Product Inventory</h3>
        <a href="{{route('product.create')}}" class="btn btn-success float-right">Add</a>
    </div>

    <form role="form" action="{{ route('add-stock') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName">Product name</label>
                <input type="text" class="form-control" id="title" placeholder="" name="name"
                    value="{{ $product->name }}" readonly>
                <input type="hidden" name="product_id" class="form-control" value="{{ $product->id }}">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Stock in Quantity</label>
                <input type="number" class="form-control" id="stock_in"
                    placeholder="Slug will be generated automatically" name="stock_in">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Current Stock</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $key => $history)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{ $history->stock_in }}</td>
                        <td>{{ $history->created_at->format('H:ia d F, Y') }}</td>
                        <td>
                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal"
                                class="btn btn-danger btn-sm" onclick="deleteData({{ $history->id }})"><i
                                    class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Hidden delete form -->
<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function deleteData(id) {
        $("#deleteForm").attr("action", '{{ url("delete-stock") }}/' + id);
        $("#deleteForm").submit();
    }
</script>

@endsection
