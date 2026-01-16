@extends('layouts.app')
@section('title',  'Add Product')
@section('content')
<div class="container">
    <form id="productForm">
        @csrf

        <input name="name">
        <input name="sku">
        <input name="price">
        <input name="stock_quantity">

        <select name="status">
        <option value="active">Active</option>
        </select>

        <button type="submit">Save</button>
        </form>

        <script>
        document.getElementById('productForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            let form = e.target;
            let data = new FormData(form);

            let res = await fetch('/api/products', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: data
            });

            if(res.ok){
                window.location.href='/products';
            }else{
                console.log(await res.json());
            }
        });
        </script>

</div>
@endsection
