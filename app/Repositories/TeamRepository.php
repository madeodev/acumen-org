<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\BaseRepository;

class TeamRepository extends BaseRepository
{
  protected $postType = 'team';

  public function all($request = [])
  {
    $request['order'] = 'ASC';
    $request['orderby'] = 'title';
    
    $query_args = parent::buildQuery($request);

    $query = new \WP_Query($query_args);

    $query->data = Team::collection($query->posts);

    return $query;
  }
}
