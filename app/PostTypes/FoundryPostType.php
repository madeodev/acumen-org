<?php

namespace App\PostTypes;

use App\Concerns\CreatesLabels;

class FoundryPostType
{
  /**
   * @var \WP_Error|\WP_Post_Type
   */
  public $postType;

  public function __construct(CreatesLabels $labels)
  {
    $this->postType = register_post_type('foundry', [
      'labels' => $labels('Foundry Member', 'Foundry'),
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'public' => false,
      'supports' => ['title', 'thumbnail'],
      'menu_icon' => 'dashicons-id',
      'show_in_rest' => true,
      'rewrite' => [
        'slug' => 'foundry',
        'with_front' => false,
        'walk_dirs' => false
      ],
      'query_var' => false,
    ]);
  }
}
