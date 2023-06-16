<?php

namespace Modules\Ladmin\Datatables;

use Hexters\Ladmin\Supports\Datatables;

class AdminDatatables extends Datatables
{

    /**
     * Page Title
     *
     * @var String
     */
    protected $title = 'List of admin accounts';

    /**
     * Setup Query Builder
     */
    public function __construct()
    {
        $this->query = ladmin()->admin()->with(['roles','community']);
    }

    /**
     * Custom route to fetch data from Datatables
     *
     * @return String
     */
    public function ajax()
    {
        return route('ladmin.admin.index', ['datatables']);
    }

    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query)
            ->addColumn('avatar', function ($row) {
                return "<img src=\"{$row->gravatar}\" class=\"rounded-circle img-thumbnail\" width=\"45\" alt=\"Avatar\">";
            })
            ->editColumn('community.name', function ($row) {
                return $row->community->display_name;
            })
            ->editColumn('roles.name', function ($row) {
                return $row->roles->pluck('name');
            })
            ->addColumn('action', function ($row) {
                return $this->action($row);
            });
    }

    public function action($data)
    {
        return ladmin()->view('admin._parts.table-action', $data);
    }

    /**
     * Table headers
     *
     * @return array
     */
    public function headers(): array
    {
        return [
            'Avatar' => ['class' => 'text-end'],
            'Username',
            'Display Name',
            'Email',
            'Associated Community',
            'Roles',
            'Action',
        ];
    }

    /**
     * Datatables Data column
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            ['data' => 'avatar', 'class' => 'text-center'],
            ['data' => 'username'],
            ['data' => 'display_name'],
            ['data' => 'email'],
            ['data' => 'community.name'],
            ['data' => 'roles.name', 'orderable' => false],
            ['data' => 'action', 'class' => 'text-end', 'orderable' => false]
        ];
    }
}
