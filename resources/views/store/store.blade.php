<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Loja</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href='resources/css/style.css'>
</head>

<style>
     /* Estilo do rodapé */
     .footer {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

          /* Estilo da div que contém o botão */
          .top-btn-container {
            margin-right: 200px;
            bottom: 20px;
            right: 30px;
            z-index: 99;
        }

    /* Estilo do botão */
    #topBtn {
            border: none; /* Sem borda */
            outline: none; /* Sem contorno */
            background-color: #000; /* Cor de fundo do botão */
            color: white; /* Cor do texto do botão */
            cursor: pointer; /* Cursor do mouse em forma de mão */
            padding: 10px 20px; /* Espaçamento interno do botão */
            border-radius: 5px; /* Cantos arredondados */
        }

    #topBtn:hover {
            background-color: #555; /* Cor de fundo do botão ao passar o mouse */
        }

    .fa-box{
            font-size: 40px;
        }

    .nav-item:hover .submenu {
        display: block;
        }
          /* Adicione estilos CSS personalizados aqui */
    .nav-item {
            position: relative;
            cursor: pointer;
        }

    .submenu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 20px;
            width: 800px; /* Ajuste a largura conforme necessário */
            border-radius: 5px;
        }

    .nav-item:hover .submenu {
            display: block;
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            padding: 1rem;
        }

    .offcanvas-submenu .nav-item {
            margin-bottom: 1rem;
        }

    .submenu .container {
            display: flex;
            justify-content: space-between;
            
        }

    .submenu .container a {
            display: block;
            margin-bottom: 5px;
            color: black;
            text-decoration: none;
        }

    .submenu .container a:hover {
            text-decoration: underline;
        }

    .submenu .image {
            width: 300px; /* Ajuste a largura da imagem conforme necessário */
            margin-left: 20px;
        }

    .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

    .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        
    .card-img-top {
            transition: opacity 0.3s;
        }

    .card:hover .card-img-top {
            opacity: 0.7;
        }

    .nav-link {
            position: relative;
            display: inline-block;
            color: black;
            text-decoration: none;
        }
    .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: black;
            transition: width 0.3s ease, right 0.3s ease;
        }
    .nav-link:hover::after {
            width: 100%;
            right: 0;
        }

    @media (max-width: 992px) {
            .navbar-nav {
                display: none;
            }
            .submenu {
                display: none !important;
            }
        }
    .cor-a{
        color:#000;
    }  
