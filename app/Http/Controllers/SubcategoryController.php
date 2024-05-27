<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    public function listSubcategory()
    {
        if (request()->ajax()) {
            return DataTables::of(Subcategory::all())
                ->addColumn('category_name', function ($subcategory) {
                    return $subcategory->category->name ?? 'N/A';
                })
                ->addColumn('updated_at', function ($subcategory) {
                    return $subcategory->updated_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($subcategory) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$subcategory->id.')" data-original-title="Edit" class="edit btn btn-success edit openEditModal" id="openEditModal"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$subcategory->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard/dSubcategories');
    }
}
