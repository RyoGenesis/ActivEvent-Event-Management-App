<?php

namespace Modules\Ladmin\Datatables;

use App\Models\User;
use Hexters\Ladmin\Supports\Datatables;
use Illuminate\Support\Facades\Blade;

class StudentUserDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Student Users List';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = User::query()->with(['campus','faculty','major','communities']);
    }
    
    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query)
            ->editColumn('campus.name', function ($row) {
                return $row->campus->name;
            })
            ->editColumn('faculty.name', function ($row) {
                return $row->faculty->name;
            })
            ->editColumn('major.name', function ($row) {
                return $row->major->name;
            })
            ->editColumn('communities.name', function ($row) {
                $communities = $row->communities;
                $formattedComms = '';
                foreach($communities as $community) {
                    $formattedComms .= '<div class="d-inline rounded border border-info border-3 p-2 m-1">'.$community.'</div>';
                }
                $formattedComms = $communities ? '<div class= "">'.$formattedComms.'</div>'  : 'No community';
                return Blade::render($formattedComms);
            })
            ->addColumn('action', function ($row) {
                return Blade::render('<a href="">Button</a>');
            });
    }

    public function action($data)
    {
        return ladmin()->view('student_user._parts.table-action', $data);
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
            'Email',
            'Phone',
            'NIM',
            'Campus',
            'Faculty',
            'Major',
            'Communities',
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
            ['data' => 'email',],
            ['data' => 'phone',],
            ['data' => 'nim',],
            ['data' => 'campus.name',],
            ['data' => 'faculty.name',],
            ['data' => 'major.name',],
            ['data' => 'communities.name', 'orderable' => false],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }
}
