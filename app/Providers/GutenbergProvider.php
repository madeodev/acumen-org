<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GutenbergProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_filter('block_categories_all', [&$this, 'addCustomGutenbergCategories']);
        add_filter('allowed_block_types_all', [&$this, 'allowedBlocks'], 10, 2);
    }

    /**
     * Register a new category within Gutenberg
     *
     * @return array
     */
    public function addCustomGutenbergCategories($categories)
    {
        array_unshift(
            $categories,
            [
                'slug' => 'acumen',
                'title' => __('Acumen', 'sage'),
                'icon' => ''
            ],
            [
                'slug' => 'bw-blox',
                'title' => __('Briteweb Blox', 'sage'),
                'icon' => ''
            ]
        );

        return $categories;
    }

    /**
     * Dequeue the block library styles
     *
     * @return void
     */
    public function dequeueCoreBlockStyles()
    {
        wp_deregister_style('wp-block-library');
    }

    /**
     * Register all acf blocks into Gutenberg automatically
     *
     * @return array
     */
    public function allowedBlocks($allowed_blocks, $editor_context)
    {
        if (!function_exists('acf_get_block_types')) {
            return;
        }

        $blocks = [
            'core/heading',
            'core/paragraph',
            'core/list',
            'core/quote',
            'core/list-item',
            'core/separator',
            'core/embed'
        ];

        $acf_blocks = collect(acf_get_block_types())->filter(function ($block, $block_name) {
            return strpos($block_name, 'acf/') > -1;
        })->keys()->toArray();

        $blocks = array_merge($blocks, $acf_blocks);

        return $blocks;
    }
}
