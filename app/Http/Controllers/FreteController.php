<?php

namespace App\Http\Controllers;

use App\DataTables\FretesDatatable;
use App\Models\Frete;
use Illuminate\Http\Request;

class FreteController extends Controller
{
    public function index(FretesDatatable $dataTable)
    {
        return $dataTable->render('fretes.index');
    }

    public function create()
    {
        return view('fretes.form');
    }
    
    public function store(Request $request)
    {
        try {
            Frete::create([
                'nome' => $request->nome,
                'fator' => $request->fator,
                'codigo' => $request->codigo
            ]);
            return redirect()->route('fretes.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function edit(Frete $frete)
    {
        return view('fretes.form', [
            'frete' => $frete
        ]);
    }

    public function update(Frete $frete, Request $request)
    {
        try {
            $frete->update([
                'nome' => $request->nome,
                'fator' => $request->fator,
                'codigo' => $request->codigo
            ]);
            return redirect()->route('fretes.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function delete(Frete $frete)
    {
        try {
            $frete->delete();
            return redirect()->route('fretes.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors('Erro ao Realizar Operação!');
        }
    }
}
