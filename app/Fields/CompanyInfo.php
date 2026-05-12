<?php

namespace App\Fields;

use App\Fields\Partials\ProblemRegion;
use App\Fields\Partials\Year;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CompanyInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $companyInfo = new FieldsBuilder('company_info', [
            'label' => __('Company Info', 'sage'),
            'position' => 'side'
        ]);

        $companyInfo
            ->setLocation('post_type', '==', 'company');

        $companyInfo
            ->addLink('title_button', [
                'label' => __('Title Button', 'sage'),
            ])            
            ->addTaxonomy('status', [
                'label' => __('Investment Status', 'sage'),
                'taxonomy' => 'company-status',
            ])
            ->addFields($this->get(ProblemRegion::class))
            ->addFields($this->get(Year::class));

        return $companyInfo->build();
    }
}
