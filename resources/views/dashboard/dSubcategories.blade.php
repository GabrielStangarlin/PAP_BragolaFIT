@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Subcategory')

@section('dContent')

    <h1>Subcategorias</h1>
    <a class="btn btn-success gap-2 mb-2 openAddModal" id="openAddModal">
        <ion-icon name="add-circle-outline"></ion-icon>
        Adicionar Subcategoria
    </a>

    <table class="table table-striped" id="subcategory-datatable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria Pai</th>
                <th>Atualizado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Subcategoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form class="p-3">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nome:</label>
                                        <input type="text" id="nameAdd" name="nameAdd" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="categorySelect" class="form-label">Categoria:</label>
                                        <select class="form-select" name="category_id" id="categorySelectAdd">
                                            <option value="" selected disabled>Selecione uma categoria</option>
                                        </select>
                                    </div>

                                    <div class="model-footer d-flex mt-1" style="justify-content:flex-end">
                                        <button type="button" id="btn-save" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSubcategoryModalLabel">Editar Subcategoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form class="p-3" id="editSubcategoryForm">
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="form-group">
                                        <label for="nameEdit" class="form-label">Nome:</label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="categorySelect" class="form-label">Categoria:</label>
                                        <select class="form-select" name="category_id" id="categorySelectEdit" required>
                                            <option value="" selected disabled>Selecione uma categoria</option>
                                        </select>
                                    </div>

                                    <div class="model-footer d-flex mt-1" style="justify-content:flex-end">
                                        <button type="button" id="btn-update" class="btn btn-primary">Atualizar</button>
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

        $(document).on('click', '.openAddModal', function() {
            $('#nameAdd').val('');

            $('#addSubcategoryModal').modal('show');
        });

        $(document).ready(function() {
            // Function to load categories into a select element
            function loadCategories(selectElementId) {
                $.ajax({
                    url: '/categories/all/select',
                    method: 'GET',
                    success: function(response) {
                        var categorySelect = $(selectElementId);
                        categorySelect.empty(); // Clear any existing options
                        categorySelect.append(
                            '<option value="" selected disabled>Selecione uma categoria</option>'
                        ); // Add default option
                        response.forEach(function(category) {
                            categorySelect.append(new Option(category.name, category.id));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred:', error);
                    }
                });
            }

            // Trigger when the add subcategory modal is shown
            $('#addSubcategoryModal').on('shown.bs.modal', function() {
                loadCategories('#addSubcategoryModal #categorySelectAdd');
            });

            // Trigger when the edit subcategory modal is shown
            $('#editSubcategoryModal').on('shown.bs.modal', function() {
                loadCategories('#editSubcategoryModal #categorySelectEdit');
            });
        });

        let table = $('#subcategory-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/db/list/subcategory",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        let addModal = $('#addSubcategoryModal');

        $(document).on('click', '#btn-save', function() {
            var name = $('#addSubcategoryModal').find('#nameAdd').val();
            var category_id = $('#addSubcategoryModal').find('#categorySelectAdd').val();

            $.ajax({
                type: 'POST',
                url: "/subcategory/add",
                data: {
                    name: name,
                    category_id: category_id
                },
                dataType: 'json',
                success: (data) => {
                    $('#addSubcategoryModal').modal('toggle');
                    table.ajax.reload();
                    Swal.fire({
                        icon: "success",
                        title: "Subcategoria Adicionado(a)!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        let editModal = $('#editSubcategoryModal');

        function editFunc(id) {
            $.ajax({
                type: 'POST',
                url: "/subcategory/informations/edit",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#editSubcategoryModal').find('#id').val(res.id);
                    $('#editSubcategoryModal').find('#name').val(res.name);

                    $('#editSubcategoryModal').modal('show');
                }
            });
        }

        $(document).on('click', '#btn-update', function() {
            var id = $('#editSubcategoryModal').find('#id').val();
            var name = $('#editSubcategoryModal').find('#name').val();
            var category_id = $('#editSubcategoryModal').find('#categorySelectEdit').val();

            // Frontend validation to check if category is selected
            if (category_id === null || category_id === "") {
                alert('Por favor, selecione uma categoria.');
                return; // Stop the function if validation fails
            }

            $.ajax({
                type: 'POST',
                url: "/subcategory/update",
                data: {
                    id: id,
                    name: name,
                    category_id: category_id,
                },
                dataType: 'json',
                success: function(data) {
                    $('#editSubcategoryModal').modal('toggle');
                    table.ajax.reload();
                    Swal.fire({
                        icon: "success",
                        title: "Subcategoria Editado(a)!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', error);
                }
            });
        });

        function deleteFunction(id) {
            if (confirm("Do you really want do delete?") == true) {
                var id = id;
                $.ajax({
                    type: "POST",
                    url: "/subcategory/delete",
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
