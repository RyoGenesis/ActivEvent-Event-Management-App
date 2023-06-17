<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Category;
use Hexters\Ladmin\Supports\Datatables;

class CategoryDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Categories List';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = Category::query();
    }

    public function ajax()
    {
        return route('ladmin.category.index', ['datatables']);
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
        return ladmin()->view('category._parts.table-action', $data);
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
            'Display Name',
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
            ['data' => 'display_name',],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }

    public function order()
    {
        //first column with asc
        return [[0, "asc"]];
    }
}
