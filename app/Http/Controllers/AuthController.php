<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Exibe a tela de login.
     */
    public function showLoginForm()
    {
        return view('intranet.login');
    }

    /**
     * Processa a autenticação.
     */
    public function login(Request $request)
    {
        // 1. Validação dos dados
        $credentials = $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Captura o valor do checkbox "Lembrar-me"
        $remember = $request->has('remember');

        // 3. Tentativa de autenticação
        // O Laravel gerencia o 'remember_token' automaticamente se o segundo parâmetro for true
        if (Auth::attempt($credentials, $remember)) {

            // Gera uma nova sessão para evitar fixação de sessão
            $request->session()->regenerate();

            // Redireciona para a página pretendida ou dashboard
            return redirect()->intended('/app');
        }

        // 4. Se falhar, retorna com erro
        throw ValidationException::withMessages([
            'login' => ['As credenciais informadas não correspondem aos nossos registros.'],
        ]);
    }

    /**
     * Log out do sistema.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
