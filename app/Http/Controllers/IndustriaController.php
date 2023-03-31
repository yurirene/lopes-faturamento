<?php

namespace App\Http\Controllers;

use App\DataTables\IndustriasDatatable;
use App\Models\Industria;
use App\Models\DadosCadastrais;
use App\Models\Nota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IndustriaController extends Controller
{
    public function index(IndustriasDatatable $dataTable)
    {
        return $dataTable->render('industrias.index');
    }

    public function edit(Industria $industria)
    {
        return view('industrias.form', [
            'industria' => $industria
        ]);
    }

    public function update(Industria $industria, Request $request)
    {
        try {

            $industria->update([
                'razao_social' => $request->razao_social,
                'cidade' => $request->cidade,
                'cnpj' => $request->cnpj
            ]);
            return redirect()->route('industrias.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('industrias.edit', $industria)->withInput()->withErrors('Erro ao Realizar Operação!');
        }

    }

    public function create()
    {
        return view('industrias.form');
    }

    public function store(Request $request)
    {
        try {

            Industria::create([
                'razao_social' => $request->razao_social,
                'cidade' => $request->cidade,
                'cnpj' => $request->cnpj,
                'classe' => 'XMLDefaultService'
            ]);
            return redirect()->route('industrias.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->withInput()->withErrors('Erro ao Realizar Operação!');
        }

    }

}
