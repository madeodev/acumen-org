<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class YearTaxonomy
{
    public function __construct(CreatesLabels $labels)
    {
        register_taxonomy(
            'acumen-year',
            ['post', 'news', 'program', 'report', 'case-study', 'company', 'region', 'foundry'],
            array(
            'labels' => $labels("Year", "Years"),
            'hierarchical' => true,
            'show_in_rest' => true,
            'show_in_quick_edit' => true,
            'meta_box_cb' => false,
            'show_admin_column' => true,
            'rest_base' => 'year',
            'rewrite' => [
              'with_front' => false,
              'slug' => 'year',
            ],
            'public' => false,
            'show_ui' => true,
      ),
        );
    }
}
