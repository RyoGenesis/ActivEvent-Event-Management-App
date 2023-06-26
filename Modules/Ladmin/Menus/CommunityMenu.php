<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class CommunityMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.community.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Community';

    /**
     * Font icons 
     *
     * @var string
     */
    protected $icon = 'fa-solid fa-users'; // fontawesome

    /**
     * Menu description
     *
     * @var string
     */
    protected $description = 'User can access community menu';

    /**
     * Inspecting The Request Path / Route active
     * https://laravel.com/docs/master/requests#inspecting-the-request-path
     *
     * @var string
     */
    protected $isActive = 'community*';

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
        return ['ladmin.community.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.community.create', title: 'Create New Community', description: 'User can create new community data'),
            new Gate(gate: 'ladmin.community.update', title: 'Update Community', description: 'User can update community data'),
            new Gate(gate: 'ladmin.community.destroy', title: 'Delete Community', description: 'User can delete community data'),
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
