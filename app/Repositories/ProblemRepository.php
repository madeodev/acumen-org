<?php

namespace App\Repositories;

use App\Models\Problem;
use App\Repositories\BaseRepository;

class ProblemRepository extends BaseRepository
{
  protected $postType = 'problem';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Problem::collection($query->posts);

    return $query;
  }
}
