<?php

namespace App\DataTables;

use App\Models\Frete;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FretesDatatable extends DataTable
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
                  <a class="dropdown-item" href="' . route('fretes.edit', $query->id) . '"><i class="fas fa-pen text-sm"></i> Editar</a>
                  <a class="dropdown-item" href="' . route('fretes.delete', $query->id) . '"><i class="fas fa-trash text-sm"></i> Apagar</a>
                </div>
              </div>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Frete $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Frete $model)
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
                    ->setTableId('frete-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(2)
                    ->buttons(
                        Button::make('create')->text("<i class='fas fa-plus'></i> Adicionar")
                    )
                    ->parameters([
                        "language" => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                        ],
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
            Column::make('nome')->title('Cidade'),
            Column::make('fator')->title('Fator'),
            Column::make('codigo')->title('Cod. Município'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fretes_' . date('YmdHis');
    }
}
