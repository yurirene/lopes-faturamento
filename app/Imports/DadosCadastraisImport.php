<?php

namespace App\Imports;

use App\Models\DadosCadastrais;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class DadosCadastraisImport implements ToModel, WithCalculatedFormulas
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $conservacao = null;
        if (strpos($row[8], 'RESFRIADO')) {
            $conservacao = 'REFRIGERADO';
        } 
        if (strpos($row[8], 'REEZER')) {
            $conservacao = 'CONGELADO';
        }

        return new DadosCadastrais([
            'codigo' => $row[0],
            'sigla' => $row[1],
            'descricao' => $row[2],
            'peso_liquido' => $row[3],
            'peso_bruto' => $row[4],
            'qtd_und_por_embalagem' => ($row[5] == '-') ? null : $row[5],
            'peso_unidade' => ($row[6] == '-') ? null : $row[6],
            'validade' => $row[7],
            'conservacao' => !is_null($conservacao) ? $conservacao : $row[8],
            'dim_emb_comprimento' => ($row[9] == '-') ? null : $row[9],
            'dim_emb_largura' => ($row[10] == '-') ? null : $row[10],
            'dim_emb_altura' => ($row[11] == '-') ? null : $row[11],
            'ean' => $row[12],
            'qtd_und_caixa' => $row[13],
            'peso_liquido_caixa' => $row[14],
            'peso_bruto_caixa' => $row[16],
            'dun' => $row[17],
            'dim_cx_emb_comprimento' => $row[18],
            'dim_cx_emb_largura' => $row[19],
            'dim_cx_emb_altura' => $row[20],
            'lastro' => $row[21],
            'camada' => $row[22],
            'total' => $row[23],
            'palet_altura' => $row[24],
            'palet_peso_liquido' => $row[25],
            'palet_peso_bruto' => $row[26],
            'ncm' => $row[27]
        ]);
    }
}
