<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function listCategory()
    {
        if (request()->ajax()) {
            return datatables::of(Category::all())
                ->addColumn('action', function ($category) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$category->id.')" data-original-title="Edit" class="edit btn btn-success edit openEditModal" id="openEditModal"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$category->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>';
                })
                ->editColumn('updated_at', function ($category) {
                    return Carbon::parse($category->updated_at)->format('d/m/Y H:i:s');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard/dCategories');
    }

    public function addCategory(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json($category);
    }

    public function showInformation(Request $request)
    {
        $where = ['id' => $request->id];
        $category = Category::where($where)->first();

        return response()->json($category);
    }

    public function editCategory(Request $request)
    {
        $category = Category::find($request->id);

        // Verifica se a categoria foi encontrada
        if (! $category) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        }

        // Atualiza o nome da categoria
        $category->name = $request->name;
        $category->save();

        return response()->json($category);
    }

    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->delete();

        return response()->json($category);
    }

    public function getCategoryToSelect()
    {
        $categories = Category::all();

        return response()->json($categories);
    }
}
