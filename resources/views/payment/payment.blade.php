<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        font-family: 'Montserrat', sans-serif;
    }

    body {

        background-color: #ffffff;
    }

    p {
        margin: 0%;
    }

    .container {
        padding: 20px;
        max-width: 980px;
        margin: 20px auto;
        overflow: hidden;
        background-color: #f8f9fa;
    }

    .box-1 {
        max-width: 450px;
        padding: 10px 40px;
        user-select: none;
    }

    .box-1 div .fs-12 {
        font-size: 8px;
        color: white;
    }

    .box-1 div .fs-14 {
        font-size: 15px;
        color: white;
    }

    .box-1 img.pic {
        width: 28px;
        height: 20px;
        object-fit: cover;
    }

    .box-1 img.mobile-pic {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .box-1 .name {
        font-size: 11px;
        font-weight: 600;
    }

    .dis {
        font-size: 12px;
        font-weight: 500;
    }

    label.box {
        width: 100%;
        font-size: 12px;
        background: #ddd;
        margin-top: 12px;
        padding: 10px 12px;
        border-radius: 5px;
        cursor: pointer;
        border: 1px solid transparent;
    }

    #one:checked~label.first,
    #two:checked~label.second,
    #three:checked~label.third {
        border-color: #7700ff;
    }

    #one:checked~label.first .circle,
    #two:checked~label.second .circle,
    #three:checked~label.third .circle {
        border-color: #7a34ca;
        background-color: #fff;
    }

    label.box .course {
        width: 100%;
    }

    label.box .circle {
        height: 12px;
        width: 12px;
        background: #ccc;
        border-radius: 50%;
        margin-right: 15px;
        border: 4px solid transparent;
        display: inline-block;
    }

    input[type="radio"] {
        display: none;
    }

    .box-2 {
        max-width: 450px;
        padding: 10px 40px;
    }


    .box-2 .box-inner-2 input.form-control {
        font-size: 12px;
        font-weight: 600;
    }

    .box-2 .box-inner-2 .inputWithIcon {
        position: relative;
    }

    .box-2 .box-inner-2 .inputWithIcon span {
        position: absolute;
        left: 15px;
        top: 8px;
    }

    .box-2 .box-inner-2 .inputWithcheck {
        position: relative;
    }

    .box-2 .box-inner-2 .inputWithcheck span {
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: green;
        font-size: 12px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        right: 15px;
        top: 6px;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        outline: none;
        border: 1px solid #7700ff;
    }

    .border:focus-within {
        border: 1px solid #7700ff !important;
    }

    .box-2 .card-atm .form-control {
        border: none;
        box-shadow: none;
    }

    .form-select {
        border-radius: 0;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;

    }

    .address .form-control.zip {
        border-radius: 0;
        border-bottom-left-radius: 10px;

    }

    .address .form-control.state {
        border-radius: 0;
        border-bottom-right-radius: 10px;

    }

    .box-2 .box-inner-2 .btn.btn-outline-primary {
        width: 120px;
        padding: 10px;
        font-size: 11px;
        padding: 0% !important;
        display: flex;
        align-items: center;
        border: none;
        border-radius: 0;
        background-color: whitesmoke;
        color: black;
        font-weight: 600;
    }

    .box-2 .box-inner-2 .btn.btn-primary {
        background-color: #7700ff;
        color: whitesmoke;
        font-size: 14px;
        display: flex;
        align-items: center;
        font-weight: 600;
        justify-content: center;
        border: none;
        padding: 10px;
    }

    .box-2 .box-inner-2 .btn.btn-primary:hover {
        background-color: #7a34ca;
    }

    .box-2 .box-inner-2 .btn.btn-primary .fas {
        font-size: 13px !important;
        color: whitesmoke;
    }

    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .carousel-inner {
        width: 100%;
        height: 250px;
    }

    .carousel-item img {
        object-fit: cover;
        height: 100%;
    }

    .carousel-control-prev {
        transform: translateX(-50%);
        opacity: 1;
    }

    .carousel-control-prev:hover .fas.fa-arrow-left {
        transform: translateX(-5px);
    }

    .carousel-control-next {
        transform: translateX(50%);
        opacity: 1;
    }

    .carousel-control-next:hover .fas.fa-arrow-right {
        transform: translateX(5px);
    }

    .fas.fa-arrow-left,
    .fas.fa-arrow-right {
        font-size: 0.8rem;
        transition: all .2s ease;
    }

    .icon {
        width: 30px;
        height: 30px;
        background-color: #f8f9fa;
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transform-origin: center;
        opacity: 1;
    }

    .fas,
    .fab {
        color: #6d6c6d;
    }

    ::placeholder {
        font-size: 12px;
    }

    @media (max-width:768px) {
        .container {
            max-width: 700px;
            margin: 10px auto;
        }

        .box-1,
        .box-2 {
            max-width: 600px;
            padding: 20px 90px;
            margin: 20px auto;
        }

    }

    @media (max-width:426px) {

        .box-1,
        .box-2 {
            max-width: 400px;
            padding: 20px 10px;
        }

        ::placeholder {
            font-size: 9px;
        }
    }
