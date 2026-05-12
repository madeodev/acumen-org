<?php

namespace App\PostTypes;

use App\Concerns\CreatesLabels;

class Post
{
    public $name = 'post';

    /**
     * @var \WP_Error|\WP_Post_Type
     */
    public function __construct(CreatesLabels $labels)
    {
        $this->renamePostType($labels);
        add_action('admin_init', [&$this, 'unregisterTags']);
    }

    public function unregisterTags()
    {
        unregister_taxonomy_for_object_type('post_tag', 'post');
        remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');

        unregister_taxonomy_for_object_type('category', 'post');
        remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    }

    private function renamePostType(CreatesLabels $labels)
    {
        $title = __('Blog', 'post_post_type');
        $title_plural = __('Blog Posts', 'post_post_type');

        global $wp_post_types;

        $wp_post_types['post']->labels = (object) array_merge((array) $wp_post_types['post']->labels, $labels($title, $title_plural));
        $wp_post_types['post']->label = $title;
        $wp_post_types['post']->menu_position = 25;
        $wp_post_types['post']->template = [
            ['core/heading',],
            ['core/paragraph',],
            ['acf/share-buttons',],
        ];
    }
}
