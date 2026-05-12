<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\Colorways;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LargeCTA extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Large CTA';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Highlight the most important information on your page with an optional CTA button.';

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
    public $icon = 'align-center';

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
            'text' => get_field('text') ?? '',
            'button' => get_field('button') ?? [],
            'colors' => new Colorways(get_field('color') ?? ''),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $largeCTA = new FieldsBuilder('large_c_t_a');

        $largeCTA
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addTextarea('text', [
                'label' => __('Text', 'sage')
            ])
            ->addLink('button', [
                'label' => __('Optional Button', 'sage')
            ])
            ->addAccordion('settings', [
                'label' => __('Block Settings ', 'sage'),
            ])
                ->addRadio('color', [
                    'label' => __('Color', 'sage'),
                    'default_value' => 'amethyst'
                ])
                    ->addChoices((new Colorways())->getColorOptions());
;

        return $largeCTA->build();
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
