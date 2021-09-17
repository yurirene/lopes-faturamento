<?php

namespace App\Http\Controllers;

use App\DataTables\DadosCadastraisDatatable;
use App\Imports\DadosCadastraisImport;
use App\Models\DadosCadastrais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DadosCadastraisController extends Controller
{
    public function index(DadosCadastraisDatatable $dataTable)
    {
        return $dataTable->render('dados-cadastrais.index');
    }
    public function importar()
    {
        return view('dados-cadastrais.form');
    }
    public function importarPlanilha(Request $request)
    {
        try {
            DadosCadastrais::truncate();
            $arquivo = request()->file('arquivo');
            Excel::import(new DadosCadastraisImport, $arquivo);
            return redirect()->route('dados-cadastrais.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('dados-cadastrais.importar')->withErrors('Erro ao Realizar Operação!');
        }
        
    }
}