</style>

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
                    <input class="form-control me-2" type="search" placeholder="Encontre o melhor suplemento pra ti" aria-label="Search">
                    <button class="btn border-0 position-absolute end-0 top-0 bottom-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                @auth
                <button class="btn bg-white" type="button" style="margin-left: 25%">
                    <i class="fas fa-user"></i> {{ user()->name }}
                </button>
                @endauth
                <button class="btn bg-white" type="button" style="margin-left: 25%">
                    <i class="fas fa-user"></i> Entrar
                </button>
                <!-- Carrinho -->
                <button class="btn bg-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </div>
            <!-- Parte inferior da div -->
            <div class="d-none d-lg-flex align-items-center justify-content-center w-100">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link text-black active" aria-current="page" href="#">SUPLEMENTOS</a>
                        <div class="submenu">
                            <div class="container">
                                <!-- Adicione seus subitens de menu aqui -->
                                <div>
                                    <a href="#" class="fw-bold">Proteínas</a>
                                    <a href="#">Proteínas</a>
                                    <a href="#">Isolada</a>
                                    <a href="#">Proteína Vegetal</a>
                                    <a href="#">protein</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Proteína</a>
                                    <a href="#">2 Hot</a>
                                    <a href="#">Fire Black</a>
                                    <a href="#">Carnitina</a>
                                    <a href="#">Shot Dry</a>
                                    <a href="#">Max Cut</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Hipercalóricos</a>
                                    <a href="#">Refil 3kg</a>
                                    <a href="#">Refil 1,4kg</a>
                                    <a href="#">Refil 2,4kg zero Lactose</a>
                                </div>
                                <div class="image">
                                    <img src="https://www.esportelandia.com.br/wp-content/uploads/2023/06/93222e8d-1678-4893-ba07-437863974ce6___a50bb6152fb8007ba71e99f6ad444bfa-e1687531158319.jpg" alt="Imagem" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">PROTEINAS</a>
                        <div class="submenu">
                            <div class="container">
                                <div>
                                    <a href="#" class="fw-bold">Proteínas</a>
                                    <a href="#">Proteínas</a>
                                    <a href="#">Isolada</a>
                                    <a href="#">Proteína Vegetal</a>
                                    <a href="#">protein</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Proteína</a>
                                    <a href="#">2 Hot</a>
                                    <a href="#">Fire Black</a>
                                    <a href="#">Carnitina</a>
                                    <a href="#">Shot Dry</a>
                                    <a href="#">Max Cut</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Hipercalóricos</a>
                                    <a href="#">Refil 3kg</a>
                                    <a href="#">Refil 1,4kg</a>
                                    <a href="#">Refil 2,4kg zero Lactose</a>
                                </div>
                                <div class="image">
                                    <img src="https://saudeguia.com/wp-content/uploads/produtos-growth.jpg" alt="Imagem" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">PRÉ TREINOS</a>
                        <div class="submenu">
                            <div class="container">
                                <div>
                                    <a href="#" class="fw-bold">Proteínas</a>
                                    <a href="#">Proteínas</a>
                                    <a href="#">Isolada</a>
                                    <a href="#">Proteína Vegetal</a>
                                    <a href="#">protein</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Proteína</a>
                                    <a href="#">2 Hot</a>
                                    <a href="#">Fire Black</a>
                                    <a href="#">Carnitina</a>
                                    <a href="#">Shot Dry</a>
                                    <a href="#">Max Cut</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Hipercalóricos</a>
                                    <a href="#">Refil 3kg</a>
                                    <a href="#">Refil 1,4kg</a>
                                    <a href="#">Refil 2,4kg zero Lactose</a>
                                </div>
                                <div class="image">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpNkyYofEow7FKJUiC-RuFha29I_v6opGTuw&usqp=CAU" alt="Imagem" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">CREATINA</a>
                        <div class="submenu">
                            <div class="container">
                                <div>
                                    <a href="#" class="fw-bold">Proteínas</a>
                                    <a href="#">Proteínas</a>
                                    <a href="#">Isolada</a>
                                    <a href="#">Proteína Vegetal</a>
                                    <a href="#">protein</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Proteína</a>
                                    <a href="#">2 Hot</a>
                                    <a href="#">Fire Black</a>
                                    <a href="#">Carnitina</a>
                                    <a href="#">Shot Dry</a>
                                    <a href="#">Max Cut</a>
                                </div>
                                <div>
                                    <a href="#" class="fw-bold">Hipercalóricos</a>
                                    <a href="#">Refil 3kg</a>
                                    <a href="#">Refil 1,4kg</a>
                                    <a href="#">Refil 2,4kg zero Lactose</a>
                                </div>
                                <div class="image">
                                    <img src="https://i0.wp.com/naturvida.com.br/wp-content/uploads/2023/08/Pre-Treino.webp?fit=1170%2C650&ssl=1" alt="Imagem" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Offcanvas do Menu para telas menores -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column offcanvas-submenu">
                <li class="nav-item">
                    <details>
                        <summary class="nav-link">SUPLEMENTOS<i class="fa-solid fa-caret-down fa-sm"></i></summary>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Proteínas</a>
                        </div>
                        <hr>
                        <div>
                            <p><a href="#" class="fw-bold cor-a">Proteína</a></p>
                        </div>
                        <hr>
                        <div>
                            <p><a href="#" class="fw-bold cor-a">Hipercalóricos</a></p>
                        </div>
                        <hr>
                    </details>
                </li>
                <li class="nav-item">
                    <details>
                        <summary class="nav-link">PROTEINAS <i class="fa-solid fa-caret-down fa-sm"></i></summary>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Proteínas</a>
                        </div>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Proteína</a>
                        </div>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Hipercalóricos</a>
                        </div>
                        <hr>
                    </details>
                </li>
                <li class="nav-item">
                    <details>
                        <summary class="nav-link">PRÉ TREINOS<i class="fa-solid fa-caret-down fa-sm"></i></summary>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Proteínas</a>
                        </div>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Proteína</a>
                        </div>
                        <hr>    
                        <div>
                            <a href="#" class="fw-bold cor-a">Hipercalóricos</a>
                        </div>
                        <hr>
                    </details>
                </li>
                <li class="nav-item">
                    <details>
                        <summary class="nav-link">CREATINA<i class="fa-solid fa-caret-down fa-sm"></i></summary>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Proteínas</a>
                        </div>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Proteína</a>
                        </div>
                        <hr>
                        <div>
                            <a href="#" class="fw-bold cor-a">Hipercalóricos</a>
                        </div>
                        <hr>
                    </details>
                </li>
            </ul>
            
        </div>
    </div>

    <!-- Offcanvas do Carrinho -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Carrinho</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Seu carrinho está vazio.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    

