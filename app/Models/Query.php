<?php

namespace App\Models;

class Query extends Resource
{
    public function toArray(): array
    {
        return [
            'max_pages' => (int) $this->resource->max_num_pages,
            'current_page' => (int) $this->resource->query_vars['paged'] ?: 1,
            'posts_per_page' => (int) $this->resource->query_vars['posts_per_page'],
            'data' => $this->resource->data ?? $this->resource->posts,
            'associated_terms' => $this->resource->associated_terms,
            'total_posts' => (int) $this->resource->found_posts,
            'query' => $this->resource->query,
        ];
    }
}
