<?php

namespace App\Repositories;

use App\Models\CaseStudy;
use App\Repositories\BaseRepository;

class CaseStudyRepository extends BaseRepository
{
  protected $postType = 'case-study';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = CaseStudy::collection($query->posts);

    return $query;
  }
}
