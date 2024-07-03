@extends('store.store_nav')
@section('tittle', 'Bragola|Carrinho')
@section('content')
    <div class="container my-3">
        <h1>Meu Carrinho:</h1>
        <hr>
        @foreach ($cart->products as $product)
            <div class="card mb-4">
                <div class="row g-0">
                    <div class="col-md-4 text-center p-3">
                        <img src="{{ $product->photo_1 }}" class="img-fluid rounded" style="max-width: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">Preço: {{ number_format($product->price, 2, ',', '.') }} €</p>
                            <p class="card-text text-muted">Quantidade: {{ $product->pivot->quantity }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="btn btn-light btn-sm decrease-quantity"
                                        data-id="{{ $product->id }}">-</button>
                                    <button class="btn btn-light btn-sm increase-quantity"
                                        data-id="{{ $product->id }}">+</button>
                                </div>
                                <button class="btn btn-outline-danger btn-sm remove-item" data-id="{{ $product->id }}"><i
                                        class="fa-solid fa-trash-can"></i> Remover</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="card text-center">
            <div class="card-body">
                @php
                    $totalPrice = 0;
                    foreach ($cart->products as $product) {
                        $totalPrice += $product->price * $product->pivot->quantity;
                    }
                @endphp
                <h5 class="card-title">Preço Total do Carrinho: {{ number_format($totalPrice, 2, ',', '.') }} €</h5>
                <form id="checkout-form" method="POST">
                    @csrf
                    <button class="btn btn-success mt-3" type="submit">Finalizar Compra</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                updateQuantity(productId, -1);
            });
        });

        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                updateQuantity(productId, 1);
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                $.ajax({
                    type: 'POST',
                    url: '/delete/product/cart',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: 'Item removido!',
                            showCloseButton: true,
                            showConfirmButton: false,
                            position: 'top-right',
                            timer: 2000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'swal2-toast',
                            },
                        });
                        updateCartContent();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.error); // Exibir mensagem de erro
                    }
                });
            });
        });

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

        function updateCartContent() {
            // Função para atualizar dinamicamente o conteúdo do carrinho, pode ser uma requisição AJAX para recarregar o HTML do carrinho
            location.reload(); // Solução simples: Recarregar a página para atualizar o conteúdo do carrinho
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
                                text: `Sua encomenda de id #${data.order_id} foi feita.`,
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
                                text: 'Houve um erro ao finalizar sua compra. Por favor, tente novamente.'
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
