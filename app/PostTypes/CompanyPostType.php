<?php

namespace App\PostTypes;

use App\Concerns\CreatesLabels;

class CompanyPostType
{
    /**
     * @var \WP_Error|\WP_Post_Type
     */
    public $postType;

    public function __construct(CreatesLabels $labels)
    {
        $this->postType = register_post_type('company', [
          'labels' => $labels('Company', 'Companies'),
          'show_ui' => true,
          'show_in_menu' => true,
          'show_in_nav_menus' => true,
          'public' => true,
          'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
          'menu_icon' => 'dashicons-building',
          'show_in_rest' => true,
          'rewrite' => [
            'slug' => 'companies',
            'with_front' => false,
            'walk_dirs' => false
          ],
          'query_var' => false,
          'template' =>  [
            ['core/heading',],
            ['core/paragraph',],
            ['acf/share-buttons',],
          ],
        ]);
    }

}
