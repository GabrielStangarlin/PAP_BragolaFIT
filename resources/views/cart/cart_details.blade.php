@extends('store.store_nav')
@section('tittle', 'Bragola|Carrinho')
@section('content')
    <div class="container my-3">
        <h1>Meu Carrinho:</h1>
        <hr>
        <div id="cart-checkout">
            @if ($cart->products->count() > 0)
                <table class="table table-borderless" style="text-align: center">
                    <thead>
                        <tr>
                            <th class="text-center">Imagem</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->products as $product)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $product->photo_1 }}" class="img-fluid rounded" style="width: 20%;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 2, ',', '.') }} €</td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="btn btn-light btn-sm decrease-quantity"
                                            data-id="{{ $product->id }}">-</button>
                                        {{ $product->pivot->quantity }}
                                        <button class="btn btn-light btn-sm increase-quantity"
                                            data-id="{{ $product->id }}">+</button>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm remove-item" data-id="{{ $product->id }}">
                                        <i class="fa-solid fa-trash-can"></i> Remover
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    @php
                        $totalPrice = 0;
                        foreach ($cart->products as $product) {
                            $totalPrice += $product->price * $product->pivot->quantity;
                        }
                    @endphp
                    <h5 id="total-price">Preço Total do Carrinho: {{ number_format($totalPrice, 2, ',', '.') }} €</h5>
                    <form id="checkout-form" method="POST">
                        @csrf
                        <button class="btn btn-success mt-3" type="submit">Finalizar Compra</button>
                    </form>
                </div>
            @else
                <div class="text-center">
                    <p>Não há produtos no seu carrinho</p>
                    <p>Clique <a href="/store">aqui</a> para retornar a loja.</p>
                </div>
            @endif
        </div>

    </div>

    <script>
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                $.ajax({
                    type: 'POST',
                    url: '/delete/product/cart',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productId: productId,
                    },
                    success: function(response) {
                        updateCartContent()
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.error); // Exibir mensagem de erro
                    }
                });
            });
        });

        function updateCartQuantity(productId, action) {
            $.ajax({
                type: 'POST',
                url: '/cart-update',
                data: {
                    _token: '{{ csrf_token() }}',
                    productId: productId,
                    action: action
                },
                success: function(response) {
                    if (response.cartEmpty) {
                        $('#cart-content').html(
                            '<div class="d-flex flex-column align-items-center text-center"><i class="fa-solid fa-box fa-bounce mb-2" style="font-size: 3rem;"></i><p class="text-muted">De momento o seu carrinho está vazio.</p></div>'
                        );
                        $('#cart-checkout').html(
                            '<div class="card text-center"><div class="card-body"><p>Não há produtos no seu carrinho</p><p>Clique <a href="/store">aqui</a> para retornar a loja.</p></div></div>'
                        );
                    } else {
                        updateCartContent();
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Erro",
                        text: xhr.responseJSON.error,
                        showConfirmButton: true
                    });
                }
            });
        }

        function updateCartContent() {
            $.ajax({
                type: 'GET',
                url: '{{ route('cart.content') }}',
                success: function(response) {
                    let cartContent = '';
                    let cartCheckout = '';

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
                                        <button class="btn btn-light decrease-quantity" data-id="${product.id}">-</button>
                                        <button class="btn btn-light increase-quantity" data-id="${product.id}">+</button>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    `;

                        cartCheckout += `
                            <div class="card mb-4">
                                <div class="row g-0">
                                    <div class="col-md-4 text-center p-3">
                                        <img src="${product.photo_1}" class="img-fluid rounded" style="width: 28%;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">${product.name}</h5>
                                            <p class="card-text text-muted">Preço: ${product.price} €
                                            </p>
                                            <p class="card-text text-muted" id="quantity">Quantidade: ${product.quantity}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <button class="btn btn-light btn-sm decrease-quantity"
                                                        data-id="${product.id}">-</button>
                                                    <button class="btn btn-light btn-sm increase-quantity"
                                                        data-id="${product.id}">+</button>
                                                </div>
                                                <button class="btn btn-outline-danger btn-sm remove-item"
                                                    data-id="${product.id}"><i class="fa-solid fa-trash-can"></i> Remover</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });

                    cartContent += `
                    <div class="pt-3">
                        <h6>Preço Total do Carrinho: ${response.totalPrice} €</h6>
                    </div>
                    <div class="text-center">
                        <a href="/cart-details" class="btn btn-primary">Ver Carrinho</a>
                    </div>`;

                    cartCheckout += `
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title" id="total-price">Preço Total do Carrinho:
                                    ${response.totalPrice} €</h5>
                                <form id="checkout-form" method="POST">
                                    @csrf
                                    <button class="btn btn-success mt-3" type="submit">Finalizar Compra</button>
                                </form>
                            </div>
                        </div>
                    `;

                    $('#cart-checkout').html(cartCheckout);
                    $('#cart-content').html(cartContent);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.error); // Exibir mensagem de erro
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Seleciona o formulário e adiciona um evento de submit
            document.getElementById('checkout-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Previne o comportamento padrão de submissão do formulário

                // Cria uma instância do FormData para coletar dados do formulário
                let formData = new FormData(this);

                // Envia o formulário via AJAX usando fetch
                fetch('/cart-checkout', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Exibe o SweetAlert de sucesso
                            Swal.fire({
                                icon: 'success',
                                title: 'Compra realizada com sucesso!',
                                text: `Sua encomenda de nº${data.order_id} foi feita.`,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redireciona para a página /store
                                    window.location.href = '/store';
                                }
                            });
                        } else {
                            // Se houver um erro, exibe um alerta de erro
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message // Exibe a mensagem de erro específica
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao finalizar compra:', error);
                        // Exibe um alerta de erro genérico
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Houve um erro ao finalizar sua compra. Por favor, tente novamente.'
                        });
                    });
            });
        });
    </script>

@endsection
