<?php

namespace App\Concerns;

use App\Models\NavItem;
use App\Providers\MenuServiceProvider;
use App\Concerns\Translation;

class InteractsWithMenus
{
    /**
     * @var false|array
     */
    protected $menu_locations;

    public function __construct()
    {
        $this->menu_locations = once(function () {
            return get_nav_menu_locations();
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function mainNavigation()
    {
        return $this->getMenuItemsWithChildren(MenuServiceProvider::MAIN_NAVIGATION, 2);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function utilityNavigation()
    {
        return $this->getMenuItemsWithChildren(MenuServiceProvider::UTILITY_NAVIGATION, 1);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function footerNavigation()
    {
        return $this->getMenuItemsWithChildren(MenuServiceProvider::FOOTER_NAVIGATION, 2);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function footerUtilityNavigation()
    {
        return $this->getMenuItemsWithChildren(MenuServiceProvider::FOOTER_UTILITY_NAVIGATION, 1);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function socialNavigation()
    {
        return $this->getMenuItemsWithChildren(MenuServiceProvider::SOCIAL_NAVIGATION, 1);
    }

    /**
     * get menu settings field linked to a specific nav location
     *
     * @return array
     */
    public function getMenuSettings($location)
    {
        if (!isset($this->menu_locations[$location])) {
            return;
        }

        $object = wp_get_nav_menu_object($this->menu_locations[$location]);
        return (new Translation)->getAllOptionsFieldValue($object);
    }

    /**
     * @param $location
     * @param $menuDepth
     * @return \Illuminate\Support\Collection
     */
    public function getMenuItemsWithChildren($location, $menuDepth)
    {
        return once(function () use ($location, $menuDepth) {
            if (!isset($this->menu_locations[$location])) {
                return collect();
            }

            $menuItems = (new Translation)->getTranslatedMenu($this->menu_locations[$location]);

            $groupedByParent = collect($menuItems)->groupBy('menu_item_parent');

            return !empty($groupedByParent[0]) ? $this->buildNavArray($groupedByParent[0], $groupedByParent, $menuDepth) : [];
        });
    }

    /**
     * Build a nav array to a specified depth
     * @return \Illuminate\Support\Collection
     */
    private function buildNavArray($collection, $groupedByParent, $desiredDepth, $depth = 1)
    {
        return collect($collection)->map(function ($navMenuItem) use (
            $groupedByParent,
            $desiredDepth,
            $depth
        ) {
            if ($desiredDepth < $depth) {
                return;
            }
            $children = $groupedByParent->get($navMenuItem->ID, collect());

            $navMenuItem->children = $this->buildNavArray($children, $groupedByParent, $desiredDepth, $depth + 1);

            return NavItem::serialize($navMenuItem);
        });
    }
}
