<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\Video;

class HeroSettings extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $heroSettings = new FieldsBuilder('hero_settings', [
            'position' => 'side',
            'menu_order' => -1
        ]);

        $heroSettings
            ->setLocation('post_type', '==', 'post')
            ->or('post_type', '==', 'news')
            ->or('post_type', '==', 'case-study')
            ->or('post_type', '==', 'report');

        $heroSettings
            ->addButtonGroup('featured_image_location', [
                'label' => 'Featured Image Location',
                'instructions' => 'Select to display the featured image above or below the title.',
                'default_value' => 'below',
                'choices' => [
                    'below' => __('Below', 'sage'),
                    'above' => __('Above', 'sage'),
                    'side' => __('Side', 'sage'),
                ],
            ])
            ->addTrueFalse('show_video', [
                'label' => 'Show Video',
                'instructions' => 'Toggle to display a video loop in the hero section.',
                'default_value' => 0,
                'ui_on_text' => 'Show',
                'ui_off_text' => 'Hide',
            ])
            ->addFields($this->get(Video::class))
                ->modifyField('webm', [
                    'conditional_logic' => [
                        [
                            'field' => 'show_video',
                            'operator' => '==',
                            'value' => 1
                        ]
                    ]
                ])
                ->modifyField('mp4', [
                    'conditional_logic' => [
                        [
                            'field' => 'show_video',
                            'operator' => '==',
                            'value' => 1
                        ]
                    ]
                ]);

        return $heroSettings->build();
    }
}
