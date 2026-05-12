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

class RegionInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $regionInfo = new FieldsBuilder('region_info', [
            'label' => __('Region Info', 'sage'),
            'position' => 'side'
        ]);

        $regionInfo
            ->setLocation('post_type', '==', 'region');

        $regionInfo
            ->addMessage('about', '', [
                'label' => __('About the Region', 'sage'),
                'message' => __('Note that the Excerpt is displayed prominently in the map.', 'sage'),
            ])
            ->addFields($this->get(ProblemRegion::class))
                ->modifyField('region', [
                    'instructions' => __('Select the corresponding Region taxonomy term.', 'sage'),
                    'field_type' => 'select',
                    'required' => 1,
                    'bidirectional' => 1,
                    'bidirectional_target' => [
                        'field_region_taxonomy_info_linked_region_cpt',
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
                'instructions' => __('Add a link here to have this region\'s entry on the interactive map link to somewhere other than the region page. The "Link Text" you enter hear will be used in place of the default "Learn More" button title.', 'sage'),
                'default_value' => [
                    'title' => 'Learn More'
                ],
            ])
            ->addSelect('countries', [
                'label' => __('Countries', 'sage'),
                'instructions' => __('Select the countries belonging to the region. These countries will be highlighted when this country is hovered or selected on the map.', 'sage'),
                'multiple' => 1,
            ])
                ->addChoices(AcfUtils::countryOptions())
            ->addRadio('color', [
                'label' => __('Color', 'sage'),
                'instructions' => __('Select the color this Region will have on the interactive map page.', 'sage'),
                'default_value' => 'woad'
            ])
                ->addChoices((new ColorwaysLight())->getColorOptions())
            ->addRadio('secondary_color', [
                'label' => __('Secondary Color', 'sage'),
                'instructions' => __('Select the hover color Programs will have when viewed in the map drawer for this Region.', 'sage'),
                'default_value' => 'gold'
            ])
                ->addChoices((new ColorwaysDark())->getColorOptions());

        return $regionInfo->build();
    }
}
