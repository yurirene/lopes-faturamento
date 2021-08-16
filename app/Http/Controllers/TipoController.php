<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function index()
    {
        return view('tipo.index', [
            'tipos' => Tipo::all()
        ]);
    }

    public function create()
    {
        return view('tipo.form');
    }

    public function edit(Tipo $tipo)
    {
        return view('tipo.form', [
            'tipo' => $tipo
        ]);
    }

    public function store(Request $request)
    {
        try {
            Tipo::create([
                'titulo' => $request->titulo
            ]);
            return redirect()->route('tipos.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('tipos.index')->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function update(Tipo $tipo, Request $request)
    {
        try {
            $tipo->update([
                'titulo' => $request->titulo
            ]);
            return redirect()->route('tipos.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('tipos.index')->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function delete(Tipo $tipo)
    {
        try {
            $tipo->delete();
            return redirect()->route('tipos.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('tipos.index')->withErrors('Erro ao Realizar Operação!');
        }
    }
}
