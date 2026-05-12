<?php

namespace App\PostTypes;

use App\Concerns\CreatesLabels;

class RegionPostType
{
  /**
   * @var \WP_Error|\WP_Post_Type
   */
  public $postType;

  public function __construct(CreatesLabels $labels)
  {
    $this->postType = register_post_type('region', [
      'labels' => $labels('Region', 'Regions'),
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'public' => true,
      'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
      'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode(get_svg('images.admin-icons.globe')),
      'show_in_rest' => true,
      'rewrite' => [
        'slug' => 'regions',
        'with_front' => false,
        'walk_dirs' => false
      ],
      'query_var' => false,
    ]);
  }

}
