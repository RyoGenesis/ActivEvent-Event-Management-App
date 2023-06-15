<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Model;
use Hexters\Ladmin\Supports\Datatables;
use Illuminate\Support\Facades\Blade;

class CategoryDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Page Title';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = Model::query();
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
                return Blade::render('<a href="">Button</a>');
            });
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
}
