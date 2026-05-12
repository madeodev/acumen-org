<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MainNavigationSettings extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $mainNavigationSettings = new FieldsBuilder('main_navigation_settings', [
            'title' => __('Main Navigation Settings', 'menus'),
        ]);

        $mainNavigationSettings
            ->setLocation('nav_menu', '==', 'location/main_navigation');
        
        $mainNavigationSettings
        ->addMessage('message_field', '', [
            'label' => __('About this menu', 'sage'),
            'message' => __('This menu location includes support for 2 levels. Any menu items added below the 2nd level will be ignored. 
                (Parent > Child > Ignored).
                The last menu item will show as a button to the right of the search button.
                Use the "Open in new tab" checkbox on any menu item to control whether it opens in a new browser tab.','sage'),
            'new_lines' => 'br',
        ]);


        return $mainNavigationSettings->build();
    }
}
