<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\HeadingIntro;

class FeaturedPosts extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Featured Posts';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Grid of featured posts. Post are manually selected from published CPTs.';

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
    public $icon = 'grid-view';

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
            'data' => [
                'title' => get_field('title') ?? null,
                'intro' => get_field('introduction') ?? null,
                'button' => get_field('button') ?? [],
                'large' => get_field('large_post') ? [get_field('large_post')] : [],
                'list' => get_field('list_posts') ?? [],
            ]
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $featuredPosts = new FieldsBuilder('featured_posts');
        $allowedPostTypes = [
            'post',
            'news',
            'report',
            'case-study',
            'company',
            'program',
            'problem',
            'region',
        ];

        $featuredPosts
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addFields($this->get(HeadingIntro::class))
            ->addPostObject('large_post', [
                'label' => __('Post (Large)', 'sage'),
                'instructions' => __('Please select one post to appear on the left side of the module.', 'sage'),
                'post_type' => $allowedPostTypes,
            ])
            ->addRelationship('list_posts', [
                'label' => __('Posts (List)', 'sage'),
                'instructions' => __('Please select three posts to appear on the right side of the module.', 'sage'),
                'min' => 3,
                'max' => 3,
                'post_type' => $allowedPostTypes,
            ])
        ;

        return $featuredPosts->build();
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
