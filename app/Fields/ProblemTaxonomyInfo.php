<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProblemTaxonomyInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $problemTaxonomyInfo = new FieldsBuilder('problem_taxonomy_info');

        $problemTaxonomyInfo
            ->setLocation('taxonomy', '==', 'problem-tax');

        $problemTaxonomyInfo
            ->addPostObject('linked_problem_cpt', [
                'label' => __('Link to Impact Sector post', 'sage'),
                'post_type' => 'problem',
                'allow_null' => 1,
                'return_format' => 'id',
            ]);

        return $problemTaxonomyInfo->build();
    }
}
