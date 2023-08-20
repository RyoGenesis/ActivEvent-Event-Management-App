<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Event;
use App\Models\User;
use Hexters\Ladmin\Supports\Datatables;
use Illuminate\Support\Facades\Blade;

class ParticipantDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Participant List';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        // $this->query = User::query()->with(['campus','faculty','major']);
    }

    public function ajax()
    {
        return route('ladmin.event.participant.index', ['datatables', 'id' => request()->route('id')]);
    }
    
    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        $event = Event::with(['users' => ['campus','faculty','major','communities']])->where('id',$this->data['id'])->first();
        $this->query = $event->users;
        return $this->collection($this->query)
            ->editColumn('personal_email', function ($row) {
                return $row->personal_email ?? '-';
            })
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
                if ($communities->isEmpty()) {
                    $formattedComms = 'No community association';
                } else {
                    foreach($communities as $community) {
                        if (end($communities) == $community) {
                            $formattedComms .= $community->name;
                        } else {
                            $formattedComms .= $community->name.', ';
                        }
                    }
                }
                return Blade::render($formattedComms);
            })
            ->addColumn('action', function ($row) {
                return $this->action($row);
            });
    }

    public function action($data)
    {
        return ladmin()->view('event._parts.participant-table-action', $data);
    }

    /**
     * Table headers
     *
     * @return array
     */
    public function headers(): array
    {
        return [
            'NIM',
            'Name',
            'Email',
            'Personal Email',
            'Phone',
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
            ['data' => 'nim',],
            ['data' => 'name',],
            ['data' => 'email',],
            ['data' => 'personal_email',],
            ['data' => 'phone',],
            ['data' => 'campus.name',],
            ['data' => 'faculty.name',],
            ['data' => 'major.name',],
            ['data' => 'communities.name', 'orderable' => false],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false]
        ];
    }

    public function order()
    {
        //first column with asc
        return [[0, "asc"]];
    }
}
