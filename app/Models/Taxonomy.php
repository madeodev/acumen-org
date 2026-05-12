<?php

namespace App\Models;

use App\Models\Resource;

class Taxonomy extends Resource
{
    public function toArray(): array
    {
        $labels = get_taxonomy_labels($this->resource);

        return [
            'slug' => $this->resource->name,
            'singular' => $labels->singular_name,
            'label' => $this->resource->label,
            'terms' => $this->resource->terms,
            // so we can control the order of the filters in the frontend
            'filter_order' => $this->resource->filter_order ?? 0,
        ];
    }
}
