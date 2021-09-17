<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Models\DadosCadastrais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XMLController extends Controller
{
    public function index()
    {
        return view('xml.index');
    }

    public function importar(Request $request)
    {

        $arquivo = $request->file('arquivo');
        $xmlString = file_get_contents($arquivo);
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml->NFe->infNFe);
        $nota = json_decode($json,TRUE);
        
        return self::XLS($nota);
        
    }


    public static function XLS($nota)
    {
        
        $razao_social = $nota['dest']['xNome'];
        $cnpj = $nota['dest']['CNPJ'];
        $end = $nota['dest']['enderDest'];
        $endereco = $end['xLgr'] .", " .$end['nro'] .", " .$end['CEP']. ", " .$end['xBairro']. " - ".$end['xMun'] . ", ". $end['UF'];
        $total_nota = $nota['total']['ICMSTot']['vNF'];
        $total_produto = $nota['total']['ICMSTot']['vProd'];
        $produtos = data_get($nota, 'det');

        $frete_percentual = Cidade::where('nome', $end['xMun'])->first()->percentual;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       
        $x = 1;

        $sheet->setCellValue('A'.$x, 'Nº Nota Fiscal: '.$nota['ide']['nNF']);
        $sheet->getStyle("A".$x)->getFont()->setBold(true);
        $sheet->mergeCells("A".$x.":I".$x);
        $sheet->getStyle("A".$x.":B".$x)->getAlignment()->setHorizontal('center');

        $x++;

        $sheet->setCellValue('A'.$x, 'CNPJ: '.$cnpj);
        $sheet->mergeCells("A".$x.":I".$x);

        $x++;

        $sheet->setCellValue('A'.$x, 'Endereço: '.$endereco);
        $sheet->mergeCells("A".$x.":I".$x);


        $x++;

        $sheet->setCellValue('A'.$x, 'Peso Bruto: '.$cnpj);
        $sheet->mergeCells("A".$x.":I".$x);
        
        $x++;

        $sheet->setCellValue('A'.$x, 'Peso Líquido: '.$cnpj);
        $sheet->mergeCells("A".$x.":I".$x);

        $x++;

        $sheet->setCellValue('A'.$x, 'Valor da NF: '.$total_nota);
        $sheet->mergeCells("A".$x.":I".$x);

        $x++;

        $sheet->setCellValue('A'.$x, 'Valor dos Produtos: '.$total_produto);
        $sheet->mergeCells("A".$x.":I".$x);

        $x += 2;
        
        $sheet->setCellValue('A'.$x, 'Código');
        $sheet->setCellValue('B'.$x, 'Descrição');
        $sheet->mergeCells("B".$x.":C".$x);
        $sheet->setCellValue('D'.$x, 'Qtd Caixa');
        $sheet->setCellValue('E'.$x, 'Peso Líquido');
        $sheet->setCellValue('F'.$x, 'Peso Bruto');
        $sheet->setCellValue('G'.$x, 'Frete');
        $sheet->setCellValue('H'.$x, 'Conservação');
        $sheet->setCellValue('I'.$x, '--');
        $sheet->getStyle("A".$x.":I".$x)->getFont()->setBold(true);

        $totalPesoBruto = 0;
        $totalPesoLiquido = 0;
        $totalFrete = 0;

        foreach($produtos as  $produto){
            $item = DadosCadastrais::where('codigo', intval($produto['prod']['cProd']))->first();
            $quantidade_caixa = $produto['prod']['qCom'] / $item->qtd_und_caixa;
            $peso_caixa_bruto = $item->peso_bruto_caixa * $quantidade_caixa;
            $peso_caixa_liquido = $item->peso_liquido_caixa * $quantidade_caixa;
            $totalPesoBruto += $peso_caixa_bruto;
            $totalPesoLiquido += $peso_caixa_liquido;
            $frete = $frete_percentual * $peso_caixa_bruto;
            $totalFrete += $frete;

            
            $x++;
            $sheet->setCellValue('A' . $x, $item->codigo);
            $sheet->setCellValue('B' . $x, $item->descricao);
            $sheet->mergeCells("B".$x.":C".$x);
            $sheet->setCellValue('D' . $x, $quantidade_caixa);
            $sheet->setCellValue('E' . $x, $peso_caixa_liquido);
            $sheet->setCellValue('F' . $x, $peso_caixa_bruto);
            $sheet->setCellValue('G' . $x, $frete);
            
            $sheet->setCellValue('H' . $x, $item->conservacao);
            $sheet->setCellValue('I' . $x, '');
        }

        $nomeArquivo = date('YmdHis') . str_pad(rand(1, 9999), 4, "0", STR_PAD_LEFT);

        $writer = new Xlsx($spreadsheet);
        $writer->save('/tmp/' . $nomeArquivo . '.xlsx');

        return Response::download('/tmp/' . $nomeArquivo . '.xlsx', $nomeArquivo . '.xlsx',
            array('Content-Type: application/xlsx'));
    }
}
