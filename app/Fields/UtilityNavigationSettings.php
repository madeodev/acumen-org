<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class UtilityNavigationSettings extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $utilityNavigationSettings = new FieldsBuilder('utility_navigation_settings', [
            'title' => __('Utility Navigation Settings', 'menus'),
        ]);

        $utilityNavigationSettings
            ->setLocation('nav_menu', '==', 'location/utility_navigation');
        
        $utilityNavigationSettings
        ->addMessage('message_field', '', [
            'label' => __('About this menu', 'sage'),
            'message' => __('This menu appears above the main nav as a simple list of links with introductory text.
            This menu location includes support for a single level. Any sub-menu items will be ignored.','sage'),
            'new_lines' => 'br',
        ])
        ->addText('utility_navigation_intro', [
            'label' => __('Menu intro text', 'sage'),
            'default_value' => __('Acumen for', 'sage'),
        ]);


        return $utilityNavigationSettings->build();
    }
}
