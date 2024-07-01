@extends('store.store_nav')
@section('tittle', 'Bragola| Store')
@section('content')

    <h1 class="text-center  custom-title" style="margin-left: 200px;">{{ $subcategory->name }}</h1>
    <hr>


    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image -->
                        <img class="card-img-top img-fluid mx-auto d-block" style="width: 50%" src="{{ $product->photo_1 }}"
                            alt="..." />
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
                                <form id="add-to-cart-form" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="button" class="btn btn-outline-success mt-auto"
                                        onclick="addToCart({{ $product->id }})">
                                        Adicionar ao <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).on('click', '#addToCart', function() {
            var productId = $(this).data('product-id');

            $.ajax({
                type: 'POST',
                url: '/add-to-cart',
                data: {
                    _token: '{{ csrf_token() }}',
                    productId: productId
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Adicionado ao carrinho!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    updateCartContent(); // Atualizar o conteúdo do carrinho
                },
                error: function(response) {
                    if (response.responseJSON.not_logged_id) window.location.href = '/login'
                }
            });
        });

        function updateCartContent() {
            $.ajax({
                type: 'GET',
                url: '{{ route('cart.content') }}',
                success: function(response) {
                    let cartContent = '';

                    response.products.forEach(product => {
                        cartContent += `
                            <div class="container overflow-hidden text-center">
                                <h6>${product.name}</h6>
                                <div class="row gx-2">
                                    <div class="col">
                                        <div class="p-3">
                                            <img src="${product.photo_1}" class="rounded" style="max-width: 50%">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-3">
                                            <p class="text-muted">Preço: ${product.price} €</p>
                                            <p class="text-muted">Quantidade: ${product.quantity}</p>
                                            <button class="btn btn-dark decrease-quantity" data-id="${product.id}">-</button>
                                            <button class="btn btn-dark increase-quantity" data-id="${product.id}">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        `;
                    });

                    cartContent += `
            <div class="pt-3">
                <h6>Preço Total do Carrinho: ${response.totalPrice} €</h6>
            </div>
            <div class="text-center">
                <a href="/cart-details" class="btn btn-primary">Ver Carrinho</a>
            </div>`;

                    $('#cart-content').html(cartContent);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.error); // Exibir mensagem de erro
                }
            });
        }

        function updateQuantity(productId, change) {
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.updateQuantity') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    change: change
                },
                success: function(response) {
                    updateCartContent();
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.error); // Exibir mensagem de erro
                }
            });
        }

        $(document).on('click', '.decrease-quantity', function() {
            const productId = $(this).data('id');
            updateQuantity(productId, -1);
        });

        $(document).on('click', '.increase-quantity', function() {
            const productId = $(this).data('id');
            updateQuantity(productId, 1);
        });
    </script>
@endsection
