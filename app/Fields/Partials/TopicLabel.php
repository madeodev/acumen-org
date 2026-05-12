<?php

namespace App\Fields\Partials;

use App\Concerns\GetsIcons;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TopicLabel extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $topicLabel = new FieldsBuilder('topic_label');

        $topicLabel
            ->addText('topic', [
                'label' => __('Topic Label', 'sage'),
                'instructions' => __('~20 Characters', 'sage'),
                'wrapper' => ['width' => '60%'],
            ])
            ->addSelect('topic_icon', [
                'label' => __('Topic Icon', 'sage'),
                'instructions' => __('Optional', 'sage'),
                'allow_null' => 1,
                'wrapper' => ['width' => '40%'],
            ])
                ->addChoices(GetsIcons::iconOptions());

        return $topicLabel;
    }

    public static function getFields(){
        return [
            'topic' => get_field('topic') ?? '',
            'topic_icon' => get_field('topic_icon') ?? '',
        ];
    }
}
