<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Company;
use App\Models\News;
use App\Models\Report;
use App\Models\Problem;
use App\Models\Program;
use App\Models\Region;

class FeaturedPosts extends Component
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $intro;

    /**
     * @var array
     */
    public $large;

    /**
     * @var array
     */
    public $list;

    /**
     * @var array
     */
    public $button;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        $large = $this->getPosts($this->data['large'] ?? []);

        $this->title = $this->data['title'] ?? '';
        $this->intro = $this->data['intro'] ?? '';
        $this->button = $this->data['button'] ?? [];
        $this->large = !empty($large) ? head($large) : [];
        $this->list = $this->getPosts($this->data['list'] ?? []);
    }

    private function getPosts($posts)
    {
        if (empty($posts)) {
            return;
        }

        return collect($posts)->map(function ($post) {
            switch ($post->post_type) {
                case 'company':
                    $item = Company::serialize($post);
                    $item['term'] = $item['primary_problem'];
                    break;

                case 'case-study':
                    $item = CaseStudy::serialize($post);
                    $item['term'] = $item['primary_problem'];
                    break;

                case 'news':
                    $item = News::serialize($post);
                    $item['term'] = $item['primary_problem'];
                    break;

                case 'program':
                    $item = Program::serialize($post);
                    $item['term'] = $item['primary_region'];
                    break;

                case 'report':
                    $item = Report::serialize($post);
                    $item['term'] = $item['primary_region'];
                    break;

                case 'problem':
                    $item = Problem::serialize($post);
                    $item['term'] = $item['primary_problem'];
                    break;

                case 'region':
                    $item = Region::serialize($post);
                    $item['term'] = $item['primary_problem'];
                    break;

                default:
                    $item = Blog::serialize($post);
                    $item['secondary_term'] = $item['primary_region'];
                    $item['term'] = $item['type'];
                    break;
            }

            return $item;
        })->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.featured-posts');
    }
}
