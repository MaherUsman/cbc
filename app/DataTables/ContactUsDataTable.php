<?php

namespace App\DataTables;

use App\Models\ContactU;
use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactUsDataTable extends DataTable
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
                return view('admin.contactUs.action', ['contactUs' => $query]);
            })
            ->editColumn('details', function ($query) {
                return view('admin.contactUs.message', ['contactUs' => $query]);
            })
            ->addColumn('id', function($row) {
                static $index = 0;
                return ++$index;
            })
            ->setRowId('id')->rawColumns(['details', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ContactUS $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('contactus-table')
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

//            Column::make('id'),
            Column::make('full_name'),
            Column::make('email'),
            Column::make('phone_number'),
            Column::make('subject'),
            Column::make('details')->title('message'),
//            Column::make('created_at'),
//            Column::make('updated_at'),
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
        return 'ContactUs_' . date('YmdHis');
    }
}
