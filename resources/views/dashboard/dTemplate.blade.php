<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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

    <link rel="stylesheet" href="/css/sb-admin-2.min.css">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    {{-- chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/styles.css'])

    <style>
        .card-custom {
            border-left: 5px solid #630303;
            padding: 10px;
            transition: transform 0.2s;
        }

        .card-custom:hover {
            transform: scale(1.05);
        }

        .card-icon {
            font-size: 2rem;
            color: #d1d5db;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        #successModal {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px;
            background-color: rgb(0, 153, 0);
            color: white;
            display: none;
            z-index: 1000;
        }
    </style>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: rgb(4, 4, 112)">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/store">
                <i class="fa-solid fa-dumbbell"></i>
                <div class="sidebar-brand-text mx-3">Bragola <sup>fit</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard.home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Products -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Produtos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Relacionado a Produtos:</h6>
                        <a class="collapse-item" href="{{ route('dashboard.products') }}">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            Produtos
                        </a>
                        <a class="collapse-item" href="{{ route('dashboard.category') }}">
                            <i class="fa-solid fa-layer-group"></i>
                            Categorias
                        </a>
                        <a class="collapse-item" href="{{ route('dashboard.subcategory') }}">
                            <i class="fa-solid fa-layer-group"></i>
                            Subcategorias
                        </a>
                    </div>
                </div>
            </li>
            <!-- Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-users"></i>
                    <span>Utilizadores</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Relacionado a Utilizadores:</h6>
                        <a class="collapse-item" href="{{ route('dashboard.user') }}">
                            <i class="fa-solid fa-users"></i>
                            Utilizadores
                        </a>
                        <a class="collapse-item" href="/db/list/order">
                            <i class="fa-solid fa-truck-fast"></i>
                            Encomendas
                        </a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <i class="fa-regular fa-circle-user text-gray-400"></i>
                                    @auth
                                        {{ Auth::user()->name }}
                                    @endauth
                                </span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fa-solid fa-user text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    <i class="fa-solid fa-right-from-bracket text-gray-400"></i>
                                    Loggout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- HOME -->
                <div class="container-fluid">
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
                    @yield('dContent')
                </div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white mt-5">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; 2024 BragolaFit. Todos os direitos Reservados.</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
</body>

<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin-2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

{{-- SWALL AlERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>

{{-- Select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    var csrf = '{{ csrf_token() }}';
    document.addEventListener('DOMContentLoaded', function() {
        // Verifica se a mensagem de sucesso está presente
        const successMessage = '{{ session('success') }}';
        if (successMessage) {
            // Define a mensagem no modal
            document.getElementById('successMessage').textContent = successMessage;
            // Mostra o modal
            const successModal = document.getElementById('successModal');
            successModal.style.display = 'block';
            // Esconde o modal após 2 segundos
            setTimeout(function() {
                successModal.style.display = 'none';
            }, 2000);
        }
    });
</script>

</html>
