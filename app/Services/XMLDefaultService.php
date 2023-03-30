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

class XMLDefaultService extends XMLService
{

    public static function importar($request, &$quantidadeImportada)
    {
        try {
            $industria = Industria::find($request['industria']);
            $notas = array();
            foreach ($request['arquivos'] as $arquivo) {
                $xml = self::converterXMLParaArray($arquivo);
                if ($xml['emit']['CNPJ'] == $industria->cnpj && self::verificaSeJaFoiImportada($xml, $industria->id)) {
                    $notas[] = $xml;
                    $quantidadeImportada++;
                }
            }
            if ($quantidadeImportada == 0) {
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
                $novaNota = Nota::create($informacoes);
                self::salvarProdutos($novaNota, $nota);
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
        $fator = 0;
        if ($nota['dest']['enderDest']['cMun']) {
            $fator = Frete::where('codigo', $nota['dest']['enderDest']['cMun'])->first()->fator;
        }
        $emissao = isset($nota['ide']['dhEmi'])
            ? Carbon::createFromFormat('Y-m-d\TH:i:sP', $nota['ide']['dhEmi'])->format('Y-m-d')
            : date('Y-m-d');
        return [
            'numero' => isset($nota['ide']['nNF']) ? $nota['ide']['nNF'] : '-',
            'pedido_cliente' => 'S/N',
            'emissao' => $emissao,
            'valor_bruto' => isset($nota['total']['ICMSTot']['vNF']) ? $nota['total']['ICMSTot']['vNF'] : '0',
            'valor_liquido' => isset($nota['total']['ICMSTot']['vProd']) ? $nota['total']['ICMSTot']['vProd'] : '0',
            'peso_liquido' => isset($nota['transp']['vol']['pesoL']) ? $nota['transp']['vol']['pesoL'] : '0',
            'peso_bruto' => isset($nota['transp']['vol']['pesoB']) ? $nota['transp']['vol']['pesoB'] : '0',
            'cidade_entrega' => isset($nota['dest']['enderDest']['xMun']) ? $nota['dest']['enderDest']['xMun'] : '0',
            'transportadora' => isset($nota['transp']['transporta']['xNome']) ? $nota['transp']['transporta']['xNome'] : '0',
            'valor_frete' => floatval(
                isset($nota['transp']['vol']['pesoB'])
                ? $nota['transp']['vol']['pesoB']
                : 0
            ) * floatval($fator)
        ];
    }

    /**
     * Salva produtos registrados na nota
     */
    public static function salvarProdutos($novaNota, $nota)
    {
        DB::beginTransaction();
        try {
            $itens = data_get($nota, 'det');
            if (array_key_exists('prod', $itens)) {
                $informacoes = self::informacoesProduto($itens);
                $informacoes['nota_id'] = $novaNota->id;
                ItensNota::create($informacoes);
            } else {
                foreach ($itens as $item) {
                    $informacoes = self::informacoesProduto($item);
                    $informacoes['nota_id'] = $novaNota->id;
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
        $armazenagem = '';
        if (strstr($item['prod']['xProd'], ' LT ')) {
            $armazenagem = 'AMBIENTE';
        } elseif (strstr($item['prod']['xProd'], ' PT ')) {
            $armazenagem = 'REFRIGERADO';
        }

        return [
            'codigo_produto' => isset($item['prod']['cProd']) ? $item['prod']['cProd'] : 0,
            'descricao' => isset($item['prod']['xProd']) ? $item['prod']['xProd'] : 0,
            'caixa_fardo' => isset($item['prod']['qCom']) ? $item['prod']['qCom'] : 0,
            'armazenagem' => $armazenagem,
            'valor_unitario' => isset($item['prod']['vUnCom']) ? floatval($item['prod']['vUnCom']) : null
        ];
    }

}
