<?php

namespace App\Fields;

use App\Fields\Partials\MediaFormat;
use App\Fields\Partials\ProblemRegion;
use App\Fields\Partials\Stats;
use App\Fields\Partials\StatsSettings;
use App\Fields\Partials\Year;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CaseStudyInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $caseStudyInfo = new FieldsBuilder('case_study_info', [
            'label' => __('Case Study Info', 'sage'),
            'position' => 'side'
        ]);

        $caseStudyInfo
            ->setLocation('post_type', '==', 'case-study');

        $caseStudyInfo
            ->addFields($this->get(MediaFormat::class))
            ->addTaxonomy('type', [
                'label' => __('Case Study Type', 'sage'),
                'taxonomy' => 'case-study-type',
            ])
            ->addFields($this->get(ProblemRegion::class))
            ->addFields($this->get(Year::class))
            ->addGroup('stats', [
                'label' => __('Stats', 'sage'),
            ])
                ->addFields($this->get(Stats::class))
                    ->modifyField('stats', [
                        'max' => 2,
                    ])
                ->addFields($this->get(StatsSettings::class))
            ->endGroup();

        return $caseStudyInfo->build();
    }
}