<!--offcanvas carrinho-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Carrinho</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <div class="offcanvas-body">
        <div class="text-center">
            <i class="fa-solid fa-box fa-bounce"></i>
        </div>
      <div class="text-center fw-bold">
       De momento o seu carrinho esta vazio.
      </div>
    </div>
</div>


    <!-- Header-->
    <!--carrossel imagens-->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item">
            <img src="/img(s)/carrossel12.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://static.netshoes.com.br/bnn/l_netshoes/2024-01-08/3384_full-suplementos-desk.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item active">
            <img src="https://acdn.mitiendanube.com/stores/001/046/066/themes/amazonas/1-slide-1626750131536-2845692359-8d0a34f5b31ecc3522a956e8567f76751626750182-1920-1920.png?1332177509" class="d-block w-100" alt="...">
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
    <button class="btn bg-white d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
        <i class="fa-solid fa-bars"></i> MENU
    </button>
    <div class="col">
        <!-- Section for product-->
        <section class="py-5 mt-5">
            <h1 class="text-center">LANÇAMENTOS</h1>
              <hr>

            <!--CARROSSEL CARDS-->
            <div id="carouselExamplecards" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Fancy Product</h5>
                                            <!-- Product price-->
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            $40.00 - $80.00
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">Saldo</div>
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product price-->
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <span class="text-muted text-decoration-line-through">$20.00</span>
                                            $18.00
                                            <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">Saldo</div>
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product price-->
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <span class="text-muted text-decoration-line-through">$20.00</span>
                                            $18.00
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">Saldo</div>
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            <span class="text-muted text-decoration-line-through">$20.00</span>
                                            $18.00
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  </div>
                  <div class="carousel-item">
                    
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Fancy Product</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            $40.00 - $80.00
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                                options</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">Sale</div>
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            <span class="text-muted text-decoration-line-through">$20.00</span>
                                            $18.00
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">Saldo</div>
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            <span class="text-muted text-decoration-line-through">$20.00</span>
                                            $18.00
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    <div class="badge bg-dark text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">Saldo</div>
                                    <!-- Product image-->
                                    <a href="/show_product"><img class="card-img-top" src="/img(s)/card1.png"
                                        alt="..." /></a>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            <span class="text-muted text-decoration-line-through">$20.00</span>
                                            $18.00
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExamplecards" data-bs-slide="prev">
                    <i class="fa-solid fa-chevron-left text-dark"></i>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExamplecards" data-bs-slide="next">
                    <i class="fa-solid fa-chevron-right text-dark"></i>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              <h1 class="text-center">NOVIDADES</h1>
              <hr>
                <!--CARDS-->
              <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/img(s)/card1.png"
                                alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View
                                        options</a></div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </section>
    </div>
    <div class="top-btn-container text-end">
        <button onclick="topFunction()" id="topBtn" title="Voltar ao Topo"><i class="fa-solid fa-arrow-up"></i></button>
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
                    <ul  style="color: #f0f0f0">
                        <li><i class="fa-brands fa-instagram fa-lg" style="color: #ffffff;"></i></li>
                        <li><i class="fa-brands fa-youtube fa-lg" style="color: #ffffff;"></i></li>
                        <li><i class="fa-brands fa-whatsapp fa-lg" style="color: #ffffff;"></i></li>
                    </ul>
                   
                   
                    
                </div>
            </div>
            <p class="mb-0 text-center" style="color: #ffffff;">© 2024 Todos os direitos reservados BRAGOLA FIT | Site by Gabriel Stangarlin &
                Mário
                Figueiredo.</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>


    <!-- Script JavaScript Botão Topo -->
    <script>
        // Quando o usuário clicar no botão, rolar para o topo do documento
        function topFunction() {
            document.body.scrollTop = 0; // Para Safari
            document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE e Opera
        }


        //Script JavaScript para os details
        document.addEventListener('DOMContentLoaded', function() {
            const detailsElements = document.querySelectorAll('details');

            detailsElements.forEach((detail) => {
                detail.addEventListener('toggle', function() {
                    if (this.open) {
                        detailsElements.forEach((otherDetail) => {
                            if (otherDetail !== this) {
                                otherDetail.removeAttribute('open');
                            }
                        });
                    }
                });
            });
        });
    </script>


</body>

</html>
