<?php

namespace App\Repositories;

use App\Models\Foundry;
use App\Repositories\BaseRepository;

class FoundryRepository extends BaseRepository
{
  protected $postType = 'foundry';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Foundry::collection($query->posts);

    return $query;
  }
}
