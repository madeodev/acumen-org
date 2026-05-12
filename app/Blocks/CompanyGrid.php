<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Filters;

use function Roots\bundle;

class CompanyGrid extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Company Grid';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Module that can be added to any page to display Company CPT in one grid with ability to filter results. This module will be used as a full directory. It will also be added to pages/posts to display a shorter grid of company posts, manually selected.';

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
    public $icon = 'businessperson';

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
        $filters = new Filters('company');
        $preselected = get_field('posts') ?: [];

        $exclude_terms = [
            'company-status',
            'acumen-year'
        ];

        return [
            'heading' => get_field('heading') ?? '',
            'endpoints' => $filters->getEndpoints($preselected, $exclude_terms),
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
        $companyGrid = new FieldsBuilder('company_grid');

        $companyGrid
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('heading', [
                'label' => __('Heading', 'sage'),
            ])
            ->addRelationship('posts', [
                'label' => __('Pre-selected Posts', 'sage'),
                'instructions' => __('Select from a list of company posts to display. If this field is left empty, all company posts will be displayed.', 'sage'),
                'post_type' => 'company',
                'return_format' => 'id',
            ]);

        return $companyGrid->build();
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

        bundle('companyGrid')->enqueue();
    }
}
