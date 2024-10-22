<?php

namespace App\DataTables;

use App\Models\Job;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JobDataTable extends DataTable
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
                return view('admin.job.action', ['job' => $query]);
            })
            ->editColumn('details', function ($query) {
                return view('admin.job.message', ['job' => $query]);
            })
            ->editColumn('closing_date', function ($query) {
                return $query->closing_date->format('D, d M, Y');
            })
            ->editColumn('applications', function ($query) {
                return view('admin.job.applicationsLink', ['job' => $query]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Job $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('job-table')
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
//                        Button::make('reset'),
//                        Button::make('reload')
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
            Column::make('closing_date'),
            Column::make('details')
                ->orderable(false),
//            Column::make('created_at'),
//            Column::make('updated_at'),
            Column::make('applications'),
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
        return 'Job_' . date('YmdHis');
    }
}
