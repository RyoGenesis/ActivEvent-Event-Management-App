<?php

namespace Modules\Ladmin\Datatables;

use App\Models\Event;
use App\Models\Model;
use Hexters\Ladmin\Supports\Datatables;
use Illuminate\Support\Facades\Blade;

class ApprovalDatatables extends Datatables
{

    /**
     * Page title
     *
     * @var String
     */
    protected $title = 'Waiting Approval';

    /**
     * Setup query builder
     */
    public function __construct()
    {
        $this->query = Event::query()->with(['community','category','majors'])->where('status','Draft');
    }

    public function ajax()
    {
        return route('ladmin.event.approval.index', ['datatables']);
    }
    
    /**
     * DataTables using Eloquent Builder.
     *
     * @return DataTableAbstract|EloquentDataTable
     */
    public function handle()
    {
        return $this->eloquent($this->query)
            ->editColumn('date', function ($row) {
                return $row->date->format('d/m/Y H:i');
            })
            ->editColumn('registration_end', function ($row) {
                return $row->registration_end->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d/m/Y H:i:s');
            })
            ->editColumn('community.name', function ($row) {
                return $row->community->display_name;
            })
            ->editColumn('majors.name', function ($row) {
                $majors = $row->majors;
                $formattedMajors = '';
                foreach($majors as $major) {
                    $formattedMajors .= '<div class="d-inline-flex rounded border border-info border-3 p-2 m-1">'.$major->name.'</div>';
                }
                $formattedMajors = !$majors->isEmpty() ? '<div class= "">'.$formattedMajors.'</div>'  : 'None';
                return Blade::render($formattedMajors);
            })
            ->editColumn('category.name', function ($row) {
                return $row->category->display_name;
            })
            ->editColumn('perks', function ($row) {
                $perks = '';
                if($row->has_certificate || $row->has_comserv || $row->has_sat) {
                    if($row->has_certificate) {
                        $perks .= '<span class="badge badge-lg text-bg-warning mb-1">Certificate</span>';
                    }
                    if($row->has_sat) {
                        $perks .= '<span class="badge badge-lg text-bg-warning mb-1">SAT Points</span>';
                    }
                    if($row->has_comserv) {
                        $perks .= '<span class="badge badge-lg text-bg-warning mb-1">Community Service Hours</span>';
                    }
                } else {
                    $perks = '-';
                }
                return Blade::render($perks);
            })
            ->editColumn('price', function ($row) {
                return $row->price == 0 ? 'Free' : number_format($row->price,2,',','.');
            })
            ->editColumn('status', function ($row) {
                $text = $row->status == 'Active' ? '<span class="fw-bold text-success">'.$row->status.'</span>' : '<span>'.$row->status.'</span>';
                return Blade::render($text);
            })
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
            'ID',
            'Name',
            'Community',
            'Related Major(s)',
            'Category',
            'Topic',
            'Location',
            'Event Date',
            'Registration End Date',
            'Provide Perk(s)',
            'Price (Rp.)',
            'Status',
            'Last Updated',
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
            ['data' => 'community.name',],
            ['data' => 'majors.name', 'orderable' => false],
            ['data' => 'category.name',],
            ['data' => 'topic',],
            ['data' => 'location',],
            ['data' => 'date',],
            ['data' => 'registration_end',],
            ['data' => 'perks', 'orderable' => false, "searchable" => false],
            ['data' => 'price',],
            ['data' => 'status',],
            ['data' => 'updated_at',],
            ['data' => 'action', 'class' => 'text-center', 'orderable' => false, "searchable" => false]
        ];
    }

    public function order()
    {
        //first column with asc
        return [[0, "asc"]];
    }
}
