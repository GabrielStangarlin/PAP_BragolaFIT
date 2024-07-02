@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Users')

@section('dContent')
    <h1>All Users</h1>

    <a class="btn btn-success gap-2 mb-2 openAddModal" id="openAddModal">
        <ion-icon name="add-circle-outline"></ion-icon>
        Add Users
    </a>

    <table class="table table-striped" id="user-datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Vat-Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
        </tbody>
    </table>


    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Users</h1>
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
                                        <input type="text" id="nameAdd" name="name" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="form-label">Address:</label>
                                        <input type="text" id="addressAdd" name="address" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone:</label>
                                        <input type="number" id="phoneAdd" name="phone" class="form-control"
                                            maxlength="10">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">Vat number</label>
                                        <input type="number" id="vat_numberAdd" name="vat_numberAdd" class="form-control"
                                            maxlength="10">
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" id="emailAdd" name="email" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">Password:</label>
                                        <input type="password" id="passwordAdd" name="password" class="form-control">
                                    </div>

                                    <div class="form-group mt-1">
                                        <label for="isAdmin" class="form-check-label">Admin:</label>
                                        <input type="checkbox" class="form-check-input" id="isAdminAdd"
                                            style="margin-left: 2px;">
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

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelleby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="p-3">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" id="address" name="address" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="number" id="phone" name="phone" class="form-control" maxlength="10">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Vat number</label>
                            <input type="number" id="vat_number" name="vat_number" class="form-control"
                                maxlength="10">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="form-group mt-1">
                            <label for="isAdmin" class="form-label">Admin:</label>
                            <input type="checkbox" class="form-check-input" id="isAdmin">
                        </div>

                        <div class="model-footer d-flex mt-1" style="justify-content:flex-end">
                            <button type="button" id="btn-save-edit" class="btn btn-primary">Save</button>
                        </div>



                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).on('click', '.openAddModal', function() {
            $('#addUserModal').modal('toggle');
            $('#nameAdd').val('');
            $('#addresAdd').val('');
            $('#phoneAdd').val('');
            $('#vat_numberAdd').val('');
            $('#emailAdd').val('');
            $('#passwordAdd').val('');
            $('#adminAdd').val('');
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        let table = $('#user-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/db/list/user",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'isAdmin',
                    name: 'isAdmin'
                },
                {
                    data: 'vat_number',
                    name: 'vat_number'
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

        $(document).on('click', '#btn-save', function() {

            var name = $('#addUserModal').find('#nameAdd').val();
            var address = $('#addUserModal').find('#addressAdd').val();
            var email = $('#addUserModal').find('#emailAdd').val();
            var phone = $('#addUserModal').find('#phoneAdd').val();
            var password = $('#addUserModal').find('#passwordAdd').val();
            var vat_number = $('#addUserModal').find('#vat_numberAdd').val();
            var isAdmin = $('#addUserModal').find('#isAdminAdd').is(':checked') ? 1 : 0;

            $.ajax({
                type: 'POST',
                url: "/user/add",
                data: {
                    name: name,
                    address: address,
                    email: email,
                    phone: phone,
                    password: password,
                    vat_number: vat_number,
                    isAdmin: isAdmin
                },
                dataType: 'json',
                success: (data) => {
                    $('#addUserModal').modal('toggle');
                    table.ajax.reload();
                    Swal.fire({
                        icon: "success",
                        title: "User Adicionado!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "/user/informations/edit",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {

                    $('#editUserModal').find('#id').val(res.id);
                    $('#editUserModal').find('#name').val(res.name);
                    $('#editUserModal').find('#phone').val(res.phone);
                    $('#editUserModal').find('#address').val(res.address);
                    $('#editUserModal').find('#vat_number').val(res.vat_number);
                    $('#editUserModal').find('#email').val(res.email);
                    $('#editUserModal').find('#isAdmin').prop('checked', res.isAdmin == 1);

                    $('#editUserModal').modal('toggle');

                }
            });
        }

        $(document).on('click', '#btn-save-edit', function() {
            var id = $('#editUserModal').find('#id').val();
            var name = $('#editUserModal').find('#name').val();
            var address = $('#editUserModal').find('#address').val();
            var email = $('#editUserModal').find('#email').val();
            var phone = $('#editUserModal').find('#phone').val();
            var password = $('#editUserModal').find('#password').val();
            var vat_number = $('#editUserModal').find('#vat_number').val();
            var isAdmin = $('#editUserModal').find('#isAdmin').is(':checked') ? 1 : 0;

            $.ajax({
                type: 'POST',
                url: "/user/edit",
                data: {
                    id: id,
                    name: name,
                    address: address,
                    email: email,
                    phone: phone,
                    password: password,
                    vat_number: vat_number,
                    isAdmin: isAdmin
                },
                dataType: 'json',
                success: (data) => {
                    $('#editUserModal').modal('toggle');
                    table.ajax.reload();
                    Swal.fire({
                        icon: "success",
                        title: "User Editado!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        function deleteFunction(id) {
            // Exibe um SweetAlert de confirmação
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você não será capaz de reverter isso!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Se confirmado, faz a requisição AJAX para deletar o produto
                    $.ajax({
                        url: '/user/delete', // Substitua pela URL do seu controller
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            // Se a requisição foi bem sucedida, exibe um SweetAlert de sucesso
                            Swal.fire(
                                'Deletado!',
                                'O User foi deletado com sucesso.',
                                'success'
                            ).then(() => {
                                // Atualize a página ou faça outra ação necessária após deletar
                                location.reload(); // Exemplo: recarregar a página
                            });
                        },
                        error: function(xhr, status, error) {
                            // Se houver um erro na requisição, exibe um SweetAlert de erro
                            Swal.fire(
                                'Erro!',
                                'Ocorreu um erro ao deletar o produto.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
