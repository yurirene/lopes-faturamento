<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoDatatable;
use App\Models\Documento;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DocumentosController extends Controller
{

    public function index(DocumentoDatatable $dataTable)
    {
        return $dataTable->render('documento.index');
    }

    public function create()
    {
        return view('documento.form', [
            'tipos' => Tipo::get()->pluck('titulo', 'id')
        ]);
    }

    public function edit(Documento $empresa)
    {
        return view('documento.form', [
            'documento' => $empresa,
            'tipos' => Tipo::get()->pluck('titulo', 'id')
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $referencia = str_replace('/', '_', $request->referencia);
            $documento = Documento::create([
                'referencia' => $request->referencia,
                'tipo_id' => $request->tipo,
                'empresa_id' => Auth::user()->empresa->id
            ]);
            if ($request->arquivo) {
                $tipo = Tipo::find($request->tipo);
                $fileName = $referencia. "_" . str_replace(' ', '_', $tipo->titulo) . "." . $request->arquivo->getClientOriginalExtension();
                $request->arquivo->storeAs('public/' . Str::slug(Auth::user()->empresa->razao_social), $fileName);
                $documento->update([
                    'caminho' => "storage/" . Str::slug(Auth::user()->empresa->razao_social) . "/" . $fileName
                ]);
            }
            DB::commit();
            return redirect()->route('documentos.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('documentos.index')->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function delete (Documento $documento)
    {
        DB::beginTransaction();
        try {
            unlink(public_path($documento->caminho));
            $documento->delete();
            DB::commit();
            return redirect()->route('documentos.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('documentos.index')->withErrors('Erro ao Realizar Operação!');
        }

    }
}
