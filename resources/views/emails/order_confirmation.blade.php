<!DOCTYPE html>
<html>

<head>
    <title>Confirmação de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* Centralizar todo o conteúdo */
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 150px;
            /* Ajuste o tamanho conforme necessário */
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid #dddddd;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="email-container">
        {{-- <img src="{{ asset('img(s)/Bragola-Logo.png') }}" class="logo"> --}}
        <h5>BRAGOLA FIT</h5>
        <h1>Olá, {{ $notifiable->name }}!</h1>
        <p>Obrigado pela sua compra na nossa loja.</p>
        <p>Aqui estão os detalhes da sua compra:</p>
        <p>Encomenda número: {{ $order->id }}</p>

        <h3>Detalhes dos Produtos</h3>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>€ {{ number_format($product->price, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Preço total: € {{ number_format($total, 2, ',', '.') }}</p>
        <p>Obrigado por comprar connosco!</p>
        <p>Atenciosamente, Equipe da Loja</p>
    </div>
</body>

</html>
