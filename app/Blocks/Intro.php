<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\Colorways;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Intro extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Intro';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'This module provides a unique content area that appears ‘above the fold’ on the each page. On the homepage, it is used to describe what you do and why someone should care. On other pages, it is used to present the page context. Provide a clear call to action and link to a high priority website goal.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'bw-blox';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'align-full-width';

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
    public $mode = 'preview';

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
        $image = get_field('image') ?? '';
        return [
            'headline' => get_field('headline') ?? '',
            'paragraph' => get_field('paragraph') ?? '',
            'link' => get_field('link') ?? [],
            'image' => $image,
            'image_condition_class' => empty($image) ? 'text-center mx-auto' : '',
            'colors' => new Colorways('default'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $intro = new FieldsBuilder('intro');

        $intro
            ->addMessage('block_title', '',  AcfUtils::blockTitle(
                $this->name, $this->icon, $this->description
            ))
            ->addText('headline', [
                'label' => __('Headline ', 'sage'),
                'instructions'  => __('Required - Recommended max characters: 70', 'sage'),
                'required' => 1,
                'default_value' => __('Headline', 'sage'),
            ])
            ->addTextArea('paragraph', [
                'label' => __('Paragraph', 'sage'),
                'instructions'  => __('Optional - Recommended max characters: 125', 'sage'),
                'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id justo odio. Pellentesque quis leo sed justo sagittis tincidunt eget nec tortor. Sed bibendum justo enim, ac finibus libero viverra ac.',
            ])
            ->addLink('link', [
                'label' => __('Button', 'sage'),
                'instructions'  => __('Optional', 'sage'),
            ])
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'instructions'  => __('Optional - Recommended size: 650px x 650px', 'sage'),
            ]);

        return $intro->build();
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
