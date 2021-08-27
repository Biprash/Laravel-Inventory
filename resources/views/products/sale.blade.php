@extends('layouts.app')

@section('content')

    <div class="mt-4">
        <h2>Selling {{ $product->name }}</h2>
        <form method="POST" action="{{ route('products.sale', $product) }}">
            @csrf
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ $quantity ?? old('quantity') }}" id="quantity">
                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
