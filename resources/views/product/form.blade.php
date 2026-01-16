@extends('layouts.app')
@section('title',  'Add Product')
@section('content')
<div class="container">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>
        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Save</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>
@endsection
