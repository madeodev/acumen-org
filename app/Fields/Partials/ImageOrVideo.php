<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageOrVideo extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $imageOrVideo = new FieldsBuilder('image_or_video');

        $imageOrVideo
            ->addRadio('media_type', [
                'label' => __('Media Type', 'sage'),
                'choices' => [
                    'image' => __('Image', 'sage'),
                    'upload_video' => __('Upload Video Loop', 'sage'),
                ],
                'default_value' => 'image',
                'layout' => 'vertical',
                'wrapper' => ['width' => '25%'],
            ])
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'instructions' => __('Used as the "loading" image for videos. If no image is provided for a YouTube video, the YouTube thumbnail will be used.', 'sage'),
                'wrapper' => ['width' => '25%'],
            ])
            ->addFields($this->get(Video::class))
                ->modifyField('webm', [
                    'wrapper' => ['width' => '25%'],
                    'conditional_logic' => [
                        [
                            'field' => 'media_type',
                            'operator' => '==',
                            'value' => 'upload_video'
                        ]
                    ]
                ])
                ->modifyField('mp4', [
                    'wrapper' => ['width' => '25%'],
                    'conditional_logic' => [
                        [
                            'field' => 'media_type',
                            'operator' => '==',
                            'value' => 'upload_video'
                        ]
                    ]
                ]);

        return $imageOrVideo;
    }

    /**
     * @return array with keys 'image', 'webm', 'mp4'.
     */
    public static function getFields(){
        $type = get_field('media_type') ?? 'image';
        $image = get_field('image') ?? '';

        return [
            'image' => $type == 'image' ? $image : '',
            'placeholder' => $type != 'image' ? $image : '',
            'webm' => $type == 'upload_video' ? get_field('webm') : '',
            'mp4' => $type == 'upload_video' ? get_field('mp4') : '',
        ];
    }
}
