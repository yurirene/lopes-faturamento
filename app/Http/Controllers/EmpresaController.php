<?php

namespace App\Http\Controllers;

use App\DataTables\EmpresaDatatable;
use App\Models\Empresa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{

    public function index(EmpresaDatatable $dataTable)
    {
        return $dataTable->render('empresa.index');
    }

    public function create()
    {
        return view('empresa.form');
    }

    public function edit(Empresa $empresa)
    {
        return view('empresa.form', [
            'empresa' => $empresa
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $usuario = User::create([
                'name' => $request->razao_social,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            Empresa::create([
                'razao_social' => $request->razao_social,
                'usuario_id' => $usuario->id
            ]);
            DB::commit();
            return redirect()->route('empresa.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresa.index')->withErrors('Erro ao Realizar Operação!');
        }
    }

    public function update(Empresa $empresa, Request $request)
    {
        DB::beginTransaction();
        try {
            $empresa->update([
                'razao_social' => $request->razao_social
            ]);
            $usuario = $empresa->usuario;
            $usuario->update([
                'email' => $request->email,
                'name' => $request->razao_social
            ]);
            if (!empty($request->password)) {
                $usuario->update([
                    'password' => Hash::make($request->password)
                ]);
            }
            DB::commit();
            return redirect()->route('empresa.index')->with(['mensagem' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresa.index')->withErrors('Erro ao Realizar Operação!');
        }
    }
}
