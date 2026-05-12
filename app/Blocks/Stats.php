<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\ColorwaysDark;
use App\Fields\Partials\Stats as PartialsStats;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Stats extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Stats';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display key #’s or statistics.';

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
    public $icon = 'star-filled';

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
            'title' => get_field('title') ?? '',
            'stats' => get_field('stats') ?? [],
            'button' => get_field('button') ?? [],
            'colors' => new ColorwaysDark( get_field('color') ?? '' ),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $stats = new FieldsBuilder('stats');

        $stats
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addFields($this->get(PartialsStats::class))
            ->addLink('button', [
                'label' => __('Button', 'sage'),
                'instructions'  => __('Optional', 'sage'),
            ])
            ->addAccordion('settings', [
                'label' => __('Block Settings ', 'sage'),
            ])
                ->addRadio('color', [
                    'label' => __('Color', 'sage'),
                    'default_value' => 'mizuna'
                ])
                    ->addChoices((new ColorwaysDark())->getColorOptions());

        return $stats->build();
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
