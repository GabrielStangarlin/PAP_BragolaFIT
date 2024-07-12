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
                                        <span
                                            id="product-quantity-{{ $product->id }}">{{ $product->pivot->quantity }}</span>
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
                        <button class="btn btn-checkout mt-3" type="submit">Finalizar Compra</button>
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

        $(document).ready(function() {
            $('.increase-quantity').click(function() {
                var productId = $(this).data('id');
                $.ajax({
                    url: '{{ route('cart.increase') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productId: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#product-quantity-' + productId).text(response.quantity);
                            $('#total-price').text('Preço Total do Carrinho: ' + response
                                .totalPrice.toFixed(2).replace('.', ',') + ' €');
                            updateCartBadge();
                            updateCartContent();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            $('.decrease-quantity').click(function() {
                var productId = $(this).data('id');
                $.ajax({
                    url: '{{ route('cart.decrease') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productId: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#product-quantity-' + productId).text(response.quantity);
                            $('#total-price').text('Preço Total do Carrinho: ' + response
                                .totalPrice.toFixed(2).replace('.', ',') + ' €');
                            updateCartBadge();
                            updateCartContent();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Seleciona o formulário e adiciona um evento de submit
            document.getElementById('checkout-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Previne o comportamento padrão de submissão do formulário

                // Desabilita e esconde o botão de submissão
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.style.display = 'none';

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

                            // Habilita e mostra o botão novamente em caso de erro
                            submitButton.disabled = false;
                            submitButton.style.display = 'inline-block';
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

                        // Habilita e mostra o botão novamente em caso de erro
                        submitButton.disabled = false;
                        submitButton.style.display = 'inline-block';
                    });
            });
        });
    </script>

@endsection
