<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Stats extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $stats = new FieldsBuilder('stats');

        $stats
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'instructions' => __('~30 Characters', 'sage')
            ])
            ->addRepeater('stats', [
                'label' => __('Stats', 'sage'),
                'max' => 4,
            ])
                ->addText('stat', [
                    'label' => __('Stat', 'sage'),
                    'instructions' => __('1-10 Characters Max', 'sage')
                ])
                ->addTextarea('description', [
                    'label' => __('Description', 'sage'),
                    'instructions' => __('~50 Characters Max', 'sage'),
                    'rows' => 2
                ])
            ->endRepeater();

        return $stats;
    }

}
