<?php

namespace App\Endpoints;

use App\Models\Query;
use App\Repositories\ProgramRepository;

class ProgramEndpoint
{

    /**
     * program repository
     */
    private $program;

    public function __construct()
    {
        $this->registerEndpoint();
        $this->program = new ProgramRepository();
    }

    public function registerEndpoint()
    {
        add_action('rest_api_init', function () {
            register_rest_route('sage-api/v2', '/programs/', array(
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
        $result = $this->program->all($request);

        return new \WP_REST_Response(Query::serialize($result));
    }
}
