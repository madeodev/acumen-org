<?php

namespace App\Repositories;

use App\Models\Term;
use App\Concerns\Translation;

abstract class BaseRepository
{
    /**
     * @var string
     */
    protected $postType = 'post';

    /**
     * @var int
     */
    protected $per_page = 14;

    /**
     * @return \WP_Query
     */
    protected function all($request = [])
    {
        $query_args = $this->buildQuery($request);

        $query = new \WP_Query($query_args);

        return $query;
    }

    /**
     * Add a check for the terms if the post type supports a particular term in the URL parameters
     */
    public function buildQuery($request = [])
    {
        $query_args = [
            'post_type' => $request['post_type'] ?? $this->postType,
            'posts_per_page' => $request['per_page'] ?? $this->per_page,
            'order' => $request['order'] ?? 'DESC',
            'suppress_filters' => 0,
        ];

        if (!empty($request['orderby'])) {
            $query_args['orderby'] = $request['orderby'];
        }

        if (!empty($request['post__not_in'])) {
            $query_args['post__not_in'] = $request['post__not_in'];
        }

        if (!empty($request['post__in'])) {
            $query_args['post__in'] = explode(',', $request['post__in']);
        }

        if (!empty($request['page'])) {
            $query_args['paged'] = $request['page'];
        }

        if (!empty($request['name'])) {
            $query_args['name'] = $request['name'];
        }

        if (!empty($request['terms'])) {
            $available_terms = Term::getByPostType($query_args['post_type']);
            $all_terms = [];

            foreach (json_decode($request['terms'], true) as $term) {
                $supports_tax = collect($available_terms)->filter(function ($available) use ($term) {
                    return !empty($term['taxonomy']) && $term['taxonomy'] === $available['slug'];
                })->toArray();

                if (empty($supports_tax)) {
                    continue;
                }

                if (empty($term['ID'])) {
                    continue;
                }

                $all_terms[$term['taxonomy']][] = $term['ID'];
            }

            foreach ($all_terms as $tax => $terms) {
                $query_args['tax_query'][] = [
                    'taxonomy' => $tax,
                    'field' => 'term_id',
                    'terms' => $terms
                ];
            }
        }

        if (!empty($request['exclude_terms'])) {

            $exclude = json_decode($request['exclude_terms'], true);

            foreach ($exclude as $tax => $terms) {
                $query_args['tax_query'][] = [
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => $terms,
                    'operator' => 'NOT IN',
                ];
            }
        }

        if (!empty($request['tax_empty'])) {
            $query_args['tax_query'][] = [
                'taxonomy' => $request['tax_empty'],
                'operator' => 'NOT EXISTS'
            ];
        }

        if (!empty($request['search']) && $request['search'] !== 'null') {
            $query_args['s'] = $request['search'];
        }

        $translation = new Translation;
        $current_lang = $translation->current_lang;
        if (!empty($current_lang) && $translation->wpml_active) {
            global $sitepress;
            $sitepress->switch_lang($current_lang);
        }

        return $query_args;
    }
}
