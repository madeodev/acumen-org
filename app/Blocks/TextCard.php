<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\Colorways;
use App\Concerns\Colors\ColorwaysLight;
use App\Fields\Partials\ImageOrVideo;
use App\Fields\Partials\TopicLabel;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TextCard extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Text Card';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Highlight a custom topic, post, page or call to action.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'acumen';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'align-left';

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'edit';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => false,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            ...TopicLabel::getFields(),
            'headline' => get_field('headline') ?? '',
            'text' => get_field('text') ?? '',
            'buttons' => get_field('buttons') ?? [],
            'image_alignment' => get_field('image_alignment') ?? 'left',
            'colors' => new Colorways(get_field('color') ?? ''),
            ...ImageOrVideo::getFields(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $textCard = new FieldsBuilder('text_card');

        $textCard
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addFields($this->get(ImageOrVideo::class))
            ->addButtonGroup('image_alignment', [
                'label' => __('Image Alignment', 'sage'),
                'instructions' => __('Select where to align the image.', 'sage'),
                'default_value' => 'left',
                'choices' => [
                    'left' => __('Left', 'sage'),
                    'right' => __('Right', 'sage'),
                ],
                'wrapper' => [
                    'width' => 50
                ]
            ])
            ->addFields($this->get(TopicLabel::class))
            ->addText('headline', [
                'label' => __('H3 Headline', 'sage'),
                'instructions' => __('~100 Characters', 'sage'),
            ])
            ->addWysiwyg('text', [
                'label' => __('Text Area', 'sage'),
            ])
            ->addRepeater('buttons', [
                'label' => __('Buttons', 'sage'),
                'max' => 2,
            ])
            ->addLink('button', [
                'label' => __('Button', 'sage')
            ])
            ->endRepeater()
            ->addAccordion('settings', [
                'label' => __('Block Settings ', 'sage'),
            ])
            ->addRadio('color', [
                'label' => __('Color', 'sage'),
                'default_value' => 'provence'
            ])
            ->addChoices((new ColorwaysLight())->getColorOptions());

        return $textCard->build();
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
