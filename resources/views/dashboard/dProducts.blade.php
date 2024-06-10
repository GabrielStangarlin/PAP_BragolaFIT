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

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form class="p-3">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" id="nameAdd" name="nameAdd" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="form-label">Descrição:</label>
                                        <input type="text" id="descriptionAdd" name="descriptionAdd"
                                            class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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

        $(document).on('click', '.openAddModal', function() {
            $('#nameAdd').val('');

            $('#addModal').modal('show');
        });
    </script>
@endsection
