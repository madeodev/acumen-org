<?php

namespace App\Endpoints;

use App\Models\Query;
use App\Repositories\TeamRepository;

class TeamEndpoint
{

    /**
     * team repository
     */
    private $team;

    public function __construct()
    {
        $this->registerEndpoint();
        $this->team = new TeamRepository();
    }

    public function registerEndpoint()
    {
        add_action('rest_api_init', function () {
            register_rest_route('sage-api/v2', '/team/', array(
              'methods' => 'GET',
              'callback' => [$this, 'index'],
              'permission_callback' => function () {
                  return true;
              }
            ));
        });
    }

    public function index(\WP_REST_Request $request)
    {
        $result = $this->team->all($request);

        return new \WP_REST_Response(Query::serialize($result));
    }
}
