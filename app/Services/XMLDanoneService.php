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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class XMLDanoneService extends XMLService
{

    public static function importar($request, &$quantidade_importada)
    {
        try {
            $industria = Industria::find($request['industria']);
            $notas = array();
            foreach ($request['arquivos'] as $arquivo) {
                $xml = self::converterXMLParaArray($arquivo);
                if ($xml['emit']['CNPJ'] == $industria->cnpj && self::verificaSeJaFoiImportada($xml, $industria->id)) {
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
     * Retorna todas as informações pertinentes à Model\Nota em um array
     */
    public static function informacoesNota($nota)
    {
        $fator = Frete::where('codigo', $nota['dest']['enderDest']['cMun'])->first()->fator;
        $retorno = [
            'numero' => $nota['ide']['nNF'],
            'pedido_cliente' => 'S/N',
            'emissao' => Carbon::createFromFormat('Y-m-d\TH:i:sP', $nota['ide']['dhEmi'])->format('Y-m-d'),
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
            if (array_key_exists('prod', $itens)) {
                $informacoes = self::informacoesProduto($itens);
                $informacoes['nota_id'] = $nova_nota->id;
                ItensNota::create($informacoes);
            } else {
                foreach ($itens as $item) {
                    $informacoes = self::informacoesProduto($item);
                    $informacoes['nota_id'] = $nova_nota->id;
                    ItensNota::create($informacoes);
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    
    /**
     * Retorna a informações necessárias para à Model\ItensNota
     */


    public static function informacoesProduto($item)
    {        
        $retorno = array(
            'codigo_produto' => $item['prod']['cProd'],
            'descricao' => $item['prod']['xProd'],
            'caixa_fardo' => $item['prod']['qCom'],
        );
        return $retorno;
    }
     
}
