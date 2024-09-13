<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
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
                return view('admin.slider.action', ['slider' => $query]);
            })
            ->editColumn('image', function ($row) {
                $imageUrl = asset($row->image ?: 'no_image.jpg');
                return '<img src="' . $imageUrl . '"  height="35" class="rdm" />';//width="50"
            })
            ->editColumn('details', function ($query) {
                return view('admin.slider.message', ['slider' => $query]);
            })
            ->setRowId('id')->rawColumns(['image','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model)
    {
        return $model->newQuery()->orderBy('display_order','asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('slider-table')
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
            Column::make('image'),
            Column::make('slink')->title('Slider Link'),
            Column::make('details')->title('Slider Details'),
            /*Column::make('created_at'),
            Column::make('updated_at'),*/
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
        return 'Slider_' . date('YmdHis');
    }
}
