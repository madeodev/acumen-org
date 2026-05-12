<?php

namespace App\Endpoints;

use App\Models\Query;
use App\Repositories\FoundryRepository;

class FoundryEndpoint
{

    /**
     * foundry repository
     */
    private $foundry;

    public function __construct()
    {
        $this->registerEndpoint();
        $this->foundry = new FoundryRepository();
    }

    public function registerEndpoint()
    {
        add_action('rest_api_init', function () {
            register_rest_route('sage-api/v2', '/foundry/', array(
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
        $result = $this->foundry->all($request);

        return new \WP_REST_Response(Query::serialize($result));
    }
}
