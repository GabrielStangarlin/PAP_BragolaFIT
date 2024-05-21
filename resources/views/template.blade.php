<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/style.css')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(255, 255, 255) ">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">
                <img src="img(s)/Bragola-Logo.png" alt="Logo" style="max-width: 100px; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/store">Loja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Para Deixar Alinhado com a navBar-->
    <div class="container px-4 px-lg-5">
    </div>
    @yield('content')
</body>

<footer class="bg-black text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="text-center w-100">
            <p class="mb-0">© 2024 Todos os direitos reservados MuscleMasters | Site by Gabriel Stangarlin & Mario
                Figueiredo.</p>
        </div>
        <div class="d-flex justify-content-end">
            <a href="#" class="text-white mx-2"><ion-icon name="logo-instagram"></ion-icon></a>
        </div>
    </div>
</footer>






<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
