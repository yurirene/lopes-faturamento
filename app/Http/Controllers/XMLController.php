<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\DadosCadastrais;
use App\Models\Industria;
use App\Services\XMLCatupiryService;
use App\Services\XMLFactory;
use App\Services\XMLService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XMLController extends Controller
{
    public function index()
    {
        $industrias = Industria::all()->pluck('razao_social', 'id');
        return view('xml.index', [
            'industrias' => $industrias
        ]);
    }

    public function importar(Request $request)
    {
        try {
            $quantidade_importada = 0;
            $quantidade_enviada = count($request->arquivos);
            $service = self::getService($request->industria);
            $service::importar($request->all(), $quantidade_importada);
            return redirect()->route('industrias.index')->with(['mensagem' => 'Notas Importadas ' . $quantidade_importada. ' de '. $quantidade_enviada]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors($th->getMessage());
        }
    }

    public static function getService($industria)
    {
        $classe = (new XMLFactory)->service($industria);
        return new $classe;
    }
}