</style>

<body>
    <div class="container d-lg-flex">
        <div class="box-1 bg-light user">
            <div class="d-flex align-items-center mb-3">
                <img src="img(s)/Bragola-Logo.png" class="pic rounded-circle" alt="">
                <p class="ps-2 name">Bragola|FIT</p>
            </div>
            <div class="box-inner-1 pb-3 mb-3 ">
                <div class="d-flex justify-content-between mb-3 userdetails">
                    <p class="fw-bold">Seus Produtos</p>
                    <p class="fw-lighter"><span class="fas fa-dollar-sign"></span>33.00+</p>
                </div>
                <div id="my" class="carousel slide carousel-fade img-details" data-bs-ride="carousel"
                    data-bs-interval="2000">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#my" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#my" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#my" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://images.pexels.com/photos/100582/pexels-photo-100582.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                                class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.pexels.com/photos/258092/pexels-photo-258092.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                                class="d-block w-100 h-100">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.pexels.com/photos/7974/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                                class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#my" data-bs-slide="prev">
                        <div class="icon">
                            <span class="fas fa-arrow-left"></span>
                        </div>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#my" data-bs-slide="next">
                        <div class="icon">
                            <span class="fas fa-arrow-right"></span>
                        </div>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <p class="dis info my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate quos ipsa
                    sed officiis odio
                </p>
            </div>
        </div>
        <div class="box-2">
            <div class="box-inner-2">
                <div>
                    <p class="fw-bold">Payment Details</p>
                    <p class="dis mb-3">Complete your purchase by providing your payment details</p>
                </div>
                <form action="" id="payment-form">
                    <div class="mb-3">
                        <p class="dis fw-bold mb-2">Email address</p>
                        <input class="form-control" type="email" value="luke@skywalker.com">
                    </div>
                    <div>
                        <p class="dis fw-bold mb-2">Card details</p>
                        <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                            <div class="fab fa-cc-visa ps-3"></div>
                            <input id="card-element" type="text" class="form-control" placeholder="Card Details">
                            <div class="d-flex w-50">
                                <input type="text" class="form-control px-0" placeholder="MM/YY">
                                <input type="password" maxlength=3 class="form-control px-0" placeholder="CVV">
                            </div>
                        </div>
                        <div class="my-3 cardname">
                            <p class="dis fw-bold mb-2">Cardholder name</p>
                            <input class="form-control" type="text">
                        </div>
                        <div class="address">
                            <p class="dis fw-bold mb-3">Billing address</p>
                            <select class="form-select" aria-label="Default select example">
                                <option selected hidden>United States</option>
                                <option value="1">India</option>
                                <option value="2">Australia</option>
                                <option value="3">Canada</option>
                            </select>
                            <div class="d-flex">
                                <input class="form-control zip" type="text" placeholder="ZIP">
                                <input class="form-control state" type="text" placeholder="State">
                            </div>
                            <div class=" my-3">
                                <p class="dis fw-bold mb-2">VAT Number</p>
                                <div class="inputWithcheck">
                                    <input class="form-control" type="text" value="GB012345B9">
                                    <span class="fas fa-check"></span>

                                </div>
                            </div>
                            <div class="d-flex flex-column dis">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p>Subtotal</p>
                                    <p><span class="fas fa-dollar-sign"></span>33.00</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p>VAT<span>(20%)</span></p>
                                    <p><span class="fas fa-dollar-sign"></span>2.80</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="fw-bold">Total</p>
                                    <p class="fw-bold"><span class="fas fa-dollar-sign"></span>35.80</p>
                                </div>
                                <div id="submit" class="btn btn-primary mt-2">Pay<span
                                        class="fas fa-dollar-sign px-1"></span>35.80
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Configura o Stripe.js com sua chave pública
    var stripe = Stripe('{{ env('your-stripe-key') }}');
    var elements = stripe.elements();

    // Cria um elemento de cartão
    var card = elements.create('card');

    // Monta o elemento de cartão no div com id 'card-element'
    card.mount('#card-element');

    // Adiciona um listener para tratar a submissão do formulário
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createPaymentMethod('card', card).then(function(result) {
            if (result.error) {
                // Mostra o erro no console ou em algum elemento da página
                console.error(result.error.message);
            } else {
                // Envia o ID do método de pagamento para o servidor
                fetch("{{ route('payment.process') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        payment_method: result.paymentMethod.id
                    })
                }).then(response => response.json()).then(data => {
                    console.log(data);
                });
            }
        });
    });
</script>

</html>
