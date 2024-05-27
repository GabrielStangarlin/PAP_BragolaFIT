<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite('resources/css/styles.css')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">


    <style>
        .fixed-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .welcome-message {
            position: fixed;
            bottom: 70px;
            /* Ajuste conforme necessário */
            right: 20px;
            z-index: 1000;
            display: none;
            /* Inicialmente oculto */
        }

        @media (max-width: 768px) {
            .fixed-button {
                display: none;
            }

            .welcome-message {
                display: none;
            }
        }

        [data-bs-toggle="tooltip"] {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-auto" style="background-color: rgb(255, 255, 255)">
                <div class="d-flex flex-sm-column flex-nowrap flex-row sticky-top">
                    <a href="{{ route('index') }}" class="d-block p-3 link-dark text-decoration-none" title=""
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <i class="fa-solid fa-arrow-left fa-beat"></i>
                        <span class="d-none d-sm-inline">Go back</span>
                    </a>
                    <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto">
                        <li>
                            <a href="{{ route('dashboard.home') }}" class="nav-link py-3 px-2" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="fa-solid fa-grip"></i>
                                <span class="d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.user') }}" class="nav-link py-3 px-2" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Users">
                                <i class="fa-solid fa-users"></i>
                                <span class="d-none d-sm-inline">Users</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown">
                                <a href="#" class="nav-link py-3 px-2 text-decoration-none" id="dropdownUser3"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    <span class="d-none d-sm-inline">Products</span>
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard.category') }}">
                                            <i class="fa-solid fa-layer-group"></i>
                                            Categories
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard.subcategory') }}">
                                            <i class="fa-solid fa-layer-group"></i>
                                            Subc ategories
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fa-solid fa-layer-group"></i>
                                            Products
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-original-title="Orders">
                                <i class="fa-solid fa-truck-fast"></i>
                                <span class="d-none d-sm-inline">Orders</span>
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                            id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-circle-user"></i>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                            <li><a class="dropdown-item" href="#">name</a></li>
                            <li><a class="dropdown-item" href="#">Loggout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm p-3 min-vh-100"
                style="background: rgb(63,94,251);
                background: linear-gradient(180deg, rgba(63,94,251,1) 0%, rgba(220,224,255,1) 28%, rgba(223,227,255,1) 29%, rgba(228,232,255,1) 30%, rgba(233,237,255,1) 31%, rgba(255,255,255,1) 35%);">
                <main>
                    @if (session('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('dContent')
                </main>
            </div>
        </div>
    </div>





















    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
        var csrf = '{{ csrf_token() }}';
    </script>
</body>

</html>
