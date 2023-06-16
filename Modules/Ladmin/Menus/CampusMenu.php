<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class CampusMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.campus.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Campus';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-solid fa-school'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access menu campus';

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
        return ['ladmin.campus.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.campus.create', title: 'Create New Campus', description: 'User can create new campus data'),
            new Gate(gate: 'ladmin.campus.update', title: 'Update Campus', description: 'User can update campus data'),
            new Gate(gate: 'ladmin.campus.destroy', title: 'Delete Campus', description: 'User can delete campus data'),
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
