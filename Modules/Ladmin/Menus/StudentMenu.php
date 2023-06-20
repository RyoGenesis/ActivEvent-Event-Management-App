<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class StudentMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.student_user.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Student';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-solid fa-user-graduate'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access student users menu';

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
        return ['ladmin.student_user.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.student_user.create', title: 'Create New Student User', description: 'User can create new student data'),
            new Gate(gate: 'ladmin.student_user.update', title: 'Update Student User', description: 'User can update student data'),
            new Gate(gate: 'ladmin.student_user.destroy', title: 'Delete Student User', description: 'User can delete student data'),
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
