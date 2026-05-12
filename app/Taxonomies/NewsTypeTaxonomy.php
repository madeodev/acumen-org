<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class NewsTypeTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'news-type',
      ['news'],
      array(
        'labels' => $labels("News Type", "News Types"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'news-type',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
