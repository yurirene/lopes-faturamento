<?php

namespace App\DataTables;

use App\Models\DadosCadastrais;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DadosCadastraisDatatable extends DataTable
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
     * @param \App\Models\DadosCadastrais $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DadosCadastrais $model)
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
                    ->setTableId('dados-cadastrais-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('codigo')->title('Código'),
            Column::make('sigla')->title('Sigla'),
            Column::make('descricao')->title('Descrição'),
            Column::make('validade')->title('Validade'),
            Column::make('qtd_und_caixa')->title('Qtd Por Caixa'),
            Column::make('peso_liquido_caixa')->title('Peso Liquido (Kg)'),
            Column::make('peso_bruto_caixa')->title('Peso Bruto (Kg)'),
            Column::make('conservacao')->title('Conservação'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DadosCadastrais_' . date('YmdHis');
    }
}
