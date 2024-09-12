<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query)
    {
        return (new EloquentDataTable($query))
//            ->addColumn('action', 'users.action')
            ->editColumn('role', function ($q) {
                $firstRoleName = $q->getRoleNames()->first();
                return ucfirst($firstRoleName) ?: 'N/A';
            })
            ->addColumn('pic', function ($q) {
                $url = asset($q->pic ?: "images/no-img-avatar.png");
                return '<img src="' . $url . '" border="0" width="40" align="center" style="width: 50px; height: 50px; border-radius: 50px;" />';
            })
            ->addColumn('action', function ($q) {
                $route = route('user.edit', $q);
                $deleteRoute = route('user.destroy', $q);
                $editButton = '<a class="btn btn-primary btn-xs" href="' . $route . '"><i class="fa fa-edit"></i></a>';
                //$deleteButton = '<button class="btn btn-danger btn-xs" data-method="DELETE" type="button" data-href="' . $deleteRoute . '" onclick="showConfirmationAlert(this)"><i class="fa fa-trash"></i></button>';
                if (auth()->user()->id == $q->id) {
                    $deleteButton = '';
                } else {
                    $deleteButton = '<button class="btn btn-danger btn-xs deleteRecord" data-url="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>';
                }
                return $editButton . $deleteButton;
            })
            ->setRowId('id')->rawColumns(['pic', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns()
    {
        return [
            Column::make('id'),
            Column::computed('pic')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('role'),
//            Column::make('username'),
            Column::make('email'),
//            Column::make('phone'),
//            Column::make('created_at'),
//            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
