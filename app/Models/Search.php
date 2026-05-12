<?php

namespace App\Models;

class Search extends Post
{
    public function toArray(): array
    { 
        $parent = parent::toArray();
        return [
            ...$parent,
            'title' => $this->resource->post_highlighted_title ?? $parent['title'],
        ];
    }
}
