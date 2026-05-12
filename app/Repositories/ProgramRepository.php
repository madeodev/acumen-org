<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Program;

class ProgramRepository extends BaseRepository
{
  protected $postType = 'program';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Program::collection($query->posts);

    return $query;
  }
}
