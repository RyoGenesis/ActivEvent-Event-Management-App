<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class FacultyMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.faculty.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Faculty';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-solid fa-screen-users'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access faculty menu';

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
        return ['ladmin.faculty.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.faculty.create', title: 'Create New Faculty', description: 'User can create new faculty data'),
            new Gate(gate: 'ladmin.faculty.update', title: 'Update Faculty', description: 'User can update faculty data'),
            new Gate(gate: 'ladmin.faculty.destroy', title: 'Delete Faculty', description: 'User can delete faculty data'),
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
