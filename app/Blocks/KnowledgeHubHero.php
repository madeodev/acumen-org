<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Fields\Partials\HeadingLevel;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Filters;

use function Roots\bundle;

class KnowledgeHubHero extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Knowledge Hub Hero';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A hero block to be displayed on the Knowledge Hub page automatically featuring the newest posts.';

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
    public $icon = 'slides';

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
         $postTypes = $this->getPostTypes();
         $filters = new Filters($postTypes[0] ?? 'post');
         $postsSliderTitle = __('Featured', 'sage');

        return [
            'heading' => get_field('heading') ?? '',
            'subheading' => get_field('subheading') ?? '',
            'post_types' => $postTypes,
            'endpoints' => $this->getEndpoints(),
            'labels' => $filters->getLabels(),
            'classes' => $filters->getClasses(),
            'posts_slider_title' => $postsSliderTitle,
            ...HeadingLevel::getFields(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $knowledgeHubHero = new FieldsBuilder('knowledge_hub_hero');

        $knowledgeHubHero
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('heading', [
                'label' => __('Heading', 'sage'),
                'default_value' => __('Knowledge Hub', 'sage')
            ])
            ->addTextarea('subheading', [
                'label' => __('Subheading', 'sage'),
            ])
            ->addFields($this->get(HeadingLevel::class))
             ->addSelect('post_types', [
                'label' => __('Post Types', 'sage'),
                'instructions' => __('Select which post types to display the most recent posts from. Leave empty to pull from all post types.', 'sage'),
                'choices' => Filters::getPostTypeOptions(),
                'multiple' => 1,
                'ui' => 1,
            ]);

        return $knowledgeHubHero->build();
    }

    /**
     * Get selected post types or default ones from Filters concern.
     *
     * @return array
     */
    private function getPostTypes()
    {
        $selected = get_field('post_types') ?: [];
        
        if (empty($selected)) {
            return array_keys(Filters::getPostTypeOptions());
        }

        return $selected;
    }

    /**
     * Get API endpoints following the same pattern as PostGridWithFilter.
     *
     * @return array
     */
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

        bundle('knowledgeHubHeroPostsSlider')->enqueue();

    }
}
