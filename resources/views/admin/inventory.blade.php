@extends('admin.app')

@section('content')
<!-- /.card -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Product Inventory</h3>
        <a href="{{route('product.create')}}" class="btn btn-success float-right">Add</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>stock</th>
                    <th>Sold</th>
                    

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>
                        <a href="{{ route('product.edit', $product->id) }}">{{ $product->name }}</a>
                    </td>
                    <td>{{ $product->stock_qty }}</td>
                    <td>{{ $product->sold_qty }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('stock-history', $product->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> </a>
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