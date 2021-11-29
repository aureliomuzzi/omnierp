<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
                return '<a href="' . route('users.edit', $query) . '" class="btn btn-primary btn-xs"><i class="fas fa-pen text-xs px-1"></i></a>
                <a onclick="confirmarExclusao(this)" href="javascript:void(0)" data-rota="' . route('users.destroy', $query->id) . '" class="btn btn-danger btn-xs"><i class="fas fa-trash text-xs px-1"></i></a>';
            })
            ->editColumn('name', function($query) {
                return $query->name;
            })
            ->editColumn('email', function($query) {
                return $query->email;
            })
            ->editColumn('grupo', function($query) {
                switch ($query->grupo) {
                    case 'A':
                        return '<span class="badge badge-dark">Administrador</span>';
                        break;
                    case 'S':
                        return '<span class="badge badge-info">Supervisor</span>';
                        break;
                    case 'U':
                        return '<span class="badge badge-warning">Usuário</span>';
                        break;
                    case 'G':
                        return '<span class="badge badge-success">Gerente</span>';
                        break;
                    case '':
                        return '<span class="badge badge-secondary">Definir Acesso</span>';
                        break;
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
            ->rawColumns(['action', 'status', 'grupo']);;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('name')->title('Nome'),
            Column::make('email')->title('Email'),
            Column::make('grupo')->title('Privilégio de Acesso')->addClass('text-center'),
            Column::make('status')->title('Status')->addClass('text-center'),
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
        return 'User_' . date('YmdHis');
    }
}
