<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Community;
use Hexters\Ladmin\Supports\Datatables;
use Illuminate\Support\Facades\Blade;

class CommunityDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Communities List';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = Community::query()->with(['majors']);
    }

    public function ajax()
    {
        return route('ladmin.community.index', ['datatables']);
    }
    
    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query)
            ->editColumn('majors.name', function ($row) {
                $majors = $row->majors;
                $formattedMajors = '';
                foreach($majors as $major) {
                    $formattedMajors .= '<div class="d-inline rounded border border-info border-3 p-2 m-1">'.$major.'</div>';
                }
                $formattedMajors = $majors ? '<div class= "">'.$formattedMajors.'</div>'  : 'No association';
                return Blade::render($formattedMajors);
            })
            ->addColumn('action', function ($row) {
                return $this->action($row);
            });
    }

    public function action($data)
    {
        return ladmin()->view('community._parts.table-action', $data);
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
            'Associated Major(s)',
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
            ['data' => 'majors.name', 'orderable' => false],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }

    public function order()
    {
        //first column with asc
        return [[0, "asc"]];
    }
}
