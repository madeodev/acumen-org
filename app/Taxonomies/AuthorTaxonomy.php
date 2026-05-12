<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class AuthorTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'post-author',
      ['post', 'news'],
      array(
        'labels' => $labels("Author", "Authors"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'author',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true,
      ),
    );
  }
}
