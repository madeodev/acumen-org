<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class TeamFunctionTaxonomy
{
    public function __construct(CreatesLabels $labels)
    {
        register_taxonomy(
            'team-function',
            ['team'],
            array(
            'labels' => $labels("Function", "Functions"),
            'hierarchical' => true,
            'show_in_rest' => true,
            'show_in_quick_edit' => true,
            'meta_box_cb' => false,
            'show_admin_column' => true,
            'rest_base' => 'team-function',
            'rewrite' => [
              'with_front' => false,
            ],
            'public' => false,
            'show_ui' => true, 
            // custom argument
            'filter_order' => 3
      ),
        );
    }
}
