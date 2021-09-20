<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
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

        $razao_social = $nota['dest']['xNome'];
        $cnpj = $nota['dest']['CNPJ'];
        $end = $nota['dest']['enderDest'];
        $endereco = $end['xLgr'] .", " .$end['nro'] .", " .$end['CEP']. ", " .$end['xBairro']. " - ".$end['xMun'] . ", ". $end['UF'];
        $total_nota = $nota['total']['ICMSTot']['vNF'];
        $total_produto = $nota['total']['ICMSTot']['vProd'];
        $produtos = data_get($nota, 'det');
        $frete_percentual = Cidade::where('nome', $end['xMun'])->first()->percentual;
        
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
        }


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
       
        $sheet->setCellValue('A1', 'Nº Nota Fiscal: '.$nota['ide']['nNF']);
        $sheet->getStyle("A1")->getFont()->setBold(true);
        $sheet->mergeCells("A1:G1");
        $sheet->getStyle("A1".":B1")->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('A2', 'CNPJ: ');
        $sheet->getStyle("A2")->getFont()->setBold(true);
        $sheet->setCellValue('B2', $cnpj);
        $sheet->mergeCells("B2:G2");
        $sheet->getStyle("A2".":B2")->getAlignment()->setHorizontal('left');

        $sheet->setCellValue('A3', 'Endereço: ');
        $sheet->getStyle("A3")->getFont()->setBold(true);
        $sheet->setCellValue('B3', $endereco);
        $sheet->mergeCells("B3:G3");
        $sheet->getStyle("A3".":B3")->getAlignment()->setHorizontal('left');

        $sheet->setCellValue('A4', 'Peso Bruto: ');
        $sheet->getStyle("A4")->getFont()->setBold(true);
        $sheet->setCellValue('B4', $cnpj.'Kg');
        $sheet->mergeCells("B4:G4");
        $sheet->getStyle("A4".":B4")->getAlignment()->setHorizontal('left');
        
        
        $sheet->setCellValue('A7', 'Valor dos Produtos: ');
        $sheet->getStyle("A7")->getFont()->setBold(true);
        $sheet->setCellValue('B7', 'R$'.number_format($total_produto,2,',', '.'));
        $sheet->mergeCells("B7:G7");
        $sheet->getStyle("A7".":B7")->getAlignment()->setHorizontal('left');

        $sheet->setCellValue('A8', 'Produtos');
        $sheet->getStyle("A8")->getFont()->setBold(true);
        $sheet->mergeCells("B8:G8");
        $sheet->getStyle("A8".":B8")->getAlignment()->setHorizontal('left');

        $sheet->setCellValue('A9', 'Código');
        $sheet->setCellValue('B9', 'Descrição');
        $sheet->setCellValue('C9', 'Qtd Caixa');
        $sheet->setCellValue('D9', 'Peso Líquido');
        $sheet->setCellValue('E9', 'Peso Bruto');
        $sheet->setCellValue('F9', 'Frete');
        $sheet->setCellValue('G9', 'Conservação');
        $sheet->getStyle("A9:G9")->getFont()->setBold(true);

        $totalPesoBruto = 0;
        $totalPesoLiquido = 0;
        $totalFrete = 0;
        $x = 9;
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
            $sheet->setCellValue('C' . $x, $quantidade_caixa);
            $sheet->setCellValue('D' . $x, $peso_caixa_liquido);
            $sheet->setCellValue('E' . $x, $peso_caixa_bruto);
            $sheet->setCellValue('F' . $x, $frete);
            $sheet->setCellValue('G' . $x, $item->conservacao);
        }

        $sheet->setCellValue('A5', 'Peso Líquido: ');
        $sheet->getStyle("A5")->getFont()->setBold(true);
        $sheet->setCellValue('B5', $totalPesoLiquido.'Kg');
        $sheet->mergeCells("B5:G5");
        $sheet->getStyle("A5".":B5")->getAlignment()->setHorizontal('left');

        $sheet->setCellValue('A6', 'Valor da NF: ');
        $sheet->getStyle("A6")->getFont()->setBold(true);
        $sheet->setCellValue('B6', 'R$'.number_format($totalPesoBruto,2,',', '.'));
        $sheet->mergeCells("B6:G6");
        $sheet->getStyle("A6".":B6")->getAlignment()->setHorizontal('left');


        $sheet->getColumnDimension("A")->setAutoSize(true);
        $sheet->getColumnDimension("B")->setAutoSize(true);
        $sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getColumnDimension("D")->setAutoSize(true);
        $sheet->getColumnDimension("E")->setAutoSize(true);
        $sheet->getColumnDimension("F")->setAutoSize(true);
        $sheet->getColumnDimension("G")->setAutoSize(true);

        $nomeArquivo = date('YmdHis') . str_pad(rand(1, 9999), 4, "0", STR_PAD_LEFT);

        $writer = new Xlsx($spreadsheet);
        $writer->save('/tmp/' . $nomeArquivo . '.xlsx');

        return Response::download('/tmp/' . $nomeArquivo . '.xlsx', $nomeArquivo . '.xlsx',
            array('Content-Type: application/xlsx'));
    }
}
