<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    //Dashboard
    public function listProducts()
    {
        if (request()->ajax()) {
            return DataTables::of(Product::all())
                ->addColumn('action', function ($product) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$product->id.')" data-original-title="Edit" class="edit btn btn-primary edit openEditModal" id="openEditModal"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$product->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard/dProducts');
    }

    public function addProduct(Request $request)
    {
        // Validar os dados da requisição, incluindo o subcategory_id
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo_1' => 'nullable|string',
            'photo_2' => 'nullable|string',
            'quantity' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id' // Validação para garantir que o subcategory_id exista
        ]);

        // Criar o produto
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'photo_1' => $validatedData['photo_1'],
            'photo_2' => $validatedData['photo_2'],
            'quantity' => $validatedData['quantity'],
        ]);

        // Inserir na tabela de relação products_subcategories
        $product->subcategories()->attach($validatedData['subcategory_id']);

        return response()->json([$product]);
    }

    public function showOnEdit(Request $request){
        $where = ['id' => $request->id];
        $product = Product::where($where)->first();

        return response()->json($product);
    }
}
