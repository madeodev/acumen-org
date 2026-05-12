<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AnimatedBlockquote extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Animated Blockquote';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'An blockquote with citation and optional animation.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'formatting';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'format-quote';

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
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
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
            'quote' => get_field('quote') ?: null,
            'citation' => get_field('citation') ?: null,
            'animate' => get_field('animate') ?: false,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $blockquote = new FieldsBuilder('animated_blockquote');

        $blockquote
            ->addTextarea('quote', [
                'label' => __('Quote', 'sage'),
                'instructions' => __('Enter the quote text.', 'sage'),
                'required' => 1,
                'rows' => 4,
            ])
            ->addText('citation', [
                'label' => __('Citation', 'sage'),
                'instructions' => __('Enter the citation or source of the quote.', 'sage'),
                'required' => 0,
            ])
            ->addTrueFalse('animate', [
                'label' => __('Animate', 'sage'),
                'instructions' => __('Adds scrolling animation to the quote.', 'sage'),
                'required' => 0,
            ]);

        return $blockquote->build();
    }
}
