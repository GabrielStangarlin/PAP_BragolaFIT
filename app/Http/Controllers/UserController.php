<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //dashboard:
    public function listUser()
    {
        //Para certificar que nenhum usuário nao admin entre pela rota

        if (request()->ajax()) {
            return datatables::of(User::all())
                ->addColumn('action', function ($user) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$user->id.')" data-original-title="Edit" class="edit btn btn-success edit openEditModal" id="openEditModal">Edit</a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$user->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard/dUsers');
    }

    public function addUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'vat_number' => $request->vat_number,
            'isAdmin' => $request->isAdmin,
        ]);

        return response()->json($user);
    }

    public function showInformation(Request $request)
    {
        $where = ['id' => $request->id];
        $user = User::where($where)->first();

        return response()->json($user);
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->delete();

        return response()->json($user);
    }
}
