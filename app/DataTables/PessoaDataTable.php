<?php

namespace App\DataTables;

use App\Models\Pessoa;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Helpers\FuncoesHelper;

class PessoaDataTable extends DataTable
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
                return '<a href="' . route('pessoas.edit', $query) . '" class="btn btn-primary btn-xs"><i class="fas fa-pen text-xs px-1"></i></a>
                <a onclick="confirmarExclusao(this)" href="javascript:void(0)" data-rota="' . route('pessoas.destroy', $query->id) . '" class="btn btn-danger btn-xs"><i class="fas fa-trash text-xs px-1"></i></a>';
            })
            ->editColumn('cpf_cnpj', function($query) {
                return $query->tipo == "PF" ? $query->cpf : $query->cnpj;
            })
            ->editColumn('tipo', function($query) {
                return $query->tipo;
            })
            ->editColumn('cliente', function($query) {
                if ($query->cliente == 1) {
                    return '<span class="badge badge-primary"> Sim </span>';
                } else {
                    return '<span class="badge badge-danger"> Não </span>';
                }
            })
            ->editColumn('fornecedor', function($query) {
                if ($query->fornecedor == 1) {
                    return '<span class="badge badge-warning"> Sim </span>';
                } else {
                    return '<span class="badge badge-danger"> Não </span>';
                }
            })
            ->editColumn('transportador', function($query) {
                if ($query->transportador == 1) {
                    return '<span class="badge badge-success"> Sim </span>';
                } else {
                    return '<span class="badge badge-danger"> Não </span>';
                }
            })
            ->editColumn('status', function($query) {
                if ($query->status_formatado == "Ativo") {
                    return '<span class="badge badge-primary"> Ativo </span>';
                } else {
                    return '<span class="badge badge-danger"> Inativo </span>';
                }
            })
            ->editColumn('created_at', function($query) {
                return $query->created_at->format("d/m/Y H:i");
            })
            ->editColumn('updated_at', function($query) {
                return $query->updated_at->format("d/m/Y H:i");
            })
            ->rawColumns(['action', 'cliente','fornecedor','transportador', 'status', 'cpf_cnpj']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pessoa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pessoa $model)
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
                    ->setTableId('pessoa-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel')->text("<i class='fas fa-file-excel'></i> Exportar Excel"),
                        Button::make('print')->text("<i class='fas fa-print'></i> Imprimir"),
                        Button::make('create')->text("<i class='fas fa-plus'></i> Novo Registro"),
                    )
                    ->parameters([
                        "language" => [
                            "url" => "/js/translate_pt-br.json"
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
            Column::make('action')->title('Ações')->searchable(false)->orderable(false),
            Column::make('nome'),
            Column::make('cpf_cnpj')->title('Documento'),
            Column::make('tipo')->title('Tipo'),
            Column::make('cliente')->searchable(false)->orderable(false)->addClass('text-center'),
            Column::make('fornecedor')->searchable(false)->orderable(false)->addClass('text-center'),
            Column::make('transportador')->searchable(false)->orderable(false)->addClass('text-center'),
            Column::make('status')->searchable(false)->orderable(false)->addClass('text-center'),
            Column::make('created_at')->title('Cadastro')->addClass('text-center'),
            Column::make('updated_at')->title('Atualizado')->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pessoa_' . date('YmdHis');
    }
}
