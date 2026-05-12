<?php

namespace App\Repositories;

use App\Models\Partner;
use App\Repositories\BaseRepository;

class PartnerRepository extends BaseRepository
{
  protected $postType = 'partner';

  public function all($request = [])
  {
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Partner::collection($query->posts);

    return $query;
  }
}
