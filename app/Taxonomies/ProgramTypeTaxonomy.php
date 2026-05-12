<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class ProgramTypeTaxonomy
{
  public function __construct(CreatesLabels $labels)
  {
    register_taxonomy(
      'program-type',
      ['program'],
      array(
        'labels' => $labels("Program Type", "Program Types"),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'show_admin_column' => true,
        'rest_base' => 'program-type',
        'rewrite' => [
          'with_front' => false,
        ],
        'public' => false,
        'show_ui' => true, 
      ),
    );
  }
}
