<?php

namespace Modules\Ladmin\Datatables;

use App\Models\SatLevel;
use Hexters\Ladmin\Supports\Datatables;

class SatLevelDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'SAT Levels List';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = SatLevel::query();
    }

    public function ajax()
    {
        return route('ladmin.sat_level.index', ['datatables']);
    }
    
    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query)
            ->addColumn('action', function ($row) {
                return $this->action($row);
            });
    }

    public function action($data)
    {
        return ladmin()->view('sat_level._parts.table-action', $data);
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
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }

    public function order()
    {
        //first column with asc
        return [[0, "asc"]];
    }
}
