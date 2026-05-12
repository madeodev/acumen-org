<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class OfficeTaxonomy
{
    public function __construct(CreatesLabels $labels)
    {
        register_taxonomy(
            'office',
            ['team'],
            array(
            'labels' => $labels("Office", "Offices"),
            'hierarchical' => true,
            'show_in_rest' => true,
            'show_in_quick_edit' => true,
            'meta_box_cb' => false,
            'show_admin_column' => true,
            'rest_base' => 'office',
            'rewrite' => [
              'with_front' => false,
            ],
            'public' => false,
            'show_ui' => true, 
            // custom argument
            'filter_order' => 2
      ),
        );
    }
}
