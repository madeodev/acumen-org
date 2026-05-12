<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Filters;
use App\Models\Team;

use function Roots\bundle;

class PeopleGrid extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'People Grid';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Module that can be added to any page to display Team CPT in one grid with ability to filter results.';

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
        $filters = new Filters('team');
        $preselected = get_field('posts_team') ?: [];

        return [
            'heading' => get_field('heading') ?? '',
            'chip_tax' => filter_var(get_field('show_filter_chips') ?? 0, FILTER_VALIDATE_BOOLEAN) ? Team::getChipFilter() : '',
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
        $peopleGrid = new FieldsBuilder('people_grid');

        $peopleGrid
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('heading', [
                'label' => __('Heading', 'sage'),
                'default_value' => __('People', 'sage')
            ])
            ->addTrueFalse('show_filter_chips', [
                'label' => __('Show Filter Chips', 'sage'),
                'wrapper' => [
                    'width' => 50
                ]
            ])
            ->addRelationship('posts_team', [
                'label' => __('Pre-selected Team Members', 'sage'),
                'instructions' => __('Select from a list of team members to display. If this field is left empty, all team members will be displayed.', 'sage'),
                'post_type' => 'team',
                'return_format' => 'id',
                'filters' => [
                    'search',
                    'taxonomy',
                ],
            ]);

        return $peopleGrid->build();
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

        bundle('peopleGrid')->enqueue();
    }
}
