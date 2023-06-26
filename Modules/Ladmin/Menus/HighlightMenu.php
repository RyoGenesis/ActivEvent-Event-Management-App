<?php

namespace Modules\Ladmin\Menus;

use Hexters\Ladmin\Contracts\MenuDivider;
use Hexters\Ladmin\Menus\Gate;
use Hexters\Ladmin\Supports\BaseMenu;

class HighlightMenu extends BaseMenu
{

    /**
     * Gate name for accessing module
     *
     * @var string
     */
    protected $gate = 'ladmin.highlight.index';

    /**
     * Name of menu
     *
     * @var string
     */
    protected $name = 'Highlight';

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
    protected $description = 'User can access highlighted event menu';

    /**
     * Inspecting The Request Path / Route active
     * https://laravel.com/docs/master/requests#inspecting-the-request-path
     *
     * @var string
     */
    protected $isActive = 'highlight*';

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
        return ['ladmin.event.highlight.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Hexters\Ladmin\Menus\Gate)
     */
    protected function gates()
    {
        return [
            // new Gate(gate: 'ladmin.event.show', title: 'View Event Details', description: 'User can view details of an event'),
            new Gate(gate: 'ladmin.highlight.create', title: 'Highlight An Event', description: 'User can set an event to be highlighted'),
            new Gate(gate: 'ladmin.highlight.remove', title: 'Remove Highlighted Event', description: 'User can remove event from being highlighted'),
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
