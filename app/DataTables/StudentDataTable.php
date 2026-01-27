<?php

namespace App\DataTables;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return view('admin.students.action', ['student' => $query]);
            })
            ->editColumn('picture', function ($row) {
                $imageUrl = asset($row->picture ?: 'no_image.jpg');
                return '<img src="' . $imageUrl . '"  height="35" class="rdm" />';
            })
            ->addColumn('id', function($row) {
                static $index = 0;
                return ++$index;
            })
            ->setRowId('id')
            ->rawColumns(['picture','action']);
    }

    public function query(Student $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('student-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
            ]);
    }

    public function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('picture'),
            Column::make('name'),
            Column::make('internship_year'),
            Column::make('education'),
            Column::make('service_attachment'),
            Column::make('internship_training'),
            Column::make('present_status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Student_' . date('YmdHis');
    }
}

