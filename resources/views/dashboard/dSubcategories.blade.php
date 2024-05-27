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
                <th>Category</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
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
    </script>

@endsection
