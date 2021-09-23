<?php

namespace App\DataTables;

use App\Models\Nota;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotasDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            
            ->addColumn('action', function($query) {
                return '<div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton' . $query->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Ações
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $query->id . '">
                <a class="dropdown-item" href="' . route('notas.itens', $query->id) . '"><i class="fas fa-external-link-square-alt text-sm"></i> Abrir</a>
                  <a class="dropdown-item" href="' . route('notas.edit', $query->id) . '"><i class="fas fa-pen text-sm"></i> Editar</a>
                  <a class="dropdown-item" href="' . route('notas.delete', $query->id) . '"><i class="fas fa-trash text-sm"></i> Apagar</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-file-download text-sm"></i> Baixar XML</a>
                </div>
              </div>';
            })

            ->editColumn('industria_id', function($query) {
                return $query->industria->razao_social;
            })

            ->editColumn('cliente_id', function($query) {
                return $query->cliente->razao_social;
            })

            ->editColumn('emissao', function($query) {
                return $query->emissao ? $query->emissao->format('d/m/y') : null;
            })

            ->editColumn('chegada', function($query) {
                return $query->chegada ? $query->chegada->format('d/m/y') : null;
            })
            
            ->editColumn('chegada_porto', function($query) {
                return $query->chegada_porto ? $query->chegada_porto->format('d/m/y') : null;
            })
            
            ->editColumn('valor_bruto', function($query) {
                return "R$ " . number_format($query->valor_bruto, 2, ',', ' ');
            })
            
            ->editColumn('valor_liquido', function($query) {
                return "R$ " . number_format($query->valor_liquido, 2, ',', ' ');
            })
            
            ->editColumn('peso_bruto', function($query) {
                return number_format($query->peso_bruto, 2, '.', ' ');
            })
            
            ->editColumn('peso_liquido', function($query) {
                return number_format($query->peso_liquido, 2, '.', ' ');
            })

            ->editColumn('data_entrega', function($query) {
                return $query->data_entrega ? $query->data_entrega->format('d/m/y') : null;
            })

            ->editColumn('data_reentrega', function($query) {
                return $query->data_reentrega ? $query->data_reentrega->format('d/m/y') : null;
            })
            
            ->editColumn('valor_frete', function($query) {
                return "R$ " . number_format($query->valor_frete, 2, ',', ' ');
            })
            
            ->editColumn('canhoto', function($query) {
                $retorno = '';
                if ($query->canhoto == 0) {
                    $retorno = '<span class="badge badge-secondary">Aguardando</span>';
                } else {
                    $retorno = '<span class="badge badge-success">OK</span>';
                }

                return $retorno;
            })
            ->rawColumns(['action', 'canhoto']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Nota $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Nota $model)
    {

        $query = $model->newQuery();
        $query->when(request('periodo'), function ($q) {
            $datas = explode(' - ',request('periodo'));
            $periodo[0] = Carbon::createFromFormat('d/m/Y', $datas[0])->format('Y-m-d');
            $periodo[1] = Carbon::createFromFormat('d/m/Y', $datas[1])->format('Y-m-d');
            return $q->whereBetween('emissao', $periodo);
        });
        $query->when(request('industria'), function ($q) {
            return $q->whereIn('industria_id', request('industria'));
        });

        $query->when(request('cliente'), function ($q) {
            return $q->whereIn('cliente_id', request('cliente'));
        });

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('notas-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(5)
                    ->parameters([
                        "language" => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ],
                        'buttons' => []
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('action')->title('Ações'),
            Column::make('industria_id')->title('Industria'),
            Column::make('cliente_id')->title('Cliente'),
            Column::make('numero')->title('Nota'),
            Column::make('pedido_cliente')->title('Pedido Cliente'),
            Column::make('emissao')->title('Dt. Emissão')->class('text-center'),
            Column::make('chegada')->title('Dt. Chegada')->class('text-center'),
            Column::make('chegada_porto')->title('Dt. Chegada Porto')->class('text-center'),
            Column::make('valor_bruto')->title('Valor Bruto')->class('text-right'),
            Column::make('valor_liquido')->title('Valor Líquido')->class('text-right'),
            Column::make('peso_bruto')->title('Peso Bruto')->class('text-right'),
            Column::make('peso_liquido')->title('Peso Líquido')->class('text-right'),
            Column::make('cidade_entrega')->title('Entrega'),
            Column::make('cte')->title('Cte'),
            Column::make('placa')->title('Placa'),
            Column::make('transportadora')->title('Transportadora'),
            Column::make('data_entrega')->title('Dt. Entrega')->class('text-center'),
            Column::make('data_reentrega')->title('Dt. Reentrega')->class('text-center'),
            Column::make('canhoto')->title('Canhoto')->class('text-center'),
            Column::make('nf_devolucao')->title('NF Devolução'),
            Column::make('valor_frete')->title('Valor Frete')->class('text-right'),
            Column::make('observacao')->title('Observação'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Notas_' . date('YmdHis');
    }
}
