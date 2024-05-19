@extends('template')

@section('title', 'Home')

@section('content')
    <div class="container-fluid full-screen-image d-flex align-items-center justify-content-center"
        style="background-image: url('https://img.goodfon.com/original/1920x1080/e/97/shtanga-skamya-gym-fitness.jpg'); background-size: cover; background-position: center; height: 100vh;   ">
        <div class="overlay text-center text-white w-100 h-100"
            style="background-color: rgba(0, 0, 0, 0.5); display: flex; flex-direction: column;align-content: center;justify-content: center;">
            <h1 class="fw-bold">Sejam bem-vindos ao centro de treinamento MuscleMasters!</h1>
            <h4 class="fw-bold">Do iniciante ao avançado! | Do jovem a melhor idade!</h4>
            <h5>Homens e Mulheres que desejam saúde, qualidade de vida e estética! </h5>
        </div>
    </div>
    <div class="container content-section">
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
