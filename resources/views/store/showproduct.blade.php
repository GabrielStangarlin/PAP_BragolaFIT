@extends('store.store_nav')
@section('title', 'Detalhes do Produto')
<style>
    .custom-product-image {
        max-width: 100%;
        height: auto;
        width: 300px;
        /* ou qualquer tamanho que desejar */
    }
</style>

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $product->photo_1 }}" class="img-fluid custom-product-image" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">{{ $product->description }}</p>
                <h4>{{ number_format($product->price, 2, ',', '.') }} €</h4>
                <a id="addToCart" class="btn btn-outline-success mt-auto" data-product-id="{{ $product->id }}">
                    Adicionar ao
                    <i class="fa-solid fa-cart-plus"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
