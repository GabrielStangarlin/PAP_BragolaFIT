<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email, // Corrigido para capturar o campo 'email'
            'password' => $request->password, // Corrigido para capturar o campo 'password'
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->isAdmin == 1) {
                return redirect('/db')->with('success', 'Usuário Administrador Logado');
            }

            return redirect('/store')->with('success', 'Utilizador logado com sucesso');
        }

        return redirect()->back()->with('error', 'Email ou Senha Errados');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/store')->with('success', 'Sessão terminada com sucesso');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
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

        Auth::login($user);

        return redirect('/store')->with('success', 'utilizador criado com sucesso');
    }
}
