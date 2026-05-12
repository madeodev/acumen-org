<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeadingLevel extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $headingLevel = new FieldsBuilder('heading_level');

        $headingLevel
            ->addSelect('heading_level', [
                'label' => __('Heading Level', 'sage'),
                'instructions' => __('Select the level of the primary heading.', 'sage'),
                'default_value' => 2,
                'return_format' => 'value'
            ])
                ->addChoices([
                    [1 => __('H1', 'sage')],
                    [2 => __('H2', 'sage')],
                    [3 => __('H3', 'sage')],
                    [4 => __('H4', 'sage')],
                    [5 => __('H5', 'sage')],
                ]);

        return $headingLevel;
    }

        /**
     * Return the fieldset
     * 
     * @return array
     */
    public static function getFields()
    {
        $heading_level = (int)get_field('heading_level') ?: 2;

        return [
            'heading_primary'  => 'h' . strval($heading_level),
            'heading_secondary' => 'h' . strval(($heading_level + 1)),
        ];
    }
}
