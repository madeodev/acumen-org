<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeadingTag extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $headingTag = new FieldsBuilder('heading_tag');

        $headingTag
            ->addSelect('heading_tag', [
                'label' => __('Heading Type', 'sage'),
                'default_value' => 'h2',
                'choices' => [
                    'h2' => 'H2', 
                    'h3' => 'H3',
                ],
                'wrapper' => ['width' => '50%'],
            ]);

        return $headingTag;
    }
}
