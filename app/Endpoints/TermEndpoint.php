<?php

namespace App\Endpoints;

use App\Models\Query;
use App\Models\Term;

class TermEndpoint
{
    public function __construct()
    {
        $this->registerEndpoint();
    }

    public function registerEndpoint()
    {
        add_action('rest_api_init', function () {
            register_rest_route('sage-api/v2', '/terms/(?P<post_type>[a-zA-Z0-9-]+)', array(
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
        $postType = $request['post_type'];

        $result = Term::getByPostType(
            $postType,
            array_filter(explode(',', $request['exclude'])),
            [],
            $request['args'] ? json_decode($request['args'], true) : [],
        );

        return new \WP_REST_Response(['data' => $result]);
    }
}
