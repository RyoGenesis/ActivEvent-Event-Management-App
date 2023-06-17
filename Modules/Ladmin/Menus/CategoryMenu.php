<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class CategoryMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.category.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Category';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-solid fa-square-list'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access category menu';

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
        return ['ladmin.category.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.category.create', title: 'Create New Category', description: 'User can create new category data'),
            new Gate(gate: 'ladmin.category.update', title: 'Update Category', description: 'User can update category data'),
            new Gate(gate: 'ladmin.category.destroy', title: 'Delete Category', description: 'User can delete category data'),
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
