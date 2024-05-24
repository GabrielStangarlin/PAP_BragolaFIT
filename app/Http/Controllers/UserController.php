<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function listUser()
    {
        //Para certificar que nenhum usuário nao admin entre pela rota
        if (Auth::user()->isAdmin != 1) {
            return redirect()->route('site.index')->with('error', 'Somente administradores podem acessar o Dashboard');
        }
        if (request()->ajax()) {
            return DataTables::of(User::all())
                ->addColumn('action', function ($user) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$user->id.')" data-original-title="Edit" class="edit btn btn-success edit openEditModal" id="openEditModal">Edit</a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$user->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard/dbUser');
    }
}
