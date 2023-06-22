<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Event;
use App\Models\Model;
use Hexters\Ladmin\Supports\Datatables;
use Illuminate\Support\Facades\Blade;

class EventDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Events List';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = Event::query();
    }

    public function ajax()
    {
        return route('ladmin.event.index', ['datatables']);
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
        return ladmin()->view('event._parts.table-action', $data);
    }

    /**
     * Table headers
     *
     * @return array
     */
    public function headers(): array
    {
        return [
            'id',
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
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }

    public function order()
    {
        //first column with asc
        return [[0, "asc"]];
    }
}
