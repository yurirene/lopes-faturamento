<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Industria;
use App\Models\Nota;
use Exception;
use Illuminate\Support\Facades\DB;

class XMLService
{

    /**
     * Converte o conteúdo do XML para array e retorna apenas as informações da nota
     */
    public static function converterXMLParaArray($arquivo)
    {
        $xmlString = file_get_contents($arquivo);
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml->NFe->infNFe);
        return json_decode($json,TRUE);
    }

    /**
     * Busca ou Cria Cliente informado na nota
     */

    public static function buscaOuCriaCliente($nota)
    {
        try {
            $end = $nota['dest']['enderDest'];
            return Cliente::firstOrCreate(['cnpj' => $nota['dest']['CNPJ']], [
                'cnpj' => $nota['dest']['CNPJ'],
                'razao_social' =>  $nota['dest']['xNome'],
                'endereco' => $end['xLgr'] .", " .$end['nro'] .", " .$end['CEP']. ", " .$end['xBairro'],
                'cidade' => $end['xMun'],
                'uf' => $end['UF']                
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Verifica se o numero da nota referente à uma industria já foi cadastrada
     */
    public static function verificaSeJaFoiImportada($nota, $industria)
    {
        if (Nota::where('numero', intval($nota['ide']['nNF']))->where('industria_id', $industria)->count()) {
            return false;
        }
        return true;
    }

}