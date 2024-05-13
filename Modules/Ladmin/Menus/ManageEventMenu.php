<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class ManageEventMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.event.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Manage Event';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = null; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access event management menu';

    /**
     * Inspecting The Request Path / Route active
     * https://laravel.com/docs/master/requests#inspecting-the-request-path
     *
     * @var string
     */
    protected $isActive = 'event*';

    /**
     * Menu ID
     *
     * @var string
     */
    protected $id = '';

    /**
     * Route name
     *
     * @return Array|string|null
     * @example ['route.name', ['uuid', 'foo' => 'bar']]
     */
    protected function route()
    {
        return ['ladmin.event.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.event.show', title: 'View Event Details', description: 'User can view details of an event'),
            new Gate(gate: 'ladmin.event.create', title: 'Create New Event', description: 'User can create new event'),
            new Gate(gate: 'ladmin.event.update', title: 'Update Event', description: 'User can update event informations'),
            new Gate(gate: 'ladmin.event.destroy', title: 'Cancel Event', description: 'User can delete / cancel an event'),
            new Gate(gate: 'ladmin.event.participant', title: 'View & Manage Participants', description: "User can view and manage event's participants data"),
        ];
    }

    /**
     * Other menus
     *
     * @return void
     */
    protected function submenus()
    {
        return [];
    }
}
