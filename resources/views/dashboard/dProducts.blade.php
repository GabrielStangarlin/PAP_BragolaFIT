@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Produto')

@section('dContent')

    <h1>Produtos</h1>
    <a class="btn btn-success gap-2 mb-2 openAddModal" id="openAddModal">
        <i class="fa-solid fa-plus"></i>
        Produto
    </a>

    <table class="table" id="product-datatable">
        <thead>
            <tr>
                <th>1º Foto</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Subcategoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Produto</h1>
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
                                        <label for="description" class="form-label">Descrição:</label>
                                        <input type="text" id="descriptionAdd" name="descriptionAdd"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="form-label">Preço:</label>
                                        <input type="number" id="priceAdd" name="priceAdd" step="0.01" min="0.01"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity" class="form-label">Quantidade:</label>
                                        <input type="number" id="quantityAdd" name="quantityAdd" step="1"
                                            min="0" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="subcategorySelect" class="form-label">Subcategoria:</label>
                                        <select class="form-select" name="subcategory_id" id="subcategorySelectAdd"
                                            multiple="multiple">
                                            <option value="" style="color: lightgray;" selected disabled>
                                                Selecione uma subcategoria</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="photo_1" class="form-label">1ºFoto:</label>
                                        <input type="text" id="photo1Add" name="photo1Add" class="form-control">
                                    </div>

                                    <img id="imagePreview" class="rounded img-fluid"
                                        style="margin-top: 10px; display: none;" alt="Image Preview">

                                    <div class="form-group">
                                        <label for="photo_2" class="form-label">2ºfoto (opcional):</label>
                                        <input type="text" id="photo2Add" name="photo2Add" class="form-control">
                                    </div>

                                    <img id="imagePreview2" class="rounded img-fluid"
                                        style="margin-top: 10px; display: none;" alt="Image Preview2">

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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form class="p-3">
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nome:</label>
                                        <input type="text" id="nameEdit" name="nameEdit" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="form-label">Descrição:</label>
                                        <input type="text" id="descriptionEdit" name="descriptionEdit"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="form-label">Preço:</label>
                                        <input type="number" id="priceEdit" name="priceEdit" step="0.01"
                                            min="0.01" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity" class="form-label">Quantidade:</label>
                                        <input type="number" id="quantityEdit" name="quantityEdit" step="1"
                                            min="0" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="subcategorySelect" class="form-label">Subcategoria:</label>
                                        <select class="form-select" name="subcategory_id" id="subcategorySelectEdit"
                                            multiple="multiple">
                                            <option value="" style="color: lightgray;" selected disabled>
                                                Selecione uma subcategoria</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="photo_1" class="form-label">1ºFoto:</label>
                                        <input type="text" id="photo1Edit" name="photo1Edit" class="form-control">
                                    </div>

                                    <img id="imagePreview" class="rounded img-fluid"
                                        style="margin-top: 10px; display: none;" alt="Image Preview">

                                    <div class="form-group">
                                        <label for="photo_2" class="form-label">2ºFoto (opcional):</label>
                                        <input type="text" id="photo2Edit" name="photo2Edit" class="form-control">
                                    </div>

                                    <img id="imagePreview2" class="rounded img-fluid"
                                        style="margin-top: 10px; display: none;" alt="Image Preview2">

                                    <div class="model-footer d-flex mt-1" style="justify-content:flex-end">
                                        <button type="button" id="btn-update" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/js/products.js"></script>
@endsection
