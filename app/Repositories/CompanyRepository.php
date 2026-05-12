<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Company;

class CompanyRepository extends BaseRepository
{
  protected $postType = 'company';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Company::collection($query->posts);

    return $query;
  }
}
