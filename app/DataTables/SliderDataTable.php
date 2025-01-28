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
            ->editColumn('media', function ($row) {
                $url = asset($row->image); // Adjust this if you store videos in a different column
                $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $row->image);

                $icon = $isImage
                    ? '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image" style="color: #3945F8;">
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                      <circle cx="8.5" cy="8.5" r="1.5"></circle>
                      <path d="M21 15l-5-5L5 21"></path>
                   </svg>'
                    : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video" style="color: #3945F8;">
                      <polygon points="23 7 16 12 23 17 23 7"></polygon>
                      <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                   </svg>';

                return '<a href="' . $url . '" target="_blank">' . $icon . '</a>';
            })
            ->editColumn('details', function ($query) {
                return view('admin.slider.message', ['slider' => $query]);
            })
            ->addColumn('id', function($row) {
                static $index = 0;
                return ++$index;
            })
            ->setRowId('id')->rawColumns(['media','action']);
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
//            Column::make('title'),
//            Column::make('image'),
            Column::make('slink')->title('Slider Link'),
            Column::make('details')->title('Slider Details'),
            Column::make('media')->title('Media'), // New column for image/video
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
