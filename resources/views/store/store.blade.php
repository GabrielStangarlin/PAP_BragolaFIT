<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BragolaFIT | Store</title>
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
                <a href="/" class="navbar-brand mb-0">
                    <img src="img(s)/Bragola-Logo.png" style="max-width: 150px; height: auto;">
                </a>
                <!-- Barra de Pesquisa -->
                <form class="d-flex position-relative" style="width: 550px;">
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

                        <!-- Favoritos -->
                        <button class="btn bg-white me-3" type="button">
                            <i class="fa-solid fa-star"></i> Favoritos
                        </button>

                        <!-- Carrinho -->
                        <button class="btn bg-white" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                        </button>
                    </div>
                @endauth
                @if (!Auth::check())
                    <a href="/login" style="margin-left: 12%">
                        <button class="btn bg-white" type="button">
                            <i class="fas fa-user"></i> Entrar
                        </button>
                    </a>
                @endif
            </div>
            <!-- Parte inferior da div -->
            <div class="d-none d-lg-flex align-items-center justify-content-center w-100">
                <ul class="nav justify-content-center">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link text-black active"
                                aria-current="page"href="{{ route('category.products', ['id' => $category->id]) }}">{{ $category->name }}</a>
                            <div class="submenu">
                                <div class="container">
                                    <!-- Adicione seus subitens de menu aqui -->
                                    <div>
                                        @foreach ($category->subcategories as $subcategory)
                                            <a
                                                href="{{ route('subcategory.products', ['id' => $subcategory->id]) }}">{{ $subcategory->name }}</a>
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
                            <summary class="nav-link"><a
                                    href="{{ route('category.products', ['id' => $category->id]) }}">{{ $category->name }}</a><i
                                    class="fa-solid fa-caret-down fa-sm" style="margin-left: 8px;"></i></summary>
                            <hr>
                            @foreach ($category->subcategories as $subcategory)
                                <div>
                                    <a
                                        href="{{ route('subcategory.products', ['id' => $subcategory->id]) }}">{{ $subcategory->name }}</a>
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
        <div class="offcanvas-body" id="cart-content">
            @if (isset($cart))
                @if ($cart->products->count() > 0)
                    @foreach ($cart->products as $product)
                        <div class="container overflow-hidden text-center">
                            <h6>{{ $product->name }}</h6>
                            <div class="row gx-2">
                                <div class="col">
                                    <div class="p-3">
                                        <img src="{{ $product->photo_1 }}" class="rounded" style="max-width: 50%">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="p-3">
                                        <p class="text-muted">Preço:
                                            {{ number_format($product->price, 2, ',', '.') }} €
                                        </p>
                                        <p class="text-muted">Quantidade: {{ $product->pivot->quantity }}</p>
                                        <button class="btn btn-light decrease-quantity"
                                            data-id="{{ $product->id }}}">-</button>
                                        <button class="btn btn-light increase-quantity"
                                            data-id="{{ $product->id }}}">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                    <div class="pt-3">
                        @php
                            $totalPrice = 0;
                            foreach ($cart->products as $product) {
                                $totalPrice += $product->price * $product->pivot->quantity;
                            }
                        @endphp
                        <h6>Preço Total do Carrinho: {{ number_format($totalPrice, 2, ',', '.') }} €</h6>
                    </div>
                    <div class="text-center">
                        <a href="/cart-details" class="btn btn-primary">Ver Carrinho</a>
                    </div>
                @else
                    <hr>
                    <div class="d-flex flex-column align-items-center text-center">
                        <i class="fa-solid fa-box fa-bounce mb-2" style="font-size: 3rem;"></i>
                        <p class="text-muted">De momento o seu carrinho está vazio.</p>
                    </div>
                @endif
            @else
                <hr>
                <div class="d-flex flex-column align-items-center text-center">
                    <i class="fa-solid fa-box fa-bounce mb-2" style="font-size: 3rem;"></i>
                    <p class="text-muted">De momento o seu carrinho está vazio.</p>
                </div>
            @endif
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

    <!-- Header-->
    <!--carrossel imagens-->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item">
                <a href="{{ route('subcategory.products', ['id' => 1]) }}"><img src="/img(s)/carrossel12.png"
                        class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('subcategory.products', ['id' => 15]) }}"><img
                        src="https://static.netshoes.com.br/bnn/l_netshoes/2024-01-08/3384_full-suplementos-desk.jpg"
                        class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item active">
                <a href="{{ route('subcategory.products', ['id' => 9]) }}"><img
                        src="https://acdn.mitiendanube.com/stores/001/046/066/themes/amazonas/1-slide-1626750131536-2845692359-8d0a34f5b31ecc3522a956e8567f76751626750182-1920-1920.png?1332177509"
                        class="d-block w-100" alt="..."></a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Main Content -->
    <!-- Botão do Menu para telas menores -->
    <button class="btn bg-white d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
        aria-controls="offcanvasMenu">
        <i class="fa-solid fa-bars"></i> MENU
    </button>
    <div class="col">
        <!-- Section for product-->
        <section class="py-5 mt-5">
            <h1 class="text-center">POPULARES</h1>
            <hr>

            <!--CARROSSEL CARDS-->
            <div id="carouselExamplecards" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($bestSellers->chunk(4) as $productChunk)
                        <!-- Agrupando os produtos em subconjuntos de 4 -->
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="container px-4 px-lg-5 mt-5">
                                <div
                                    class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                    @foreach ($productChunk as $product)
                                        <div class="col mb-5">
                                            <div class="card h-100">
                                                <!-- Product image-->
                                                <img class="card-img-top img-fluid mx-auto d-block" style="width: 50%"
                                                    src="{{ $product->photo_1 }}" alt="..." />
                                                <!-- Product details-->
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <!-- Product name-->
                                                        <h5 class="fw-bolder">{{ $product->name }}</h5>
                                                        <br>
                                                        @if ($product->quantity > 6)
                                                            <span class="availability-status"
                                                                style="color: green; font-size: 0.9rem;">
                                                                <i class="fa-solid fa-circle availability-icon"
                                                                    style="color: green; font-size: 0.6rem;"></i>
                                                                <strong>Em estoque</strong>
                                                            </span>
                                                        @elseif ($product->quantity >= 1 && $product->quantity <= 6)
                                                            <span class="availability-status"
                                                                style="color: orange; font-size: 0.9rem;">
                                                                <i class="fa-solid fa-circle availability-icon"
                                                                    style="color: orange; font-size: 0.6rem;"></i>
                                                                <strong>Poucas unidades</strong>
                                                            </span>
                                                        @else
                                                            <span class="availability-status"
                                                                style="color: red; font-size: 0.9rem;">
                                                                <i class="fa-solid fa-circle availability-icon"
                                                                    style="color: red; font-size: 0.6rem;"></i>
                                                                <strong>Fora de estoque</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- Product actions-->
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
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExamplecards"
                    data-bs-slide="prev">
                    <i class="fa-solid fa-chevron-left text-dark"></i>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExamplecards"
                    data-bs-slide="next">
                    <i class="fa-solid fa-chevron-right text-dark"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <h1 class="text-center">NOVIDADES</h1>
            <hr>
            <!--CARDS-->
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($newProducts as $product)
                        <div class="col mb-5">
                            <div class="card h-100 position-relative">
                                <!-- Heart Icon -->
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
                                <!-- Product image-->
                                <img class="card-img-top img-fluid mx-auto d-block" style="width: 50%"
                                    src="{{ $product->photo_1 }}" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $product->name }}</h5>
                                        <br>
                                        @if ($product->quantity > 6)
                                            <span class="availability-status"
                                                style="color: green; font-size: 0.9rem;">
                                                <i class="fa-solid fa-circle availability-icon"
                                                    style="color: green; font-size: 0.6rem;"></i>
                                                <strong>Em estoque</strong>
                                            </span>
                                        @elseif ($product->quantity >= 1 && $product->quantity <= 6)
                                            <span class="availability-status"
                                                style="color: orange; font-size: 0.9rem;">
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
                                <!-- Product actions-->
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
            </div>
        </section>
    </div>
    <div class="top-btn-container text-end">
        <button onclick="topFunction()" id="topBtn" title="Voltar ao Topo"><i
                class="fa-solid fa-arrow-up"></i></button>
    </div>

    <!-- Footer-->
    <footer class="py-4 bg-dark mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white"><span style="color: rgb(119, 0, 0)">LOCALIDADES</span></h5>
                    <ul class="list-unstyled text-white">
                        <li>LISBOA</li>
                        <li>BEJA</li>
                        <li>MADEIRA</li>
                        <li>AVEIRO</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white"><span style="color: rgb(119, 0, 0)">LINKS RÁPIDOS</span></h5>
                    <ul class="list-unstyled text-white">
                        <li>Preços</li>
                        <li>Blog</li>
                        <li>Política de Privacidade</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white"><span style="color: rgb(119, 0, 0)">REDES SOCIAIS</span></h5>
                    <!-- Aqui você pode adicionar seus ícones de mídia social -->
                    <ul class="list-unstyled">
                        <li><i class="fab fa-instagram fa-lg text-white mr-3"></i></li>
                        <li><i class="fab fa-youtube fa-lg text-white mr-3"></i></li>
                        <li><i class="fab fa-whatsapp fa-lg text-white mr-3"></i></li>
                    </ul>
                </div>
            </div>
            <p class="mb-0 text-center text-white">© 2024 Todos os direitos reservados BRAGOLA FIT | Site by Gabriel
                Stangarlin & Mário Figueiredo.</p>
        </div>
    </footer>

</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Script JavaScript Botão Topo -->
<script src="/js/store.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Quando o usuário clicar no botão, rolar para o topo do documento
    function topFunction() {
        document.body.scrollTop = 0; // Para Safari
        document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE e Opera
    }

    const successMessage = '{{ session('success') }}'

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

    function toggleWishlist(productId) {
        let url = '/wishlist/add';

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const icon = document.getElementById(`wishlist-icon-${data.product_id}`);

                    // Atualiza o ícone
                    if (data.action === 'added') {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                    } else if (data.action === 'removed') {
                        icon.classList.remove('fa-solid');
                        icon.classList.add('fa-regular');
                    }
                }
            });
    }
</script>

</html>
