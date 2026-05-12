<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class ProblemTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'problem-tax',
      ['post', 'news', 'program', 'report', 'case-study', 'company', 'region'],
      array(
        'labels' => $labels("Impact Sector", "Impact Sectors"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'problem',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true,
      ),
    );
  }
}
