<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Filters;
use App\Models\Term;

use function Roots\bundle;

class PostGridWithFilter extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Post Grid With Filter';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Module that can be added to any page to display multiple CPTs in a grid with ability to filter results.';

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
    public $icon = 'editor-kitchensink';

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = ['page'];

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
        $postType = $this->getPostType();
        $filters = new Filters($postType);

        return [
            'heading' => get_field('heading') ?? '',
            'post_type' => $postType,
            'endpoints' => $this->getEndpoints(),
            'prefilter' => $filters->getPreFilters(),
            'labels' => $filters->getLabels(),
            'classes' => $filters->getClasses(),
            'filters' => $this->getFilters(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $postGridWithFilter = new FieldsBuilder('post_grid_with_filter');

        $postGridWithFilter
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('heading', [
                'label' => __('Heading', 'sage'),
                'default_value' => __('', 'sage')
            ])
            ->addSelect('post_type', [
                'label' => __('Post Type', 'sage'),
                'multiple' => true,
                'required' => true,
                'choices' => Filters::getPostTypeOptions(),
            ])
            ->addSelect('filters', [
                'label' => __('Filters', 'sage'),
                'multiple' => true,
                'choices' => Filters::getFilterOptions(),
            ]);

        return $postGridWithFilter->build();
    }

    /**
     * Get the selected filter objects
     */
    private function getFilters() : array {
        $chosen_taxonomies = get_field('filters');
        if(empty($chosen_taxonomies)) {
            return [];
        }

        $taxonomies = collect(Term::getByPostType($this->getPostType()))->mapWithKeys(function($tax) {
            return [$tax['slug'] => $tax];
        });

        return collect($chosen_taxonomies)->map(function($tax) use ($taxonomies) {
            if($tax == 'content-type') {
                return $this->getPostTypeFilter();
            }
            return $taxonomies[$tax] ?? [];
        })
        ->filter(function($tax) {
            return !empty($tax);
        })
        ->toArray();
    }

    /**
     * Get the Content Type (aka post type) filter object
     */
    private function getPostTypeFilter() : array {
        $post_types = collect($this->getPostType())
            ->mapWithKeys(function($type) {
                return [
                    $type => Filters::postTypeFilter($type)
                ];
            })->toArray();
        return [
            'slug' => 'content-type',
            'singular' => __('Content type', 'sage'),
            'label' => __('Content types', 'sage'),
            'terms' => [...$post_types],
            'filter_order' => 10,
        ];
    }

    private function getPostType()
    {
        return get_field('post_type') ?? [];
    }

    private function getEndpoints()
    {
        return [
            'posts' => get_rest_url(null, 'sage-api/v2/post-grid/posts'),
            'terms' => false,
        ];
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

        bundle('postGridFilter')->enqueue();
    }
}
