<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('tittle')</title>
    <!-- Favicon-->
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
    <!-- Navigation-->
    <div class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color:#ffffff; height: 100px;">
        <div class="container px-4 px-lg-5 d-flex flex-column justify-content-between align-items-center">
            <!-- Parte superior da div -->
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Logo -->
                <a href="/store" class="navbar-brand mb-0">
                    <img src="{{ asset('img(s)/Bragola-Logo.png') }}" style="max-width: 150px; height: auto;">
                </a>

                <!-- Barra de Pesquisa (para telas maiores) -->
                <form class="d-none d-lg-flex position-relative" style="width: 550px;">
                    <input class="form-control me-2" type="search" placeholder="Encontre o melhor suplemento pra ti"
                        aria-label="Search">
                    <button class="btn border-0 position-absolute end-0 top-0 bottom-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                @auth
                    <div class="d-flex justify-content-end align-items-center w-900 mt-3">
                        <!-- Usuário -->
                        <div class="dropdown me-3">
                            <button class="btn bg-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    <i class="fa-solid fa-user"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                                </a>
                            </div>
                        </div>

                        <!-- Carrinho -->
                        <button class="btn bg-white" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                        </button>
                    </div>
                @endauth

                <!-- Entrar (para telas menores) -->
                @if (!Auth::check())
                    <a href="/login" style="margin-left: 12%">
                        <button class="btn bg-white d-lg-none" type="button">
                            <i class="fas fa-user"></i> Entrar
                        </button>
                    </a>
                @endif
            </div>

            <!-- Parte inferior da div (para telas menores) -->
            <div class="d-lg-none align-items-center justify-content-center w-100">
                <!-- Barra de Pesquisa (para telas menores) -->
                <form class="position-relative mb-3" style="width: 80%;">
                    <input class="form-control me-2" type="search" placeholder="Encontre o melhor suplemento pra ti"
                        aria-label="Search">
                    <button class="btn border-0 position-absolute end-0 top-0 bottom-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Parte inferior da div (para telas maiores) -->
            <div class="d-none d-lg-flex align-items-center justify-content-center w-100">
                <ul class="nav justify-content-center">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link text-black active" aria-current="page"
                                href="{{ route('category.products', ['id' => $category->id]) }}">{{ $category->name }}</a>
                            <div class="submenu">
                                <div class="container">
                                    <!-- Adicione seus subitens de menu aqui -->
                                    <div>
                                        @foreach ($category->subcategories as $subcategory)
                                            <a href="{{ route('subcategory.products', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                        @endforeach
                                    </div>
                                    <div class="image">
                                        <img src="https://i0.wp.com/naturvida.com.br/wp-content/uploads/2023/08/Pre-Treino.webp?fit=1170%2C650&ssl=1"
                                            alt="Imagem" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div id="successModal" class="modal-content p-3 mt-5">
        <div class="modal-body">
            <p id="successMessage"></p>
        </div>
    </div>

    <!-- Offcanvas do Menu para telas menores -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column offcanvas-submenu">
                <li class="nav-item">
                    @foreach ($categories as $category)
                        <details>
                            <summary class="nav-link"><a href="{{ route('category.products', ['id' => $category->id]) }}">{{ $category->name }}</a><i class="fa-solid fa-caret-down fa-sm" style="margin-left: 8px;"></i></summary>
                            <hr>
                            @foreach ($category->subcategories as $subcategory)
                                <div>
                                    <a href="{{ route('subcategory.products', ['id' => $subcategory->id]) }}">{{ $subcategory->name }}</a>
                                </div>
                                <hr>
                            @endforeach
                        </details>
                    @endforeach
                
                </li>
            </ul>

        </div>
    </div>

    <!-- Offcanvas do Carrinho -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Carrinho</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <hr>
            <div class="d-flex flex-column align-items-center text-center">
                <i class="fa-solid fa-box fa-bounce mb-2" style="font-size: 3rem;"></i>
                <p class="text-muted">De momento o seu carrinho está vazio.</p>
            </div>
        </div>
    </div>


    <!-- Header-->
   


    <!-- Main Content -->
    <!-- Botão do Menu para telas menores -->
    <button class="btn bg-white d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
        aria-controls="offcanvasMenu">
        <i class="fa-solid fa-bars"></i> MENU
    </button>
    <div class="col">
        <!-- Section for product-->
        <section class="py-5 mt-5">

            <!--CARDS-->
                    @yield('content')
        </section>
    </div>
    <div class="top-btn-container text-end">
        <button onclick="topFunction()" id="topBtn" title="Voltar ao Topo"><i
                class="fa-solid fa-arrow-up"></i></button>
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark mt-5" id="contatos" style="height: 350px">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-white"><span style="color: rgb(119, 0, 0)">LOCALIDADES</span></h5>
                    <ul class="text-white">
                        <li>LISBOA</li>
                        <li>BEJA</li>
                        <li>MADEIRA</li>
                        <li>AVEIRO</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-white"><span style="color: rgb(119, 0, 0)">LINKS RÁPIDOS</span></h5>
                    <ul class="text-white">
                        <li>Preços</li>
                        <li>Blog</li>
                        <li>Política de Privacidade</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-white"><span style="color: rgb(119, 0, 0)">REDES SOCIAIS</span></h5>
                    <!-- Aqui você pode adicionar seus ícones de mídia social -->
                    <ul style="color: #f0f0f0">
                        <li><i class="fa-brands fa-instagram fa-lg" style="color: #ffffff;"></i></li>
                        <li><i class="fa-brands fa-youtube fa-lg" style="color: #ffffff;"></i></li>
                        <li><i class="fa-brands fa-whatsapp fa-lg" style="color: #ffffff;"></i></li>
                    </ul>



                </div>
            </div>
            <p class="mb-0 text-center" style="color: #ffffff;">© 2024 Todos os direitos reservados BRAGOLA FIT | Site
                by Gabriel Stangarlin &
                Mário
                Figueiredo.</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>


    <!-- Script JavaScript Botão Topo -->
    <script src="/js/store.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Quando o usuário clicar no botão, rolar para o topo do documento
        function topFunction() {
            document.body.scrollTop = 0; // Para Safari
            document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE e Opera
        }

        const successMessage = '{{ session('success') }}'
    </script>
</body>

</html>
