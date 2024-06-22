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

                    <!-- Carrinho -->
                    <button class="btn bg-white" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                        <i class="bi-cart-fill me-1"></i>
                        Carrinho
                    </button>
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Carrinho</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Seu carrinho está vazio.</p>
        </div>
    </div>

{{-- <div id="successModal" class="modal-content p-3 mt-5">
                        <div class="modal-body">
                            <p id="successMessage"></p>
                        </div>
                    </div> --}}


    <div class="container main-container">
        <div class="left-column">
            <ul>
                <li><a onclick="showContent('perfil')">MEU PERFIL</a></li>
                <li><a onclick="showContent('encomendas')">MINHAS ENCOMENDAS</a></li>
                <li><a onclick="showContent('desejos')">LISTA DE DESEJOS</a></li>
            </ul>
        </div>
        <div class="right-column">
            <div id="perfil" class="content-section">
                {{-- @if (session('success'))
                <script>
                    const successMessage = "{{ session('success') }}";
                </script>
            @endif --}}
                <div class="card p-4">
                    <form action="{{ route('user.updateProfile') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Nome</label>
                            <input type="text" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control" value="{{ $user->address }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">phone</label>
                            <input type="text" id="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="vat_number">Nif</label>
                            <input type="text" id="vat_number" class="form-control" value="{{ $user->vat_number }}">
                        </div>
                        <button class="btn btn btn-primary">GUARDAR</button>
                    </form>
                </div>
                <div class="card p-4 mt-4">
                    <h4>Alterar Password</h4>
                    <form action="{{ route('user.updateProfile') }}" method="POST">
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
                    <div class="form-group mb-3">
                        <label for="order-id">ID da Encomenda</label>
                        <input type="text" id="order-id" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="order-date">Data da Encomenda</label>
                        <input type="date" id="order-date" class="form-control">
                    </div>
                    <button class="btn btn-primary">Buscar Encomenda</button>
                </div>
            </div>
            <div id="desejos" class="content-section" style="display: none;">
                <div class="card p-4">
                    <h4>Lista de Desejos</h4>
                    <p>Aqui estão os seus itens desejados.</p>
                    <!-- Adicione aqui mais conteúdo relacionado à lista de desejos -->
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script JavaScript Botão Topo -->
    <script src="/js/store.js"></script>
</body>

</html>
