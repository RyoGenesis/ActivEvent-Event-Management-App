<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class SatLevelMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.sat_level.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'SAT Level';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-solid fa-chart-pyramid'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access SAT level menu';

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
        return ['ladmin.sat_level.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.sat_level.create', title: 'Create New SAT Level', description: 'User can create new SAT level data'),
            new Gate(gate: 'ladmin.sat_level.update', title: 'Update SAT Level', description: 'User can update SAT level data'),
            new Gate(gate: 'ladmin.sat_level.destroy', title: 'Delete SAT Level', description: 'User can delete SAT level data'),
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
