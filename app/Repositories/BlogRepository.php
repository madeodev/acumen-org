<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Blog;

class BlogRepository extends BaseRepository
{
  protected $postType = 'post';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Blog::collection($query->posts);

    return $query;
  }
}
