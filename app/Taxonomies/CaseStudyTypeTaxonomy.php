<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class CaseStudyTypeTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'case-study-type',
      ['case-study'],
      array(
        'labels' => $labels("Case Study Type", "Case Study Types"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'case-study-type',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
