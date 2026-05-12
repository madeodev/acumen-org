<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\Colorways;
use App\Fields\Partials\DividerOptions;
use App\Fields\Partials\HeadingTag;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FiftyFifty extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Fifty Fifty';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'This versatile module is used to introduce a single content topic. It includes both a H2 & H3 headline options.';

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
    public $icon = 'editor-ul';

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
            'headline' => get_field('headline') ?? '',
            'text_area' => get_field('text_area') ?? '',
            'heading_tag' => get_field('heading_tag') ?? 'h2',
            'colors' => new Colorways(get_field('color') ?? ''),
            'divider_classes' => DividerOptions::getClasses(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $fiftyFifty = new FieldsBuilder('fifty_fifty');

        $fiftyFifty
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('headline', [
                'label' => __('Headline ', 'sage'),
                'instructions'  => __('Required - Recommended max characters: 70', 'sage'),
                'required' => 1,
            ])
            ->addWysiwyg('text_area', [
                'label' => __('Text Area ', 'sage'),
                'instructions'  => __('Required', 'sage'),
                'required' => 1,
            ])
            ->addAccordion('settings', [
                'label' => __('Block Settings ', 'sage'),
            ])
                ->addFields($this->get(HeadingTag::class))
                ->addFields($this->get(DividerOptions::class))
                ->addRadio('color', [
                    'label' => __('Color', 'sage'),
                    'default_value' => 'stone'
                ])
                    ->addChoices((new Colorways())->getColorOptions());

        return $fiftyFifty->build();
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
