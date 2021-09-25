<?php

namespace App\Http\Controllers;

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

class NotasController extends Controller
{
    public function index(NotasDatatable $dataTable)
    {
        $industrias = Industria::all()->pluck('razao_social', 'id');
        $clientes = Cliente::all()->pluck('razao_social', 'id');
        return $dataTable->render('notas.index', [
            'industrias' => $industrias,
            'clientes' => $clientes
        ]);
    }

    public function itens(ItensDatatable $dataTable, Nota $nota)
    {
        return $dataTable->render('notas.itens', [
            'nota' => $nota
        ]);
    }

    public function edit(Nota $nota)
    {
        return view('notas.form', [
            'nota' => $nota
        ]);
    }

    public function update(Nota $nota, Request $request)
    {
        try {
            $nota->update([
                'pedido_cliente' => $request->pedido_cliente,
                'cte' => $request->cte,
                'chegada' => $request->chegada ? Carbon::createFromFormat('d/m/Y', $request->chegada)->format('Y-m-d') : null,
                'chegada_porto' => $request->chegada_porto ? Carbon::createFromFormat('d/m/Y', $request->chegada_porto)->format('Y-m-d') : null,
                'placa' => $request->placa,
                'transportadora' => $request->transportadora,
                'data_entrega' => $request->data_entrega ? Carbon::createFromFormat('d/m/Y', $request->data_entrega)->format('Y-m-d') : null,
                'canhoto' => $request->canhoto,
                'nf_devolucao' => $request->nf_devolucao,
                'observacao' => $request->observacao
            ]);
            return redirect()->route('notas.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('notas.edit', $nota)->withInput()->withErrors('Erro ao Realizar Operação!');
        }
        
    }

    public function delete(Nota $nota)
    {
        try {
            $nota->itens()->delete();
            $nota->delete();
            return redirect()->route('notas.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('notas.index', $nota)->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function alterarDataChegada(Request $request)
    {
        try {
            $ids = explode(',', $request->ids);
            foreach ($ids as $id) {
                $nota = Nota::find($id);
                $nota->update([
                    'chegada' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d')
                ]);
            }
            return redirect()->route('notas.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('notas.index')->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function alterarDataChegadaPorto(Request $request)
    {
        try {
            $ids = explode(',', $request->ids);
            foreach ($ids as $id) {
                $nota = Nota::find($id);
                $nota->update([
                    'chegada_porto' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d')
                ]);
            }
            return redirect()->route('notas.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('notas.index')->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function alterarDataEntrega(Request $request)
    {
        try {
            $ids = explode(',', $request->ids);
            foreach ($ids as $id) {
                $nota = Nota::find($id);
                $nota->update([
                    'data_entrega' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d')
                ]);
            }
            return redirect()->route('notas.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('notas.index')->withErrors('Erro ao Realizar Operação!');
        }
    }
    
}
