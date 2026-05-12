<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class RegionTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'region-tax',
      ['post', 'news', 'program', 'problem', 'report', 'case-study', 'company'],
      array(
        'labels' => $labels("Region", "Regions"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'region',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
