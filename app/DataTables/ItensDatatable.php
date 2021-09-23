<?php

namespace App\DataTables;

use App\Models\DadosCadastrais;
use App\Models\ItensNota;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ItensDatatable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $table = datatables()
            ->eloquent($query)
            ->addColumn('industria', function($query) {
                return $query->nota->industria->razao_social;
            })
            ->addColumn('cliente', function($query) {
                return $query->nota->cliente->razao_social;
            })
            ->addColumn('numero', function($query) {
                return $query->nota->numero;
            });
            if (request()->nota->industria->id == 2) {
                $table->addColumn('dun', function($query) {
                    $item = DadosCadastrais::where('codigo', $query->codigo_produto)->first();
                    return $item->dun;
                });
            }
            $table->addColumn('descricao', function($query) {
                return $query->descricao;
            })
            ->addColumn('armazenagem', function($query) {
                
                return $query->armazenagem;
            })
            ->addColumn('cidade', function($query) {
                return $query->nota->cidade_entrega;
            })
            ->editColumn('peso_liquido', function($query) {
                return $query->peso_liquido ;
            });
        return $table;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ItensNota $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ItensNota $model)
    {
        $nota = request()->nota;
        return $model->newQuery()->where('nota_id', $nota->id);
    }

    /*
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('itens-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->searching(false)
                    ->dom('Bfrtip')
                    ->orderBy(3)
                    ->buttons(
                        Button::make('create')->action("window.location = '".route('notas.index')."';")->text("<i class='fas fa-arrow-left'></i> Voltar"),
                        Button::make('excel')->text("<i class='fas fa-file-excel'></i> Exportar"),
                        Button::make('print')->text("<i class='fas fa-print'></i> Imprimir")
                    )
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
        $colunas = [
            Column::make('industria')->title('Industria'),
            Column::make('cliente')->title('Cliente'),
            Column::make('numero')->title('Nota'),
            Column::make('codigo_produto')->title('SKU'),
            Column::make('descricao')->title('Descrição'),
            Column::make('caixa_fardo')->title('Caixa/Fardo')->class('text-right'),
            Column::make('peso_liquido')->title('Peso Líquido')->class('text-right'),
            Column::make('armazenagem')->title('Armazenagem'),
            Column::make('cidade')->title('Cidade')
        ];
        if (request()->nota->industria->id == 2) {
            $colunas[] = Column::make('dun')->title('DUN'); 
        }
        return $colunas;
    }
    public function voltar()
    {
        return redirect()->route('notas.index');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Itens_' . date('d-m-y-Hi');
    }
}
