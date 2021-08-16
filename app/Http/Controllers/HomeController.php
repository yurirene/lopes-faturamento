<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function trocarSenha()
    {
        return view('trocar-senha');
    }

    public function alterarSenha(Request $request)
    {
        $usuario = Auth::user();
        if (!Hash::check($request->senha_antiga, $usuario->password)) {
            return redirect()->back()->withErrors('Senha Antiga Incorreta');
        }
        try {
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return redirect()->route('trocar-senha')->with(['mensagem' => 'Senha Atualizada com Sucesso']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Erro ao Realizar Operação');
        }
    }
}
