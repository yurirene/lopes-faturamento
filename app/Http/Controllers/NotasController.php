<?php

namespace App\Http\Controllers;

use App\DataTables\NotasDatatable;
use App\Imports\DadosCadastraisImport;
use App\Models\Cliente;
use App\Models\DadosCadastrais;
use App\Models\Industria;
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
    
}
