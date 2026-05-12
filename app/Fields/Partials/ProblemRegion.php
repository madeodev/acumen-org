<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProblemRegion extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $problemRegion = new FieldsBuilder('problem_region');

        $problemRegion
            ->addTaxonomy('problem', [
                'label' => __('Impact Sector', 'sage'),
                'taxonomy' => 'problem-tax',
                'field_type' => 'multi_select',
            ])
            ->addTaxonomy('region', [
                'label' => __('Region', 'sage'),
                'taxonomy' => 'region-tax',
                'field_type' => 'multi_select',
            ]);

        return $problemRegion;
    }
}
