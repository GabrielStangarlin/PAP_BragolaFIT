<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BragolaFIT | Profile</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/store.css">
</head>

<body>
    <div class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color:#ffffff; height: 100px;">
        <div class="container px-4 px-lg-5 d-flex flex-column justify-content-between align-items-center">
            <!-- Parte superior da div -->
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Logo -->
                <a href="/store" class="navbar-brand mb-0">
                    <img src="img(s)/Bragola-Logo.png" style="max-width: 150px; height: auto;">
                </a>

                @auth
                    <div class="d-flex justify-content-end align-items-center w-900 ">
                        <!-- Usuário -->
                        <div class="dropdown me-3">
                            <button class="btn bg-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    <i class="fa-solid fa-user"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                                </a>
                            </div>
                        </div>
                    </div>
                @endauth
                @if (!Auth::check())
                    <a href="/login" style="margin-left: 12%">
                        <button class="btn bg-white" type="button">
                            <i class="fas fa-user"></i>Entrar
                        </button>
                    </a>
                @endif
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showCloseButton: true,
                    showConfirmButton: false,
                    position: 'top-right',
                    timer: 2000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'swal2-toast',
                    },
                });
            });
        </script>
    @endif



    <div class="container main-container">
        <div class="left-column">
            <ul>
                <li><a onclick="showContent('perfil')" style="cursor: pointer;">MEU PERFIL</a></li>
                <li><a onclick="showContent('encomendas')" style="cursor: pointer;">MINHAS ENCOMENDAS</a></li>
                <li><a onclick="showContent('desejos')" style="cursor: pointer;">LISTA DE DESEJOS</a></li>
            </ul>
        </div>
        <div class="right-column">
            <div id="perfil" class="content-section">
                @if (session('success'))
                    <script>
                        const successMessage = "{{ session('success') }}";
                    </script>
                @endif
                <div class="card p-4">
                    <form action="{{ route('user.updateProfile') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Nome</label>
                            <input type="text" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Endereço</label>
                            <input type="text" id="address" class="form-control" value="{{ $user->address }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Telefone</label>
                            <input type="text" id="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="vat_number">NIF</label>
                            <input type="text" id="vat_number" class="form-control"
                                value="{{ $user->vat_number }}">
                        </div>
                        <button class="btn btn btn-primary">GUARDAR</button>
                    </form>
                </div>
                <div class="card p-4 mt-4">
                    <h4>Alterar Password</h4>
                    <form method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="current-password">Password atual</label>
                            <input type="password" id="current-password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="new-password">Nova Password</label>
                            <input type="password" id="new-password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm-password">Confirmar Nova Password</label>
                            <input type="password" id="confirm-password" class="form-control">
                        </div>
                        <button class="btn btn-primary">Alterar Password</button>
                    </form>
                </div>
            </div>
            <div id="encomendas" class="content-section" style="display: none;">
                <div class="card p-4">
                    <h4>Minhas Encomendas</h4>
                    @if (isset($orders))
                        @foreach ($orders as $order)
                            <div class="border rounded mt-4">
                                <p>Endereço de entrega: <span
                                        style="font-weight: bold">{{ $order->ship_address }}</span></p>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($order->orderProducts as $item)
                                    @php
                                        $itemTotal = $item->value * $item->quantity;
                                        $totalPrice += $itemTotal;
                                    @endphp
                                    <p>Produto: {{ $item->products->name }} -
                                        {{ number_format($item->value, 2, ',', '.') }}€ x {{ $item->quantity }}</p>
                                @endforeach
                                <p>Estado:
                                    @if ($order->order_status == 0)
                                        <span style="font-weight: bold; color:blue">Em processamento</span>
                                    @elseif ($order->order_status == 1)
                                        <span style="font-weight: bold; color:rgb(131, 0, 0)">Enviado</span>
                                    @elseif($order->order_status == 2)
                                        <span style="font-weight: bold; color:green">Entregue</span>
                                    @endif
                                </p>
                                <p>Total da encomenda: <span
                                        style="font-weight: bold">{{ number_format($totalPrice, 2, ',', '.') }}€</span>
                                </p>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>
            <div id="desejos" class="content-section" style="display: none;">
                <div class="card p-4">
                    <h4>Lista de Desejos</h4>
                    <p>Aqui estão os seus itens desejados.</p>
                    @forelse ($products as $product)
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4 text-center p-3">
                                    <img src="{{ $product->photo_1 }}" class="img-fluid rounded"
                                        style="max-width: 100%;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted">Preço:
                                            {{ number_format($product->price, 2, ',', '.') }} €</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a id="addToCart" class="btn btn-outline-success mt-auto"
                                                data-product-id="{{ $product->id }}">
                                                Adicionar ao
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>ainda não existe produtos na sua lista de desejos</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script JavaScript Botão Topo -->
    <script src="/js/store.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const successMessage = '{{ session('success') }}';

        $(document).on('click', '#addToCart', function() {
            var productId = $(this).data('product-id');

            $.ajax({
                type: 'GET',
                url: '/check-product-quantity/' + productId,
                success: function(response) {
                    if (response.quantity > 0) {
                        // Adicionar ao carrinho se a quantidade for maior que 0
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
                                if (response.responseJSON.not_logged_id) {
                                    window.location.href = '/login';
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Produto esgotado!",
                            text: "Este produto está esgotado no momento.",
                            showConfirmButton: true
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Erro",
                        text: "Não foi possível verificar a quantidade do produto.",
                        showConfirmButton: true
                    });
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
                                        <button class="btn btn-light decrease-quantity" data-id="${product.id}">-</button>
                                        <button class="btn btn-light increase-quantity" data-id="${product.id}">+</button>
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
</body>

</html>
