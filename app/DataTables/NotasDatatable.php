<?php

namespace App\DataTables;

use App\Models\Nota;
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
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Nota $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Nota $model)
    {
        return $model->newQuery();
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
                    ->orderBy(0)
                    ->parameters([
                        "language" => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ]
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
            Column::make('industria_id')->title('Industria'),
            Column::make('cliente_id')->title('Cliente'),
            Column::make('numero')->title('Nota'),
            Column::make('pedido_cliente')->title('Pedido Cliente'),
            Column::make('emissao')->title('Dt. Emissão'),
            Column::make('chegada')->title('Dt. Chegada'),
            Column::make('chegada_porto')->title('Dt. Chegada Porto'),
            Column::make('valor_bruto')->title('Valor Bruto'),
            Column::make('valor_liquido')->title('Valor Líquido'),
            Column::make('peso_bruto')->title('Peso Bruto'),
            Column::make('peso_liquido')->title('Peso Líquido'),
            Column::make('cidade_entrega')->title('Entrega'),
            Column::make('cte')->title('Cte'),
            Column::make('placa')->title('Placa'),
            Column::make('transportadora')->title('Transportadora'),
            Column::make('data_entrega')->title('Dt. Entrega'),
            Column::make('data_reentrega')->title('Dt. Reentrega'),
            Column::make('canhoto')->title('Canhoto'),
            Column::make('nf_devolucao')->title('NF Devolução'),
            Column::make('valor_frete')->title('Valor Frete'),
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
