<?php

namespace App\Blocks;

use function Roots\bundle;
use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Filters;

class FoundryGrid extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Foundry Grid';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Module that can be added to any page to display Foundry CPT in one grid with ability to filter results.';

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
    public $icon = 'groups';

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
        $filters = new Filters('foundry');
        $preselected = get_field('posts_foundry') ?: [];

        return [
            'heading' => get_field('heading') ?? '',
            'endpoints' => $filters->getEndpoints($preselected),
            'prefilter' => $filters->getPreFilters(),
            'labels' => $filters->getLabels(),
            'classes' => $filters->getClasses(),
            'preselected' => $preselected,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $foundryGrid = new FieldsBuilder('foundry_grid');

        $foundryGrid
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('heading', [
                'label' => __('Heading', 'sage'),
                'default_value' => __('Foundry', 'sage')
            ])
            ->addRelationship('posts_foundry', [
                'label' => __('Pre-selected Foundry Members', 'sage'),
                'instructions' => __('Select from a list of foundry members to display. If this field is left empty, all foundry members will be displayed.', 'sage'),
                'post_type' => 'foundry',
                'return_format' => 'id',
                'filters' => [
                    'search',
                    'taxonomy',
                ],
            ]);

        return $foundryGrid->build();
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        if (is_admin()) {
            return;
        }

        bundle('foundryGrid')->enqueue();
    }
}
