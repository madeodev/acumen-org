<?php

namespace App\Fields;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\ColorwaysDark;
use App\Concerns\Colors\ColorwaysLight;
use App\Fields\Partials\ProblemRegion;
use App\Fields\Partials\Stats;
use App\Fields\Partials\StatsSettings;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProblemInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $problemInfo = new FieldsBuilder('problem_info', [
            'label' => __('Impact Sector Info', 'sage'),
            'position' => 'side'
        ]);

        $problemInfo
            ->setLocation('post_type', '==', 'problem');

        $problemInfo
            ->addMessage('about', '', [
                'label' => __('About the Impact Sector', 'sage'),
                'message' => __('Note that the Excerpt is displayed prominently in the map.', 'sage'),
            ])
            ->addFields($this->get(ProblemRegion::class))
                ->modifyField('problem', [
                    'instructions' => __('Select the corresponding Impact Sector taxonomy term.', 'sage'),
                    'field_type' => 'select',
                    'required' => 1,
                    'bidirectional' => 1,
                    'bidirectional_target' => [
                        'field_problem_taxonomy_info_linked_problem_cpt',
                    ],
                ])
            ->addGroup('stats', [
                'label' => __('Stats', 'sage'),
            ])
                ->addFields($this->get(Stats::class))
                ->addFields($this->get(StatsSettings::class))
            ->endGroup()
            ->addLink('custom_link', [
                'label' => __('Custom Link', 'sage'),
                'instructions' => __('Add a link here to have this impact sector\'s entry on the interactive map link to somewhere other than the impact sector page. The "Link Text" you enter hear will be used in place of the default "Learn More" button title.', 'sage'),
                'default_value' => [
                    'title' => 'Learn More'
                ],
            ])
            ->addSelect('country_display', [
                'label' => __('Map Countries', 'sage'),
                'instructions' => __('Select which countries are shown for Impact Sector on the map.', 'sage'),
                'choices' => [
                    'region' => __('Use countries from selected Regions', 'sage'),
                    'add_to_region' => __('Select countries to show in addition to Region countries', 'sage'),
                    'manual' => __('Select countries manually', 'sage'),
                ],
            ])
            ->addSelect('countries', [
                'label' => __('Select Countries', 'sage'),
                'instructions' => __('Select the countries to show for the Impact Sector. These countries will be highlighted when this country is hovered or selected on the map.', 'sage'),
                'multiple' => 1,
            ])
                ->addChoices(AcfUtils::countryOptions())
                ->conditional('country_display', '!=', 'region')
            ->addRadio('color', [
                'label' => __('Color', 'sage'),
                'instructions' => __('Select the color this Impact Sector will have on the interactive map page.', 'sage'),
                'default_value' => 'amethyst'
            ])
                ->addChoices((new ColorwaysLight())->getColorOptions())
            ->addRadio('secondary_color', [
                'label' => __('Secondary Color', 'sage'),
                'instructions' => __('Select the hover color Programs will have when viewed in the map drawer for this Impact Sector .', 'sage'),
                'default_value' => 'gold'
            ])
                ->addChoices((new ColorwaysDark())->getColorOptions())
        ;

        return $problemInfo->build();
    }
}
