@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Orders')

@section('dContent')
    <h1>Orders</h1>

    <table class="table table-striped" id="order-datatable">
        <thead>
            <tr>
                <th>Name (User)</th>
                <th>Address</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-center">
        </tbody>
    </table>

    <div class="modal fade" id="showOrderModal" tabindex="-1" aria-labelledby="showOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showOrderModalLabel">Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        let table = $('#order-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/db/list/order",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'ship_address',
                    name: 'ship_address'
                },
                {
                    data: 'order_status',
                    name: 'order_status'
                },
                {
                    data: 'options',
                    name: 'options',
                    orderable: false
                }
            ],
            order: [
                [0, 'desc']
            ]
        });

        function showFunction(id) {
            $.ajax({
                type: 'POST',
                url: "/order/information/get",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(order) {
                    let modalBody = $('.modal-body');
                    modalBody.empty(); // Limpar o conteúdo do modal

                    let totalValue = 0;

                    // Função para formatar valores
                    let formatCurrency = function(value) {
                        return new Intl.NumberFormat('de-DE', {
                            style: 'currency',
                            currency: 'EUR'
                        }).format(value);
                    };

                    modalBody.append(`
                        <div class="order-address">
                            <h5>Shipping Address:</h5>
                            <p>${order.ship_address}</p>
                        </div>
                        <hr>
                    `);

                    order.order_products.forEach(function(orderProduct) {
                        let product = orderProduct.products;
                        let productValue = orderProduct.value * orderProduct.quantity;
                        totalValue += productValue;

                        // Formatação dos valores dos produtos
                        let formattedProductValue = formatCurrency(orderProduct.value);
                        let formattedTotalProductValue = formatCurrency(productValue);

                        modalBody.append(`
                            <div class="order-item">
                                <h5>${product.name}</h5>
                                <p>Value: ${formattedProductValue}</p>
                                <p>Quantity: ${orderProduct.quantity}</p>
                                <p>Total: ${formattedTotalProductValue}</p>
                            </div>
                            <hr>
                        `);
                    });

                    let formattedTotalValue = formatCurrency(totalValue);

                    modalBody.append(`<h4>Total Order Value: ${formattedTotalValue}</h4>`);
                    $('#showOrderModal').modal('show');
                }
            });
        }

        function updateFunction(orderId, orderStatus) {
            let currentStatus = '';
            let nextStatus = '';

            switch (orderStatus) {
                case 0:
                    currentStatus = 'Em processamento';
                    nextStatus = 'Enviado';
                    break;
                case 1:
                    currentStatus = 'Enviado';
                    nextStatus = 'Recebido';
                    break;
                case 2:
                    currentStatus = 'Recebido';
                    nextStatus = 'Excluir encomenda';
                    break;
            }

            Swal.fire({
                title: 'Confirmação',
                text: `Quer atualizar o estado de "${currentStatus}" para "${nextStatus}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, atualizar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/order/update',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: orderId,
                            current_status: orderStatus
                        },
                        success: function(response) {
                            Swal.fire(
                                'Atualizado!',
                                'O estado da encomenda foi atualizado.',
                                'success'
                            );
                            // Atualize a tabela
                            table.ajax.reload();
                        },
                        error: function(response) {
                            Swal.fire(
                                'Erro!',
                                'Ocorreu um erro ao atualizar o estado da encomenda.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
