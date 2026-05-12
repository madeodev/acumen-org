<?php

namespace App\PostTypes;

use App\Concerns\CreatesLabels;

class TeamPostType
{
  /**
   * @var \WP_Error|\WP_Post_Type
   */
  public $postType;

  public function __construct(CreatesLabels $labels)
  {
    $this->postType = register_post_type('Team', [
      'labels' => $labels('Team Member', 'Team'),
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'public' => true,
      'supports' => ['title', 'thumbnail', 'editor'],
      'menu_icon' => 'dashicons-id',
      'show_in_rest' => true,
      'rewrite' => [
        'slug' => 'team',
        'with_front' => false,
        'walk_dirs' => false
      ],
      'query_var' => false,
      'template_lock' => true,
      'template' => [
        [
          'core/paragraph',
        ],
      ],
    ]);
  }

}
