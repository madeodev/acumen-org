<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AcfProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_filter('acf/fields/post_object/query', [&$this, 'updatePostObjectQuery'], 10, 3);
    }

    /**
     * Remove the current post from the list of pages in the field
     */
    public function updatePostObjectQuery($args, $field, $post_id)
    {
        $args['post__not_in'] = [$post_id];
        return $args;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
