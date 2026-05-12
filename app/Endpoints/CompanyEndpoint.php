<?php

namespace App\Endpoints;

use App\Models\Query;
use App\Repositories\CompanyRepository;

class CompanyEndpoint
{

    /**
     * company repository
     */
    private $company;

    public function __construct()
    {
        $this->registerEndpoint();
        $this->company = new CompanyRepository();
    }

    public function registerEndpoint()
    {
        add_action('rest_api_init', function () {
            register_rest_route('sage-api/v2', '/company/', array(
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
        $result = $this->company->all($request);

        return new \WP_REST_Response(Query::serialize($result));
    }
}
