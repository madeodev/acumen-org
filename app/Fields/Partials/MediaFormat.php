<?php

namespace App\Fields\Partials;

use App\Concerns\GetsIcons;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MediaFormat extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $mediaFormat = new FieldsBuilder('media_format');

        $mediaFormat
            ->addTaxonomy('media_format_tax', [
                'label' => __('Media Format', 'sage'),
                'taxonomy' => 'media-format',
            ]);

        return $mediaFormat;
    }
}
