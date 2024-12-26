<?php

namespace App\DataTables;

use App\Models\CareerApplication;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CareerApplicationDataTable extends DataTable
{
    protected $job_id;

    public function setParameters($job_id)
    {
        $this->job_id = $job_id;
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query)
    {
        if ($this->job_id) {
            $query->where('job_id',$this->job_id);
        }

        return (new EloquentDataTable($query))
            ->editColumn('resume_path', function ($row) {
//                $file = asset($row->resume_path ?: 'no_image.jpg');
                $file = Storage::url($row->resume_path);
                $file = url( $file); // Prepend "pro" to the base URL

                return '<a href="'.$file.'" title="Download Resume" target="_blank"
                       class="messageDetails" download data-bs-toggle="tooltip" data-bs-placement="top">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-download" style="color: #3945F8;">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                    </a>';
                })
                ->addColumn('id', function($row) {
                    static $index = 0;
                    return ++$index;
                })
                ->setRowId('id')
                ->rawColumns(['resume_path']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CareerApplication $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('careerapplication-table')
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
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('username'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('subject'),
            Column::make('resume_path')->title('Resume'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CareerApplication_' . date('YmdHis');
    }
}
