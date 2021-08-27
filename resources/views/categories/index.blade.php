@extends('layouts.app')

@section('content')
    <div class="mt-4 d-flex justify-content-between">
        <h2 class="inline-block">Categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $key=>$category)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $category->name }}</td>
                <td class="d-flex flex-row">
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning mx-2">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        @if ( count($categories) == 0 )
            <tr>
                <td></td>
                <td style="text-align: center">No data found</td>
            </tr>
        @endif

        </tbody>
    </table>

    <div class="row justify-content-center my-4">
        <div class="col-3">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
