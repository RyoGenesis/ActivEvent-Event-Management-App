<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class MajorMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.major.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Major';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-solid fa-graduation-cap'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access major menu';

    /**
     * Inspecting The Request Path / Route active
     * https://laravel.com/docs/master/requests#inspecting-the-request-path
     *
     * @var string
     */
    protected $isActive = 'major*';

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
        return ['ladmin.major.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.major.create', title: 'Create New Major', description: 'User can create new major data'),
            new Gate(gate: 'ladmin.major.update', title: 'Update Major', description: 'User can update major data'),
            new Gate(gate: 'ladmin.major.destroy', title: 'Delete Major', description: 'User can delete major data'),
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
