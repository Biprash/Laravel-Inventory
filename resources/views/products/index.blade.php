@extends('layouts.app')

@section('content')
    <div class="mt-4 d-flex justify-content-between">
        <h2 class="inline-block">Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $key=>$product)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td class="d-flex flex-row">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning mx-2">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('products.purchaseView', $product) }}" class="btn btn-sm btn-secondary mx-2">Buy</a>
                    <a href="{{ route('products.saleView', $product) }}" class="btn btn-sm btn-success mx-2">Sell</a>
                </td>
            </tr>
        @endforeach

        @if ( count($products) == 0 )
            <tr>
                <td></td>
                <td style="text-align: center">No data found</td>
            </tr>
        @endif

        </tbody>
    </table>

    <div class="row justify-content-center my-4">
        <div class="col-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection
