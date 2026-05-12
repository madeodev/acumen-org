<?php

namespace App\Fields;

use App\Fields\Partials\Year;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FoundryInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $foundryInfo = new FieldsBuilder('foundry_info', [
            'label' => __('Foundry Info', 'sage'),
        ]);

        $foundryInfo
            ->setLocation('post_type', '==', 'foundry');

        $foundryInfo
            ->addText('first_name', [
                'label' => __('First Name', 'sage'),
                'wrapper' => ['width' => '50%'],
            ])
            ->addText('last_name', [
                'label' => __('Last Name', 'sage'),
                'wrapper' => ['width' => '50%'],
            ])
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'wrapper' => ['width' => '50%'],
            ])
            ->addTrueFalse('angel', [
                'label' => __('Angel', 'sage'),
                'wrapper' => ['width' => '50%'],
            ])
            ->addUrl('link', [
                'label' => __('Bio Link', 'sage'),
            ])
            ->addTaxonomy('fellowship', [
                'label' => __('Fellowship Program', 'sage'),
                'taxonomy' => 'fellowship',
                'wrapper' => ['width' => '50%'],
            ])
            ->addFields($this->get(Year::class))
                ->modifyField('year', [
                    'wrapper' => ['width' => '50%'],
                ]);

        return $foundryInfo->build();
    }
}
