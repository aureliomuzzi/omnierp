<?php

namespace App\DataTables;

use App\Models\Funcionario;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FuncionarioDataTable extends DataTable
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
                return '<a href="' . route('funcionarios.edit', $query) . '" class="btn btn-outline-primary btn-xs"><i class="fas fa-pen text-xs px-1"></i></a>
                <a onclick="confirmarExclusao(this)" href="javascript:void(0)" data-rota="' . route('funcionarios.destroy', $query->id) . '" class="btn btn-outline-danger btn-xs"><i class="fas fa-trash text-xs px-1"></i></a>';
            })
            ->editColumn('foto', function($query) {
                if (isset($query->foto)) {
                    $url= asset($query->foto);
                    return '<img src="'.$url.'"border="0" width="60" height="60" class="img-rounded" align="center">';
                } else {
                    return '<img src="/images/avatar.png" width="60" height="40" class="img-rounded" align="center">';
                }
            })
            ->editColumn('nome', function($query) {
                return $query->nome;
            })
            ->editColumn('data_nascimento', function($query) {
                return $query->data_nascimento->format("d/m/Y");
            })
            ->editColumn('data_admissao', function($query) {
                return '<span class="badge badge-primary">' . $query->data_admissao->format("d/m/Y") . '</span>';
            })
            ->editColumn('data_demissao', function($query) {
                return isset($query->data_demissao) ? '<span class="badge badge-danger">' . $query->data_demissao->format("d/m/Y") . '</span>' : null;
            })
            ->editColumn('identidade', function($query) {
                return $query->identidade;
            })
            ->editColumn('cpf', function($query) {
                return $query->cpf_formatado;
            })
            ->rawColumns(['action', 'data_admissao', 'data_demissao', 'foto']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FuncionarioDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Funcionario $model)
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
                    ->setTableId('funcionario-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(2, 'asc')
                    ->buttons(
                        Button::make('excel')->text("<i class='fas fa-file-excel'></i> Excel"),
                        Button::make('pdf')->text("<i class='fas fa-file-pdf'></i> PDF"),
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
            Column::make('foto')->title('Foto'),
            Column::make('nome')->title('Nome'),
            Column::make('data_nascimento')->title('Data de Nascimento')->searchable(false)->addClass('text-center'),
            Column::make('data_admissao')->title('Admissão')->searchable(false)->addClass('text-center')->searchable(false),
            Column::make('data_demissao')->title('Demissão')->searchable(false)->addClass('text-center'),
            Column::make('identidade')->title('Identidade'),
            Column::make('cpf')->title('CPF'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Funcionario_' . date('YmdHis');
    }
}
