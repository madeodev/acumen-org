<?php

namespace App\Repositories;

use App\Models\Region;
use App\Repositories\BaseRepository;

class RegionRepository extends BaseRepository
{
  protected $postType = 'region';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Region::collection($query->posts);

    return $query;
  }
}
