<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class RegionTaxonomyInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $regionTaxonomyInfo = new FieldsBuilder('region_taxonomy_info');

        $regionTaxonomyInfo
            ->setLocation('taxonomy', '==', 'region-tax');

        $regionTaxonomyInfo
            ->addPostObject('linked_region_cpt', [
                'label' => __('Link to Region post', 'sage'),
                'post_type' => 'region',
                'allow_null' => 1,
                'return_format' => 'id',
            ]);

        return $regionTaxonomyInfo->build();
    }
}
