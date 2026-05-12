<?php

namespace App\Taxonomies;

use App\Concerns\CreatesLabels;

class MediaFormatTaxonomy
{
    public function __construct(CreatesLabels $labels)
    {
        register_taxonomy(
            'media-format',
            ['post', 'case-study', 'news', 'report'],
            array(
            'labels' => $labels("Media Format", "Media Formats"),
            'hierarchical' => true,
            'show_in_rest' => true,
            'show_in_quick_edit' => true,
            'meta_box_cb' => false,
            'show_admin_column' => true,
            'rest_base' => 'media-format',
            'rewrite' => [
              'with_front' => false,
            ],
            'public' => false,
            'show_ui' => true, 
      ),
        );
    }
}
