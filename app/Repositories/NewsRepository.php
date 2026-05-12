<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\BaseRepository;

class NewsRepository extends BaseRepository
{
  protected $postType = 'news';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = News::collection($query->posts);

    return $query;
  }
}
