<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Video extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $video = new FieldsBuilder('video');

        $video
            ->addFile('webm', [
                'label' => __('Video in webm format', 'sage'),
                'instructions' => __('Max 2MB. Use the WordPress "Description" field to add an description of the video for users of assistive technologies.', 'sage'),
                'mime_types' => 'webm',
                'return_format' => 'array',
                'max_size' => '2',
            ])
            ->addFile('mp4', [
                'label' => __('Video in mp4 format', 'sage'),
                'instructions' => __('Max 2MB. Will be used as a fallback for browsers that don\'t support webm, or as the sole video source if no webm file is added. If no webm file is added, be sure to use the WordPress "Description" field to add an description of the video for users of assistive technologies.', 'sage'),
                'mime_types' => 'mp4',
                'max_size' => '2',
                'return_format' => 'array',
            ]);

        return $video;
    }
}
