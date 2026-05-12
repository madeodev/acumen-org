<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;
use Illuminate\Support\Str;

class ButtonOrModal extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $buttonOrModal = new FieldsBuilder('button_or_modal');

        $buttonOrModal
        ->addButtonGroup('button_type', [
            'label' => __('Button Type', 'sage'),
            'instructions' => __('Select whether to open a link, or a video modal.', 'sage'),
            'choices' => [
                'none' => __('No button', 'sage'),
                'link' => __('Link', 'sage'),
                'modal' => __('Video Modal', 'sage'),
            ],
            'wrapper' => [
                'width' => 30
            ]
        ])
        ->addLink('button', [
            'label' => __('Button', 'sage'),
            'instructions' => __('Required', 'sage'),
            'required' => 1,
            'wrapper' => [
                'width' => 70
            ]
        ])
            ->conditional('button_type', '==', 'link')
        ->addText('button_label', [
            'label' => __('Button Label', 'sage'),
            'instructions' => __('Required. This will be the label of the button. Please limit to 20 characters.', 'sage'),
            'required' => 1,
            'wrapper' => [
                'width' => 30
            ]
        ])
            ->conditional('button_type', '==', 'modal')
        ->addUrl('video_full', [
            'label' => __('Video URL', 'sage'),
            'instructions' => __('Required. A link to a YouTube or Vimeo video. If a video URL is provided, this block will display that video in a modal.', 'sage'),
            'required' => 1,
            'wrapper' => [
                'width' => 40
            ],
        ])
            ->conditional('button_type', '==', 'modal');

        return $buttonOrModal;
    }

    public static function getFields()
    {
        $button_type = get_field('button_type') ?? 'none';
        $modal_video = get_field('video_full') ?? '';
        $is_modal = $button_type === 'modal' && !empty($modal_video);

        return [
            'button' => self::getButton(),
            'button_type' => $button_type,
            'modal' => $is_modal ? [
                'id' =>  Str::random(9),
                'video' => $modal_video,
            ] : []
        ];
    }


    /**
     * get the button array based on the type selected
     */
    private static function getButton()
    {
        $type = get_field('button_type') ?? 'link';

        if ($type === 'none') {
            return [];
        }

        if ($type === 'modal') {
            return [
                'title' => get_field('button_label') ?? '',
            ];
        }

        return get_field('button') ?? [];
    }
}
