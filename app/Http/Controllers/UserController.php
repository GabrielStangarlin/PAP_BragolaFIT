<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //login mario
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back()->with('success', 'Sessão terminada com sucesso');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
        return redirect('/login')->with('success', 'Register successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->loginEmail,
            'password' => $request->loginPassword,
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->isAdmin == 1) {
                return redirect('/db')->with('success', 'Usuário Administrador Logado');
            }
            return redirect('/store')->with('success', 'Usuário Logado');
        }

        return redirect()->back()->with('error', 'Email ou Senha Errados');
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
