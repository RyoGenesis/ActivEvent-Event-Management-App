<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Major;
use Hexters\Ladmin\Supports\Datatables;

class MajorDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Majors List';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = Major::query()->with(['faculty']);
    }
    
    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query)
            ->editColumn('faculty.name', function ($row) {
                return $row->faculty->name;
            })
            ->addColumn('action', function ($row) {
                return $this->action($row);
            });
    }

    public function action($data)
    {
        return ladmin()->view('major._parts.table-action', $data);
    }

    /**
     * Table headers
     *
     * @return array
     */
    public function headers(): array
    {
        return [
            'ID',
            'Name',
            'Faculty',
            'Action' => ['class' => 'text-center'],
        ];
    }

    /**
     * Datatables Data column
     * Visit Doc: https://datatables.net/reference/option/columns.data#Default
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            ['data' => 'id', 'class' => 'text-center'],
            ['data' => 'name',],
            ['data' => 'faculty.name',],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }
}
