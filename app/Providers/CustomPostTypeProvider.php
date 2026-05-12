<?php

namespace App\Providers;

use App\PostTypes\CaseStudyPostType;
use App\PostTypes\CompanyPostType;
use App\PostTypes\FoundryPostType;
use App\PostTypes\NewsPostType;
use App\PostTypes\PartnerPostType;
use App\PostTypes\Post;
use App\PostTypes\ProblemPostType;
use App\PostTypes\ProgramPostType;
use App\PostTypes\RegionPostType;
use App\PostTypes\ReportPostType;
use App\PostTypes\TeamPostType;
use Illuminate\Support\ServiceProvider;

class CustomPostTypeProvider extends ServiceProvider
{
    protected $postTypes = [
        CaseStudyPostType::class,
        CompanyPostType::class,
        FoundryPostType::class,
        NewsPostType::class,
        PartnerPostType::class,
        Post::class,
        ProblemPostType::class,
        ProgramPostType::class,
        RegionPostType::class,
        ReportPostType::class,
        TeamPostType::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_action('init', [&$this, 'registerPostTypes']);
    }

    /**
     * Register post types
     *
     * @return void
     */
    public function registerPostTypes()
    {
        collect($this->postTypes)->each(function ($className) {
            $instance = $this->app->make($className);
            $this->app->singleton($className, function () use ($instance) {
                return $instance;
            });
        });
    }

    /**
     * Get post type labels
     *
     * @param string $postType
     * @return array
     */
    public static function getPostTypeLabels(string $postType): array {
        $obj = get_post_type_object($postType);
        $labels = get_post_type_labels($obj);

        return [
            'name' => $labels->name,
            'singular_name' => $labels->singular_name,
        ];
    }
}
