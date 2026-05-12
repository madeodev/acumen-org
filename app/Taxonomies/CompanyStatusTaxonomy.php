<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class CompanyStatusTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'company-status',
      ['company'],
      array(
        'labels' => $labels("Status", "Statuses"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'company-status',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
