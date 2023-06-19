<?php

use Modules\Ladmin\Menus\Account;
use Modules\Ladmin\Menus\Access;
use Modules\Ladmin\Menus\CampusMenu;
use Modules\Ladmin\Menus\CategoryMenu;
use Modules\Ladmin\Menus\CommunityMenu;
use Modules\Ladmin\Menus\FacultyMenu;
use Modules\Ladmin\Menus\MajorMenu;
use Modules\Ladmin\Menus\System;

/**
 * Declaration your top parent of sidebar menu
 */

return [

    CampusMenu::class,

    FacultyMenu::class,

    MajorMenu::class,

    CommunityMenu::class,

    CategoryMenu::class,

    Account::class,

    Access::class,

    System::class
];
