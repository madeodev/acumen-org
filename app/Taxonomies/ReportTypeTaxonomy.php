<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class ReportTypeTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'report-type',
      ['report'],
      array(
        'labels' => $labels("Report Type", "Report Types"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'report-type',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
