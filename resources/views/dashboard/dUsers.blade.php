@extends('dashboard.dTemplate')

@section('title', 'Dashboard Products')

@section('dContent')
    <h1>All Users</h1>

    <a class="btn btn-primary gap-2 mb-2 openAddModal" id="openAddModal">
        <ion-icon name="add-circle-outline"></ion-icon>
        Adicionar Users
    </a>

    <table class="table table-striped" id="user-datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>E-mail</th>
                <th>Admin</th>
                <th>Vat-Number</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="text-center">
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

        let table = $('#user-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/db/list/user",
            columns: [{
                data: 'name',
                name: 'name'
            }, ]
        });
    </script>
@endsection
