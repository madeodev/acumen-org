<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Year extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $year = new FieldsBuilder('year');

        $year
            ->addTaxonomy('year', [
                'label' => __('Year', 'sage'),
                'taxonomy' => 'acumen-year',
            ]);

        return $year;
    }
}
