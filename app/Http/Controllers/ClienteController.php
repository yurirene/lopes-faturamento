<?php

namespace App\Http\Controllers;

use App\DataTables\ClientesDatatable;
use App\DataTables\ItensDatatable;
use App\DataTables\NotasDatatable;
use App\Imports\DadosCadastraisImport;
use App\Models\Cliente;
use App\Models\DadosCadastrais;
use App\Models\Industria;
use App\Models\Nota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    public function index(ClientesDatatable $dataTable)
    {
        return $dataTable->render('clientes.index');
    }

    public function create()
    {
        return view('clientes.form');
    }

    public function store(Request $request)
    {
        try {
            Cliente::create([
                'cnpj' => $request->cnpj,
                'razao_social' => $request->razao_social,
                'endereco' => $request->endereco,
                'cidade' => $request->cidade,
                'uf' => $request->uf
            ]);
            return redirect()->route('clientes.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors('Erro ao Realizar Operação!');
        }
        
    }


    public function edit(Cliente $cliente)
    {
        return view('clientes.form', [
            'cliente' => $cliente
        ]);
    }

    public function update(Cliente $cliente, Request $request)
    {
        try {
            $cliente->update([
                'cnpj' => $request->cnpj,
                'razao_social' => $request->razao_social,
                'endereco' => $request->endereco,
                'cidade' => $request->cidade,
                'uf' => $request->uf
            ]);
            return redirect()->route('clientes.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('clientes.edit', $cliente)->withInput()->withErrors('Erro ao Realizar Operação!');
        }
        
    }
    
}
