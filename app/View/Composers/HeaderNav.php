<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use App\Concerns\InteractsWithMenus;
use App\Providers\MenuServiceProvider;

class HeaderNav extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'partials.nav-desktop',
        'partials.nav-mobile',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {   
        $menus = new InteractsWithMenus;
        $util_nav_settings = $menus->getMenuSettings(MenuServiceProvider::UTILITY_NAVIGATION);

        return [
            'main_nav' => $menus->mainNavigation(),
            'util_nav' => $menus->utilityNavigation(),
            'util_intro' => $util_nav_settings['utility_navigation_intro'] ?? '',
        ];
    }
}
