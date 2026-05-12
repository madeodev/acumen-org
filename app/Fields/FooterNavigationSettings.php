<?php

namespace App\Fields;

use App\Fields\Partials\Form;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FooterNavigationSettings extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $footerNavigationSettings = new FieldsBuilder('footer_navigation_settings', [
            'title' => __('Footer Navigation Settings', 'menus'),
        ]);

        $footerNavigationSettings
            ->setLocation('nav_menu', '==', 'location/footer_navigation');

        $footerNavigationSettings
            ->addMessage('message_field', '', [
                'label' => __('About this menu', 'sage'),
                'message' => __('This menu location includes support for 2 levels. Any menu items added below the 2nd level will be ignored. 
                    (Parent > Child > Ignored).','sage'),
                'new_lines' => 'br',
            ])
            ->addText('heading', [
                'label' => __('Form Heading', 'sage')
            ])
            ->addFields($this->get(Form::class));

        return $footerNavigationSettings->build();
    }
}
