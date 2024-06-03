@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Product')

@section('dContent')

    <h1>All Products</h1>
    <a class="btn btn-success gap-2 mb-2 openAddModal" id="openAddModal">
        <ion-icon name="add-circle-outline"></ion-icon>
        Add Product
    </a>

    <table class="table" id="product-datatable">
        <thead>
            <tr>
                <th>Photo_1</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        let table = $('#product-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/db/list/product",
            columns: [{
                    data: 'photo_1',
                    name: 'photo_1',
                    orderable: false,
                    render: function(data, type, row) {
                        return '<img src="' + data + '" alt="Photo" style="max-width:60px;height:auto;"/>';
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ],
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
