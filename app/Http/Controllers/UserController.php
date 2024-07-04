<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        $wishlist = Wishlist::where('user_id', Auth::id())->first();
        $products = $wishlist ? $wishlist->products : [];
        $orders = Order::with('orderProducts.products')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('profile.profile', compact('user', 'products', 'orders'));
    }

    //site
    public function updateProfile(Request $request)
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica se $user é uma instância válida de User
        if (! $user instanceof User) {
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

        return redirect()->route('profile.profile')->with('success', 'Profile updated successfully.');
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
                ->editColumn('isAdmin', function ($user) {
                    if ($user->isAdmin == 0) {
                        return 'User';
                    } else {
                        return 'Admin';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard/dUsers');
    }

    public function addUser(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'vat_number' => 'nullable|string|max:50',
            'isAdmin' => 'boolean',
        ]);

        // Criação do usuário apenas se os dados forem validados corretamente
        $user = User::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'vat_number' => $validatedData['vat_number'],
            'isAdmin' => $validatedData['isAdmin'] ?? false, // Se não for especificado, assume false
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
        // Busca o usuário pelo ID
        $user = User::find($request->id);

        // Verifica se o usuário foi encontrado
        if (! $user) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        // Validação dos dados recebidos (opcional, dependendo dos requisitos do sistema)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:10',
            'email' => 'required|string|email',
            'password' => 'sometimes|string|min:6',
            'vat_number' => 'nullable|string|max:10',
            'isAdmin' => 'required',
        ]);

        $user->name = $validatedData['name'];
        $user->address = $validatedData['address'] ?? $user->address;
        $user->phone = $validatedData['phone'] ?? $user->phone;
        $user->email = $validatedData['email'];
        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->vat_number = $validatedData['vat_number'] ?? $user->vat_number;
        $user->isAdmin = $validatedData['isAdmin'] ?? $user->isAdmin;
        $user->save();

        return response()->json($user);
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->delete();

        return response()->json($user);
    }
}
