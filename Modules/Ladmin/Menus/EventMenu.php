<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class EventMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'event.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Events';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-regular fa-calendar-days'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access event menu modules';

    /**
     * Inspecting The Request Path / Route active
     * https://laravel.com/docs/master/requests#inspecting-the-request-path
     *
     * @var string
     */
    protected $isActive = '';

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
        return null;
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            // new Gate(gate: 'gate.menu.uniq', title: 'Gate Title', description: 'Description of gate'),
        ];
    }

    /**
     * Other menus
     *
     * @return void
     */
    protected function submenus()
    {
        return [
            HighlightMenu::class,
            ApprovalEventMenu::class,
            ManageEventMenu::class,
        ];
    }
}
