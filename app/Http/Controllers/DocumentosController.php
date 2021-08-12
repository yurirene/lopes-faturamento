<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoDatatable;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentosController extends Controller
{

    public function index(DocumentoDatatable $dataTable)
    {
        return $dataTable->render('documento.index');
    }

    public function create()
    {
        return view('documento.form');
    }

    public function edit(Documento $empresa)
    {
        return view('documento.form', [
            'documento' => $empresa
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $referencia = str_replace('/', '_', $request->referencia);
            $documento = Documento::create([
                'referencia' => $request->referencia,
                'tipo' => $request->tipo,
                'empresa_id' => Auth::user()->empresa->id
            ]);
            if ($request->arquivo) {
                $fileName = $referencia. "_" . Documento::TIPO[$request->tipo] . "." . $request->arquivo->getClientOriginalExtension();
                $request->arquivo->storeAs('public', $fileName);
                $documento->update([
                    'caminho' => "public/" . $fileName
                ]);
            }
            DB::commit();
            return redirect()->route('documentos.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('documentos.index')->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function destroy()
    {

    }
}
