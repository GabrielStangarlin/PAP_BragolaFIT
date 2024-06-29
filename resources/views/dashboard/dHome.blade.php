@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Home')

@section('dContent')

    <div class="text-center">
        <img src="/img(s)/Bragola-logo-noBg.png" alt="" class="img-fluid">
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('dashboard.user') }}" class="card-link">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Users (All)</h6>
                                <h3 class="mb-0">{{ $userCount }}</h3>
                            </div>
                            <div class="card-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('dashboard.products') }}" class="card-link">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Products (All)</h6>
                                <h3 class="mb-0">{{ $productCount }}</h3>
                            </div>
                            <div class="card-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="#" class="card-link">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Orders (all)</h6>
                                <h3 class="mb-0">{{ $orderCount }}</h3>
                            </div>
                            <div class="card-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
