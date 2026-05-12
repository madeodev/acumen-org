<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class TeamTypeTaxonomy
{
    public function __construct(CreatesLabels $labels)
    {
        register_taxonomy(
            'team-type',
            ['team'],
            array(
            'labels' => $labels("Team Type", "Team Types"),
            'hierarchical' => true,
            'show_in_rest' => true,
            'show_in_quick_edit' => true,
            'meta_box_cb' => false,
            'show_admin_column' => true,
            'rest_base' => 'team-type',
            'rewrite' => [
              'with_front' => false,
            ],
            'public' => false,
            'show_ui' => true, 
            // custom argument
            'filter_order' => 1
      ),
        );
    }
}
