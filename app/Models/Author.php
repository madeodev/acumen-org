<?php

namespace App\Models;

class Author extends Term
{
    public function toArray(): array
    {
        $id = $this->resource->taxonomy . '_' . $this->resource->term_id;

        return [
            ...parent::toArray(),
            'title' => get_field('title', $id) ?? '',
            'image' => get_field('image', $id) ?? 0,
        ];
    }
}
