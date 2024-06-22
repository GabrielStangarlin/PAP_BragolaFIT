<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    //site
    public function updateProfile(Request $request)
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica se $user é uma instância válida de User
        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'User authentication failed.');
        }

        // Atualiza os dados do usuário
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->vat_number = $request->input('vat_number');

        // Apenas atualize a senha se um novo valor foi fornecido
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.profile')->with('success','Profile updated successfully.');
    }





    //dashboard:
    public function listUser()
    {
        //Para certificar que nenhum usuário nao admin entre pela rota

        if (request()->ajax()) {
            return datatables::of(User::all())
                ->addColumn('action', function ($user) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc('.$user->id.')" data-original-title="Edit" class="edit btn btn-success edit openEditModal" id="openEditModal"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="javascript:void(0);" id="delete-company" onClick="deleteFunction('.$user->id.')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>';
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

    public function editUser(Request $request)
    {
        $user = User::find($request->id);

        // Verifica se a categoria foi encontrada
        if (! $user) {
            return response()->json(['error' => 'User não encontrado.'], 404);
        }

        // Atualiza o nome da categoria
        $user->name = $request->name;
        $user->save();

        return response()->json($user);
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->delete();

        return response()->json($user);
    }
}
