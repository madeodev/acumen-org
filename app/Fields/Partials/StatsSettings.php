<?php

namespace App\Fields\Partials;

use App\Concerns\Colors\ColorwaysDark;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class StatsSettings extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $statsSettings = new FieldsBuilder('stats_settings');

        $statsSettings
            ->addAccordion('settings', [
                'label' => __('Stats Settings ', 'sage'),
            ])
                ->addRadio('color', [
                    'label' => __('Color', 'sage'),
                    'default_value' => 'mizuna'
                ])
                    ->addChoices((new ColorwaysDark())->getColorOptions())
            ->addAccordion('settings_end')->endpoint();

        return $statsSettings;
    }
}
