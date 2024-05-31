<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    //Dashboard
    public function listProducts()
    {
        if (request()->ajax()) {
            return DataTables::of(Product::all())
                ->addColumn('action', function ($product) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$product->id.')" data-original-title="Edit" class="edit btn btn-success edit openEditModal" id="openEditModal"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$product->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard/dProducts');
    }
}
