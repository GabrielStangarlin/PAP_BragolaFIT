@extends('dashboard.dTemplate')

@section('title', 'Dashboard | Orders')

@section('dContent')
    <h1>Orders</h1>

    <table class="table table-striped" id="order-datatable">
        <thead>
            <tr>
                <th>Name (User)</th>
                <th>Value</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="text-center">
        </tbody>
    </table>
@endsection
