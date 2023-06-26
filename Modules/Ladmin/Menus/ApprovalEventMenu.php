<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class ApprovalEventMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.approval.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Approval';

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
    protected $description = 'User can access event approval menu';

    /**
     * Inspecting The Request Path / Route active
     * https://laravel.com/docs/master/requests#inspecting-the-request-path
     *
     * @var string
     */
    protected $isActive = 'approval*';

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
        return ['ladmin.event.approval.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.approval.approve', title: 'Approve Event', description: 'User can approve event to be public'),
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
