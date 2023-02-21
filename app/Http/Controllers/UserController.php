<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            'password' => ['required', 'same:senhaConfirm']
        ]);

        $rememberMe = $request->input('rememberMe')  == 'on' ? true : false;

        if(Auth::check()){
            return back()->withErrors(['login' => 'O usuário já está logado!']);
        }

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $userC = $user->create($request->all());

        if (!$userC) {
            return back()->withErrors(['register' => 'Ocorreu um erro ao criar o usuário!']);
        }

        //TODO: Pegar as informações do usuário do BD
        if (Auth::attempt($validator, $rememberMe)) {
            $request->session()->regenerate();
            $request->session()->put('user', [
                'cnpj' => $request->input('cnpj'),
                'razaoSocial' => $request->input('razaoSocial'),
                'email' => $request->input('email')
            ]);
            return redirect()->intended('/');
        }

        return back()->withErrors(['register' => 'Ocorreu um erro ao se registrar!']);

    }

    public function login(Request $request, User $user)
    {
        //Validation
        $validator = $request->validate([
            'cnpj' => ['required', 'max:255'],
            'password' => ['required']
        ]);

        $rememberMe = $request->input('rememberMe')  == 'on' ? true : false;

        if (Auth::check()) {
            return back()->withErrors(['login' => 'O usuário já está logado!']);
        }

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        //TODO: Pegar as informações do usuário do BD
        if (Auth::attempt($validator, $rememberMe)) {
            $request->session()->regenerate();
            $request->session()->put('user', [
                'cnpj' => $request->input('cnpj'),
            ]);
            return redirect()->intended('/');
        }

        return back()->withErrors(['login' => 'Ocorreu um erro ao se logar!']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect('/pag/register');
    }

    public function resetPass(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function newPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('home
            2706')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
