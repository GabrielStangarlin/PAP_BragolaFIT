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

    <script>
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
                    name: 'options'
                }
            ],
            order: [
                [0, 'desc']
            ]
        });

        function showfunction(id) {

        }
    </script>
@endsection
