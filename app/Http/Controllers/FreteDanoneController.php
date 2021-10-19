<?php

namespace App\Http\Controllers;

use App\FreteDanone;
use Illuminate\Http\Request;

class FreteDanoneController extends Controller
{
    public function index()
    {
        return view('fretes.frete-danone', [
            'frete' => FreteDanone::first()
        ]);
    }

    public function salvar(FreteDanone $frete, Request $request)
    {
        try {
            $frete->update([
                'fator' => $request->fator
            ]);
            return redirect()->route('frete-danone.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Erro ao Realizar Operação!');
        }
    }
}
