<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function register(Request $request, User $user){
        //Validation
        $validator = $request->validate([
            'razaoSocial' => ['required', 'max:255', Rule::unique('users', 'razaoSocial')],
            'cnpj' => ['required', 'max:255', Rule::unique('users', 'cnpj')],
            'email' => ['required', 'max:255', Rule::unique('users', 'email')],
            'senha' => ['required', 'same:senhaConfirm']
        ]);

        if(Auth::check()){
            return back()->withErrors(['login' => 'O usuário já está logado!']);
        }

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $user = $user->create($request->all());

        if (!$user) {
            return back()->withErrors(['register' => 'Ocorreu um erro ao criar o usuário!']);
        }

        if (Auth::attempt($validator)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors(['register' => 'Ocorreu um erro ao se registrar!']);

    }
}
