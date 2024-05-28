@extends('dashboard.dTemplate')

@section('title', 'Dashboard Subcategory')

@section('dContent')

    <h1 class="text-white">All Subcategories</h1>
    <a class="btn btn-success gap-2 mb-2 openAddModal" id="openAddModal">
        <ion-icon name="add-circle-outline"></ion-icon>
        Add Subcategory
    </a>

    <table class="table table-striped" id="subcategory-datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Main category</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subcategory</h1>
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
                                        <label for="categorySelect" class="form-label">Categories</label>
                                        <select class="form-select" name="categorySelect" id="categorySelectAdd"></select>
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
                loadCategories('#editSubcategoryModal #categorySelect');
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
            var id = addModal.find('')
            var name = addModal.find('#nameAdd').val();

            $.ajax({
                type: 'POST',
                url: "/subcategory/add",
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
    </script>

@endsection
