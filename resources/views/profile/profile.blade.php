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

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <li><a onclick="showContent('desejos')" style="cursor: pointer;">LISTA DE FAVORITOS</a></li>
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
                    <form id="profileForm" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Nome</label>
                            <input type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Endereço</label>
                            <input type="text" id="address" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Telefone</label>
                            <input type="text" id="phone" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="vat_number">NIF</label>
                            <input type="text" id="vat_number" class="form-control">
                        </div>
                        <button id="btn-profile" class="btn btn btn-primary">GUARDAR</button>
                    </form>
                </div>
                <div class="card p-4 mt-4">
                    <h4>Alterar Password</h4>
                    <form id="passwordForm" method="POST">
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
                        <button id="btn-password" class="btn btn-primary">Alterar Password</button>
                    </form>
                </div>
            </div>
            <div id="encomendas" class="content-section" style="display: none;">
                <div class="card p-4">
                    <h4>Minhas Encomendas</h4>
                    @if (isset($orders))
                        @foreach ($orders as $order)
                            @php
                                $totalPrice = 0;
                                foreach ($order->orderProducts as $item) {
                                    $itemTotal = $item->value * $item->quantity;
                                    $totalPrice += $itemTotal;
                                }
                            @endphp

                            <div class="order-summary border rounded mt-4 p-2"
                                onclick="toggleDetails('details-{{ $order->id }}')"
                                style="cursor: pointer; position: relative;">
                                <p style="margin-bottom: 0;">
                                    <strong>Encomenda #{{ $order->id }}</strong> - Total:
                                    {{ number_format($totalPrice, 2, ',', '.') }}€
                                    <span style="float: right; margin-right: 25px;">Data da encomenda:
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</span>
                                </p>
                                <i class="fa-solid fa-caret-down"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
                            </div>

                            <div id="details-{{ $order->id }}" class="order-details"
                                style="display: none; margin-left: 20px;">
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Preço Unitário</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderProducts as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->value, 2, ',', '.') }}€</td>
                                                <td>{{ number_format($item->value * $item->quantity, 2, ',', '.') }}€
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p>Estado:
                                    @if ($order->order_status == 0)
                                        <span style="font-weight: bold; color:blue">Em processamento</span>
                                    @elseif ($order->order_status == 1)
                                        <span style="font-weight: bold; color:rgb(131, 0, 0)">Enviado</span>
                                    @elseif($order->order_status == 2)
                                        <span style="font-weight: bold; color:green">Entregue</span>
                                    @endif
                                    - {{ \Carbon\Carbon::parse($order->updated_at)->format('d/m/Y') }}
                                </p>
                                <p>Endereço de entrega: <span
                                        style="font-weight: bold">{{ $order->ship_address }}</span></p>
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
                    <h4>Lista de Favoritos</h4>
                    <p>Aqui estão os seus produtos pretendidos.</p>
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
                        <p>ainda não existe produtos na sua lista de favoritos</p>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        const successMessage = '{{ session('success') }}';

        function toggleDetails(id) {
            var details = document.getElementById(id);
            if (details.style.display === "none") {
                details.style.display = "block";
            } else {
                details.style.display = "none";
            }
        }

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
                                }).then(() => {
                                    location.reload();
                                });
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

        function populateForm() {
            $.ajax({
                url: '/user/getProfile', // Ajuste essa URL conforme necessário
                method: 'GET',
                success: function(data) {

                    $('#name').val(data.name);
                    $('#address').val(data.address);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#vat_number').val(data.vat_number);
                },
                error: function(error) {
                    console.log('Erro ao buscar os dados do cliente:', error);
                }
            });
        }

        $(document).ready(function() {
            populateForm();
        });

        $(document).on('click', '#btn-profile', function() {
            event.preventDefault();
            var name = $('#profileForm').find('#name').val();
            var address = $('#profileForm').find('#address').val();
            var email = $('#profileForm').find('#email').val();
            var phone = $('#profileForm').find('#phone').val();
            var vat_number = $('#profileForm').find('#vat_number').val();

            $.ajax({
                url: '{{ route('user.updateProfile') }}',
                method: 'POST',
                data: {
                    name: name,
                    address: address,
                    email: email,
                    phone: phone,
                    vat_number: vat_number
                },
                success: function(data) {
                    Swal.fire({
                        icon: "success",
                        title: "Dados Atualizados com sucesso!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    populateForm();
                },
                error: function(error) {
                    console.log('Erro ao atualizar os dados do perfil:', error);
                }
            });
        });

        $(document).on('click', '#btn-password', function(event) {
            event.preventDefault();

            var currentPassword = $('#passwordForm').find('#current-password').val();
            var newPassword = $('#passwordForm').find('#new-password').val();
            var confirmPassword = $('#passwordForm').find('#confirm-password').val();

            if (newPassword !== confirmPassword) {
                Swal.fire({
                    icon: "error",
                    title: "Erro",
                    text: "As novas senhas não batem.",
                });
                return;
            }

            $.ajax({
                url: '{{ route('user.updatePassword') }}',
                method: 'POST',
                data: {
                    current_password: currentPassword,
                    new_password: newPassword
                },
                success: function(data) {
                    Swal.fire({
                        icon: "success",
                        title: "Senha atualizada com sucesso!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#passwordForm')[0].reset();
                },
                error: function(error) {
                    if (error.responseJSON && error.responseJSON.message) {
                        Swal.fire({
                            icon: "error",
                            title: "Erro",
                            text: error.responseJSON.message,
                        });
                    } else {
                        console.log('Erro ao atualizar a senha:', error);
                    }
                }
            });
        });
    </script>
</body>

</html>
