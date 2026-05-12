<?php

namespace App\Models;

use App\Models\Resource;

class NavItem extends Resource
{    
  
    /**
    * @var int
    */
    protected $id;

    public function __construct($post)
    {
        parent::__construct($post);
        $this->id = $post->ID;
    }

    public function toArray(): array
    {
        $fields = get_fields($this->id) ?: [];
        return [
          'ID' => $this->id,
          'object_id' => (int) $this->resource->object_id,
          'title' => $this->resource->title,
          'url' => $this->resource->url,
          'target' => $this->resource->target,
          'description' => $this->resource->description,
          'children' => $this->resource->children,
          ...$fields,
        ];
    }
}
