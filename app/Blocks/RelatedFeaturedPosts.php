<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Translation;

class RelatedFeaturedPosts extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Related Featured Posts';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Grid of featured posts. Posts are automatically selected based on the current post type.';

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
    public $post_types = [
        'post',
        'news',
        'report',
        'case-study',
        'company',
        'program',
        'problem',
        'region',
    ];

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
            'featured_posts' => $this->getFeaturedPostData(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $relatedFeaturedPosts = new FieldsBuilder('related_featured_posts');

        $description = $this->description . ' ' . sprintf(__('To update the title, intro content and the button, please visit the %s.', 'sage'), $this->getSettingsLink());

        $relatedFeaturedPosts
            ->addMessage(
                'block_title',
                '',
                AcfUtils::blockTitle($this->name, $this->icon, $description)
            );

        return $relatedFeaturedPosts->build();
    }

    private function getSettingsLink()
    {
        if (empty($_REQUEST['post_id'])) return '';
        $post_type = get_post_type($_REQUEST['post_id']);
        $link = 'edit.php?post_type=' . $post_type . '&page=' . $post_type . '-settings';

        if ($post_type === 'post') {
            $link = 'edit.php?page=blog-settings';
        }

        return '<a href="' . $link . '">' . __('settings page', 'sage') . '</a>';
    }

    private function getFeaturedPostData()
    {
        $large_post = $this->getRelatedPosts(1);
        $exclude_post = !empty($large_post) && !is_wp_error($large_post) ? [$large_post[0]->ID] : [];
        $list_post = $this->getRelatedPosts(3, $exclude_post);

        return [
            ...$this->getModuleData(),
            'large' => $large_post,
            'list' => $list_post,
        ];
    }

    private function getModuleData()
    {
        $post_type = get_post_type();
        $cpt_options = (new Translation)->getOptionsFieldValue('featured_posts', $post_type . '_options');
        $global_options = (new Translation)->getOptionsFieldValue('featured_posts', 'options');

        return [
            'title' => $cpt_options['title'] ?? ($global_options['title'] ?? ''),
            'intro' => $cpt_options['introduction'] ?? ($global_options['introduction'] ?? ''),
            'button' => $cpt_options['button'] ?? ($global_options['button'] ?? ''),
        ];
    }

    private function getRelatedPosts($limit, $excluded = [])
    {
        $excluded = [...$excluded, get_the_ID()];

        $args = [
            'post_type' => get_post_type(),
            'posts_per_page' => $limit,
            'post__not_in' => $excluded,
        ];

        $posts = get_posts($args);

        return $posts;
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
