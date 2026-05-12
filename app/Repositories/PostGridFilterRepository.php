<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Program;
use App\Models\Region;
use App\Models\Report;
use App\Models\News;

class PostGridFilterRepository extends BaseRepository
{
    protected $postType = [
        'post',
        'news',
        'program',
        'report',
        'case-study',
        'region'
    ];

    public function all($request = [])
    {
        $request['post_type'] = explode(',', $request['post_type']);
        $query_args = parent::buildQuery($request);

        $query = new \WP_Query($query_args);

        $query->data = collect($query->posts)->map(function ($post) {
            switch ($post->post_type) {
                case 'news':
                    return News::serialize($post);
                    break;

                case 'program':
                    return Program::serialize($post);
                    break;

                case 'report':
                    return Report::serialize($post);
                    break;

                case 'case-study':
                    return CaseStudy::serialize($post);
                    break;

                case 'region':
                    return Region::serialize($post);
                    break;

                default:
                    return Blog::serialize($post);
                    break;
            }
        });

        return $query;
    }
}
