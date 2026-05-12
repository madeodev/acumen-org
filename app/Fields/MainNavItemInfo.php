<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MainNavItemInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $mainNavItemInfo = new FieldsBuilder('main_nav_item_info');

        $mainNavItemInfo
            ->setLocation('nav_menu_item', '==', 'location/main_navigation');

        $mainNavItemInfo
            ->addTextarea('description', [
                'label' => __('Description', 'sage'),
            ])
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'instructions' => __('For submenu items only')
            ]);

        return $mainNavItemInfo->build();
    }
}
