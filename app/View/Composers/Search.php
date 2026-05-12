<?php

namespace App\View\Composers;

use App\Models\Query;
use App\Models\Search as ModelsSearch;
use Roots\Acorn\View\Composer;

class Search extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'search',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {   
        global $wp_query;
        $query = Query::serialize($wp_query);

        return [
            'title' => __('Search results for:','search') .' '. $query['query']['s'],
            'info' => $this->info($query),
            'query' => $query,
            'results' => ModelsSearch::collection($query['data']),
        ];
    }

    public function info($query){

        $total_posts = $query['total_posts'];
        $results = $total_posts == 1 ? __('result', 'search') : __('results', 'search');

        $last_post = min($query['current_page'] * $query['posts_per_page'], $query['total_posts']);
        $first_post = $query['current_page'] * $query['posts_per_page'] - $query['posts_per_page'] + 1;

        $sentence = $total_posts .' '. $results .' '. __('found for:') .' &ldquo;'. $query['query']['s'] .'&rdquo;. ';
        if($total_posts == 0) return $sentence;

        // e.g. '5 results found for "people". Showing 1 - 5'
        return $sentence. __('Showing', 'search') .' '. $first_post .' - '. $last_post;

    }
}
