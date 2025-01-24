<?php

namespace App\DataTables;

use App\Models\Tobas;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TobasDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return view('admin.tobas.action', ['tobas' => $query]);
            })
            ->addColumn('gallery', function ($query) {
                if ($query->tobasGalleries) {
                    return view('admin.tobas.showGallery', ['tobas' => $query]);
                }
            })
            ->addColumn('id', function($row) {
                static $index = 0;
                return ++$index;
            })
            ->setRowId('id')->rawColumns(['image','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tobas $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('tobas-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                /*Button::make('reset'),
                Button::make('reload')*/
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('title'),
//            Column::make('image'),
            Column::make('slug'),
//            Column::make('details'),
            Column::computed('gallery')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tobas_' . date('YmdHis');
    }
}
