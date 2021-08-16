<?php

namespace App\DataTables;

use App\Models\Documento;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DocumentoDatatable extends DataTable
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
                $botoes = '<a href="' . $query->caminho . '" target="_blank" class="btn btn-primary btn-xs px-2"><i class="fas fa-eye text-xs"></i></a>';
                if (Auth::user()->is_admin) {
                    $botoes .= '<a onclick="deleteArchive(this)" href="javascript:void(0)" data-rota="' . route('documentos.delete', $query->id) . '" class="btn btn-danger  btn-xs px-2 ml-1"><i class="fas fa-trash"></i></a>';
                }
                return $botoes;
            })
            ->editColumn('referencia', function($query) {
                return $query->referencia;
            })
            ->editColumn('empresa', function($query) {
                return $query->empresa->razao_social;
            })
            ->editColumn('tipo_id', function($query) {
                return $query->tipo->titulo;
            })
            ->editColumn('created_at', function($query) {
                return $query->created_at->format('d/m/y H:i');
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Documento $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Documento $model)
    {
        $usuario = Auth::user();
        $query = $model->newQuery()
        ->when(!$usuario->is_admin, function ($sql) use ($usuario) {
            $sql->where('empresa_id', $usuario->empresa->id);
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
                    ->setTableId('documento-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(4)
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
            Column::make('referencia')->title('Referência'),
            Column::make('empresa')->title('Empresa'),
            Column::make('tipo_id')->title('Tipo'),
            Column::make('created_at')->title('Criado em'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Documento_' . date('YmdHis');
    }
}
