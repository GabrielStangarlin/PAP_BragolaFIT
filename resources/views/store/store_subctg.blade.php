@extends('store.store_nav')
@section('tittle', 'Bragola|Store')
@section('content')

    <h1 class="text-center custom-title" style="margin-left: 200px;">{{ $category->name }}</h1>
    <hr>

    <div class="container px-4 px-lg-5 mt-5">
        @foreach ($subcategories as $subcategory)
            <h2 class="text-center" style="font-weight: bold">{{ $subcategory->name }}</h2>
            <hr>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" style="padding: 2%;">
                @foreach ($subcategory->products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Heart Icon -->
                            @auth
                                <a onclick="toggleWishlist({{ $product->id }})"
                                    class="position-absolute top-0 end-0 m-2 "id="wishlist-button-{{ $product->id }}">
                                    @if (in_array($product->id, $wishlistProductIds))
                                        <i class="fa-solid fa-heart" style="color: red; font-size: 1.5rem;"
                                            id="wishlist-icon-{{ $product->id }}"></i>
                                    @else
                                        <i class="fa-regular fa-heart" style="color: red; font-size: 1.5rem;"
                                            id="wishlist-icon-{{ $product->id }}"></i>
                                    @endif
                                </a>
                            @endauth
                            <!-- Product image -->
                            <img class="card-img-top img-fluid mx-auto d-block" style="width: 50%"
                                src="{{ $product->photo_1 }}" alt="..." />
                            <!-- Product details -->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name -->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <br>
                                    @if ($product->quantity > 6)
                                        <span class="availability-status" style="color: green; font-size: 0.9rem;">
                                            <i class="fa-solid fa-circle availability-icon"
                                                style="color: green; font-size: 0.6rem;"></i>
                                            <strong>Em estoque</strong>
                                        </span>
                                    @elseif ($product->quantity >= 1 && $product->quantity <= 6)
                                        <span class="availability-status" style="color: orange; font-size: 0.9rem;">
                                            <i class="fa-solid fa-circle availability-icon"
                                                style="color: orange; font-size: 0.6rem;"></i>
                                            <strong>Poucas unidades</strong>
                                        </span>
                                    @else
                                        <span class="availability-status" style="color: red; font-size: 0.9rem;">
                                            <i class="fa-solid fa-circle availability-icon"
                                                style="color: red; font-size: 0.6rem;"></i>
                                            <strong>Fora de estoque</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <h6 class="fw-bolder" style="color: #050e88">
                                        {{ number_format($product->price, 2, ',', '.') }} €
                                    </h6>
                                    <a id="addToCart" class="btn btn-outline-success mt-auto"
                                        data-product-id="{{ $product->id }}">
                                        Adicionar ao
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
