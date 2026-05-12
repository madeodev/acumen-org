<?php

namespace App\Endpoints;

use App\Models\Query;
use App\Models\Term;
use App\Repositories\PostGridFilterRepository;

class PostGridFilterEndpoint
{

    /**
     * post grid repository
     */
    private $postGridFilter;

    public function __construct()
    {
        $this->registerEndpoint();
        $this->postGridFilter = new PostGridFilterRepository();
    }

    public function registerEndpoint()
    {
        add_action('rest_api_init', function () {
            register_rest_route('sage-api/v2', '/post-grid/filters/', array(
                'methods' => 'GET',
                'callback' => [$this, 'indexFilters'],
                'permission_callback' => function () {
                    return true;
                }
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('sage-api/v2', '/post-grid/posts/', array(
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
        $result = $this->postGridFilter->all($request);

        return new \WP_REST_Response(Query::serialize($result));
    }

    public function indexFilters(\WP_REST_Request $request)
    {
        $postType = $request['post_type'];

        $result = Term::getByPostType(
            explode(',', $postType),
            array_filter(explode(',', $request['exclude']))
        );

        return new \WP_REST_Response(['data' => $result]);
    }
}
