@extends('dashboard.dTemplate')

@section('title', 'Dashboard Category')

@section('dContent')
    <h1 class="text-white">All Categories</h1>
    <a class="btn btn-success gap-2 mb-2 openAddModal" id="openAddModal">
        <ion-icon name="add-circle-outline"></ion-icon>
        Add Category
    </a>

    <table class="table table-striped" id="category-datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
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

                                    <div class="model-footer d-flex mt-1" style="justify-content:flex-end">
                                        <button type="button" id="btn-save" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form class="p-3">
                                    @csrf
                                    <input type="hidden" id="id">

                                    <div class="form-group">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>

                                    <div class="model-footer d-flex mt-1" style="justify-content:flex-end">
                                        <button type="button" id="btn-save-edit" class="btn btn-primary">Save</button>
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
        $(document).on('click', '.openAddModal', function() {
            $('#nameAdd').val('');

            $('#addCategoryModal').modal('show');
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        let table = $('#category-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/db/list/category",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
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

        let addModal = $('#addCategoryModal');

        $(document).on('click', '#btn-save', function() {
            var name = addModal.find('#nameAdd').val();

            $.ajax({
                type: 'POST',
                url: "/category/add",
                data: {
                    name: name
                },
                dataType: 'json',
                success: (data) => {
                    addModal.modal('hide');
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    table.ajax.reload();
                }
            });
        });

        let editModal = $('#editCategoryModal');

        function editFunc(id) {
            $.ajax({
                type: 'POST',
                url: "/category/informations/edit",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    editModal.find('#id').val(res.id);
                    editModal.find('#name').val(res.name);

                    editModal.modal('show');
                }
            });
        }

        $(document).on('click', '#btn-save-edit', function() {
            var id = editModal.find('#id').val();
            var name = editModal.find('#name').val();

            $.ajax({
                type: 'POST',
                url: "/category/edit",
                data: {
                    id: id,
                    name: name
                },
                dataType: 'json',
                success: (data) => {
                    editModal.modal('hide');
                    $("#btn-save-edit").html('Submit');
                    $("#btn-save-edit").attr("disabled", false);
                    table.ajax.reload();
                }
            });
        });

        function deleteFunction(id) {
            if (confirm("Do you really want do delete?") == true) {
                var id = id;
                $.ajax({
                    type: "POST",
                    url: "/category/delete",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        table.ajax.reload();
                    }
                });
            }
        }
    </script>
@endsection
