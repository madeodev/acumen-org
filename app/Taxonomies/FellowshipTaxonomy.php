<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class FellowshipTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'fellowship',
      ['foundry'],
      array(
        'labels' => $labels("Fellowship", "Fellowships"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'fellowship',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
