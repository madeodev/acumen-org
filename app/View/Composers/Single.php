<?php

namespace App\View\Composers;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Company;
use App\Models\News;
use App\Models\Post;
use App\Models\Problem;
use App\Models\Program;
use App\Models\Region;
use App\Models\Report;
use App\Models\Team;
use Roots\Acorn\View\Composer;

class Single extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-single',
        'partials.content-single-*',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        global $post;

        switch ($post->post_type) {
            case 'post':
                return Blog::serialize($post);
                break;

            case 'company':
                return Company::serialize($post);
                break;

            case 'report':
                return Report::serialize($post);
                break;

            case 'news':
                return News::serialize($post);
                break;

            case 'case-study':
                return CaseStudy::serialize($post);
                break;

            case 'problem':
                return Problem::serialize($post);
                break;

            case 'region':
                return Region::serialize($post);
                break;

            case 'program':
                return Program::serialize($post);
                break;

            case 'team':
                return Team::serialize($post);
                break;

            default:
                return Post::serialize($post);
                break;
        }
    }
}
