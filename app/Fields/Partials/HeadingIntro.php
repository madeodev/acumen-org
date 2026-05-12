<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeadingIntro extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $headingIntro = new FieldsBuilder('heading_intro');

        $headingIntro
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'instructions' => __('It is recommended to use a minimum of 20 characters.', 'sage'),
            ])
            ->addText('introduction', [
                'label' => __('Introduction', 'sage'),
                'instructions' => __('It is recommended to use a minimum of 80 characters.', 'sage'),
            ])
            ->addLink('button', [
                'label' => __('Button', 'sage'),
            ]);

        return $headingIntro;
    }
}
