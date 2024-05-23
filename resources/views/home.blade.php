@extends('template')

@section('title', 'Home')

@section('content')
    <div id="carouselExampleDark" class="carousel slide carousel-fade carousel-dark text-center">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="" src="img(s)/gym-bg1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="" src="img(s)/gym-bg2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="" src="img(s)/gym-bg3.jpg" alt="Third slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="overlay text-center w-100 h-100" style="margin-top: 80px">
        <h1 class="fw-bold">Sejam bem-vindos ao centro de treinamento Bragola fit!</h1>
        <h4 class="fw-bold">Do iniciante ao avançado! | Do jovem a melhor idade!</h4>
        <h5>Homens e Mulheres que desejam saúde, qualidade de vida e estética! </h5>
    </div>
    <div class="container content-section" style="margin-top: 100px; margin-bottom: 100px">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Suplementação para todos os publicos</h2>
                <p>
                    Em busca de massa muscular? Em busca de emagracimento? Melhoria de qualidade de vida?
                    Aqui é o lugar certo! Além de um centro de treinamento incrível temos também nossa loja de
                    suplementação.
                </p>
                <a href="/store">Venha Conhencer!</a>
            </div>
            <div class="col-md-6 text-right">
                <img src="https://images-americanas.b2w.io/produtos/1411230396/imagens/kit-de-suplementos-academia-whey-gold-standard-definition-bcaa/1411230601_1_xlarge.jpg"
                    class="img-fluid" alt="Kit de Suplementos">
            </div>
        </div>
    </div>
@endsection
