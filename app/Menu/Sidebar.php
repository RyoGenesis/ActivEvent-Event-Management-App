<?php

use Modules\Ladmin\Menus\Account;
use Modules\Ladmin\Menus\Access;
use Modules\Ladmin\Menus\CampusMenu;
use Modules\Ladmin\Menus\CategoryMenu;
use Modules\Ladmin\Menus\System;

/**
 * Declaration your top parent of sidebar menu
 */

return [

    CampusMenu::class,

    CategoryMenu::class,

    Account::class,

    Access::class,

    System::class
];
