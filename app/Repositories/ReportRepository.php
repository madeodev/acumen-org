<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Report;

class ReportRepository extends BaseRepository
{
  protected $postType = 'report';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Report::collection($query->posts);

    return $query;
  }
}
