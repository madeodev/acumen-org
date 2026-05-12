<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class BlogTypeTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'blog-type',
      ['post'],
      array(
        'labels' => $labels("Blog Type", "Blog Types"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'blog-type',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
