@extends('dashboard.dTemplate')

@section('title', 'Dashboard Home')

@section('dContent')

    <div class="text-center">
        <img src="/img(s)/Bragola-logo-noBg.png" alt="" class="img-fluid">
    </div>
    <div class="row mt-5 gap-4" style="justify-content: center">
        <div class="card bg-transparent shadow" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Total Users:</h5>
                <h3 class="card-subtitle mb-2 text-body-secondary">{{ $userCount }}</h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <a href="{{ route('dashboard.user') }}" class="card-link">See More</a>
            </div>
        </div>
        <div class="card bg-transparent shadow" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Total Products:</h5>
                <h3 class="card-subtitle mb-2 text-body-secondary">{{ $productCount }}</h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <a href="#" class="card-link">See More</a>
            </div>
        </div>
        <div class="card bg-transparent shadow" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h3 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <a href="#" class="card-link">See More</a>

            </div>
        </div>
        <div class="card bg-transparent shadow" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h3 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h3>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <a href="#" class="card-link">See More</a>

            </div>
        </div>
    </div>

    <div class="alert alert-light shadow welcome-message" id="welcomeMessage">
        Bem-vindo à nossa loja!
        <button type="button" class="btn-close" id="closeMessageButton" aria-label="Close"></button>
    </div>

    <button class="btn position-fixed bottom-0 end-0 m-4" id="toggleButton" style="position: relative;">
        <i class="fas fa-bell text-primary"></i>
        <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
            1
            <span class="visually-hidden">unread messages</span>
        </span>
    </button>

@endsection
