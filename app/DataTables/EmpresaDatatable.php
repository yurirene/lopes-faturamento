<?php

namespace App\DataTables;

use App\Models\Empresa;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmpresaDatatable extends DataTable
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
            ->editColumn('action', function($query) {
                $status = [
                    $query->usuario->is_active ? 'danger' : 'success',
                    $query->usuario->is_active ? 'ban' : 'check'
                ];
                return '<a href="' . route('empresa.edit', $query) . '" class="btn btn-primary btn-xs px-2"><i class="fas fa-edit text-xs"></i></a>'
                . '<a href="' . route('empresa.status', $query->id) . '" class="btn btn-' . $status[0] . ' btn-xs px-2 ml-1"><i class="fas fa-' . $status[1] . ' text-xs"></i></a>';
            })
            ->editColumn('razao_social', function($query) {
                return $query->razao_social;
            })
            ->editColumn('usuario', function($query) {
                return $query->usuario->email;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Empresa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Empresa $model)
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
                    ->setTableId('empresa-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::computed('action')->title('Ação')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('razao_social')->title('Razão Social'),
            Column::make('usuario')->title('Usuário')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Empresa_' . date('YmdHis');
    }
}
