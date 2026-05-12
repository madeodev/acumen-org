<?php

namespace App\Fields;

use App\Fields\Partials\ProblemRegion;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProgramInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $programInfo = new FieldsBuilder('program_info', [
            'label' => __('Program Info', 'sage'),
            'position' => 'side'
        ]);

        $programInfo
            ->setLocation('post_type', '==', 'program');

        $programInfo
            ->addUrl('external_url', [
                'label' => __('External URL', 'sage'),
                'instructions' => __('If an external url is added, this program will open that link instead of the program page.'),
            ])
            ->addTaxonomy('type', [
                'label' => __('Program Type', 'sage'),
                'taxonomy' => 'program-type',
                'field_type' => 'multi_select',
            ])
            ->addFields($this->get(ProblemRegion::class))
            ->addImage('secondary_logo', [
                'label' => __('Secondary Logo', 'sage')
            ]);

        return $programInfo->build();
    }
}
