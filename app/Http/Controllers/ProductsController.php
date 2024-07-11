<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    //Dashboard

    public function getProductSubcategories()
    {
        // Consulta para obter as subcategorias e a contagem de produtos
        $data = DB::table('subcategories')
            ->leftJoin('products_subcategories', 'subcategories.id', '=', 'products_subcategories.subcategory_id')
            ->select('subcategories.name', DB::raw('COUNT(products_subcategories.product_id) as product_count'))
            ->groupBy('subcategories.name')
            ->get();

        return response()->json($data);
    }

    public function listProducts()
    {
        if (request()->ajax()) {
            $products = Product::with('subcategories')->get();

            return DataTables::of($products)
                ->addColumn('subcategories', function ($product) {
                    // Assuming you want to show all subcategories related to the product
                    return $product->subcategories->pluck('name')->join(', ');
                })
                ->addColumn('action', function ($product) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$product->id.')" data-original-title="Edit" class="edit btn btn-primary edit openEditModal" id="openEditModal"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$product->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>';
                })
                ->rawColumns(['action', 'subcategories'])
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
            'photo_1' => 'required|string',
            'photo_2' => 'nullable|string',
            'quantity' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id', // Validação para garantir que o subcategory_id exista
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

    public function showOnEdit(Request $request)
    {
        $product = Product::with('subcategories')->findOrFail($request->id);
        $subcategories = Subcategory::all(); // Para enviar todas as subcategorias disponíveis

        return response()->json([
            'product' => $product,
            'subcategories' => $subcategories,
            'selected_subcategory' => $product->subcategories->pluck('id'), // Supondo que um produto pode ter várias subcategorias
        ]);
    }

    public function editProduct(Request $request)
    {
        $id = $request->id;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo_1' => 'nullable|string',
            'photo_2' => 'nullable|string',
            'quantity' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id', // Validação para garantir que o subcategory_id exista
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'photo_1' => $validatedData['photo_1'],
            'photo_2' => $validatedData['photo_2'],
            'quantity' => $validatedData['quantity'],
        ]);

        $product->subcategories()->sync($validatedData['subcategory_id']);

        return response()->json([$product]);
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->delete();

        return response()->json($product);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('store.showproduct', compact('product', 'categories'));
    }


}
