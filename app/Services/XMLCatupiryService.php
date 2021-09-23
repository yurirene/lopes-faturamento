<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\DadosCadastrais;
use App\Models\Frete;
use App\Models\Industria;
use App\Models\ItensNota;
use App\Models\Nota;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class XMLCatupiryService
{

    public static function importar($request, &$quantidade_importada)
    {
        try {
            $industria = Industria::find($request['industria']);
            $notas = array();
            foreach ($request['arquivos'] as $arquivo) {
                $xml = self::converterXMLParaArray($arquivo);
                if ($xml['emit']['CNPJ'] == $industria->cnpj && self::verificaSeJaFoiImportada($xml)) {
                    $notas[] = $xml;
                    $quantidade_importada++;
                }           
            }
            if ($quantidade_importada == 0) {
                throw new Exception('As notas não correspodem com a industria selecionada ou já foram importadas');
            }
            self::store($notas, $industria);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

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
     * Salva o esqueleto da nota
     */

    public static function store($notas, $industria)
    {
        DB::beginTransaction();
        try {
            foreach ($notas as $nota) {
                $cliente  = self::buscaOuCriaCliente($nota);
                $informacoes = self::informacoesNota($nota);
                $informacoes['cliente_id'] = $cliente->id;
                $informacoes['industria_id'] = $industria->id;
                $nova_nota = Nota::create($informacoes);
                self::salvarProdutos($nova_nota, $nota);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

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
     * Retorna todas as informações pertinentes à Model\Nota em um array
     */
    public static function informacoesNota($nota)
    {
        $fator = Frete::where('codigo', $nota['dest']['enderDest']['cMun'])->first()->fator;
        $retorno = [
            'numero' => $nota['ide']['nNF'],
            'emissao' => Carbon::createFromFormat('Y-m-d\TH:i:sP', $nota['ide']['dhEmi']),
            'valor_bruto' => $nota['total']['ICMSTot']['vNF'],
            'valor_liquido' => $nota['total']['ICMSTot']['vProd'],
            'peso_liquido' => $nota['transp']['vol']['pesoL'],
            'peso_bruto' => $nota['transp']['vol']['pesoB'],
            'cidade_entrega' => $nota['dest']['enderDest']['xMun'],
            'transportadora' => $nota['transp']['transporta']['xNome'],
            'valor_frete' => floatval($nota['transp']['vol']['pesoB']) * floatval($fator)
        ];
        return $retorno;
    }

    /**
     * Salva produtos registrados na nota
     */
    public static function salvarProdutos($nova_nota, $nota)
    {
        DB::beginTransaction();
        try {
            $itens = data_get($nota, 'det');
            foreach ($itens as $item) {
                $informacoes = self::informacoesProduto($item);
                $informacoes['nota_id'] = $nova_nota->id;
                ItensNota::create($informacoes);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public static function informacoesProduto($item)
    {
        $produto = DadosCadastrais::where('codigo', intval($item['prod']['cProd']))->first();
        $quantidade_caixa = $item['prod']['qCom'] / $produto->qtd_und_caixa;
        $peso_caixa_liquido = $produto->peso_liquido_caixa * $quantidade_caixa;
        $retorno = array(
            'codigo_produto' => $item['prod']['cProd'],
            'descricao' => $item['prod']['xProd'],
            'caixa_fardo' => $quantidade_caixa,
            'peso_liquido' => $peso_caixa_liquido,
            'armazenagem' => $produto->conservacao
        );
        return $retorno;
    }

    public static function verificaSeJaFoiImportada($nota)
    {
        if (Nota::where('numero', intval($nota['ide']['nNF']))->count()) {
            return false;
        }
        return true;
    }
     
}
