<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Colors\Colorways;
use App\Concerns\Colors\ModuleBgColors;

class ModuleBackground extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $moduleBackground = new FieldsBuilder('module_background');

        $moduleBackground

        ->addButtonGroup('module_background', [
            'label' => __('Background Type', 'sage'),
            'choices' => [
                'media' => __('Image / Video', 'sage'),
                'color' => __('Color', 'sage'),
            ],
            'default_value' => 'media',
        ])
        ->addFields($this->get(ImageOrVideo::class))
            ->modifyField('media_type', [
                'conditional_logic' => [
                    [
                        'field' => 'module_background',
                        'operator' => '==',
                        'value' => 'media'
                    ]
                ]
            ])
        ->addRadio('color', [
            'label' => __('Color', 'sage'),
            'default_value' => 'black'
        ])
            ->addChoices((new ModuleBgColors())->getColorOptions())
            ->conditional('module_background', '==', 'color');

        return $moduleBackground;
    }

    public static function getFields()
    {

        $type = get_field('module_background') ?? 'media';
        $colors = $type === 'media' ? 'black' : get_field('color');

        $imageOrVideoFields = ImageOrVideo::getFields();

        return [
            'module_bg' => get_field('module_background') ?? 'media',
            'colors' => new Colorways($colors ?? 'black'),
            ...$imageOrVideoFields,
        ];
    }
}
