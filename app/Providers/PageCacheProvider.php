<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PageCacheProvider extends ServiceProvider
{
    public static $pageCachedLastUpdate = 'post_type_cache_blocks_updated';
    private $optionField = 'post_type_cache_blocks';

    /**
     * @var array
     *
     * Format: [
     *     'acf/blockName' => [
     *         'post_type_1',
     *         'post_type_2',
     *     ]
     * ]
     */
    private $blocks = [
        'acf/company-grid' => [
            'company',
        ],
        'acf/foundry-grid' => [
            'foundry',
        ],
        'acf/interactive-map' => [
            'problem',
            'region',
            'program',
        ],
        'acf/people-grid' => [
            'Team',
        ],
        'acf/post-grid-with-filter' => [
            'report',
            'news',
            'post',
            'case-study',
            'program',
            'region',
        ],
        'acf/related-featured-posts' => [
            'case-study',
            'company',
            'news',
            'partner',
            'problem',
            'program',
            'region',
            'report',
            'post',
            'Team',
        ],
    ];

    /**
     * @var array
     *
     * A list of all the post types that should trigger the page cache update
     */
    private $postTypes = [
        'case-study',
        'company',
        'news',
        'partner',
        'problem',
        'program',
        'region',
        'report',
        'post',
        'team',
    ];

    /**
     * @var array
     *
     * Generic endpoints that should trigger the page cache update
     * For example: get_rest_url(null, 'sage-api/v2/search')
     */
    private $routes = [
        'company',
        'foundry',
        'programs',
        'team',
        'post-grid/filters',
        'post-grid/posts',
        'terms',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_action('init', [&$this, 'savePostAction'], 10, 2);
        add_action('save_post_page', [&$this, 'savePageBlocks'], 10, 2);
        add_action('init', [&$this, 'gatherPageBlocks'], 10, 2);
    }

    /**
     * Loop through the post types, check if they exist, and run the save_post action
     * to chear the page cache
     */
    public function savePostAction()
    {
        foreach ($this->postTypes as $cpt) {
            if (!post_type_exists($cpt)) {
                continue;
            }

            add_action('save_post_' . $cpt, [&$this, 'clearPageCache'], 10);
            add_action('save_post_' . $cpt, [&$this, 'clearEndpointCache'], 10);
        }
    }

    /**
     * Gather all the posts and update the cached blocks for the pages
     *
     * This function is meant to be called once per day, and is used to clear the
     * page cache for all pages that have any of the blocks listed in the class
     * property $blocks.
     */
    public function gatherPageBlocks()
    {
        if (empty($_REQUEST['clear_page_block_cache'])) {
            return;
        }

        // if the last update is more than a day old, run the code
        $updatedPageBlockData = get_option(self::$pageCachedLastUpdate, '');

        if (!empty($updatedPageBlockData) && $updatedPageBlockData < date('Y-m-d H:i:s', strtotime('-1 day'))) {
            return;
        }

        // get all the pages
        $pages = get_posts([
            'post_type' => 'page',
            'posts_per_page' => -1,
        ]);

        // loop through each page and run the savePageBlockData function
        // to update the cached blocks for the page
        foreach ($pages as $page) {
            $this->savePageBlockData($page);
        }
    }

    /**
     * Save the page blocks for the current page.
     *
     * This function is meant to be called when saving a page. It checks if any of the
     * blocks listed in the class property $blocks are on the current page, and if so, it
     * saves the page block data as an option in the database.
     *
     * @param int $postID The post ID of the page being saved.
     * @param WP_Post $post The post object of the page being saved.
     */
    public function savePageBlocks($postID, $post)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // only save the page block data for pages, not revisions
        $postType = get_post_type($postID);
        if ($postType !== 'page' && $postType === 'revision') {
            return;
        }

        // save the page block data
        $this->savePageBlockData($post);
    }

    /**
     * Cache the pages that contain any of the blocks listed above. Save
     * the data as an option in the database so it can be referenced when saving
     * or updating a post from any of the post types.
     *
     * This function is called when saving a page and checks if any of the blocks
     * listed in the class property $blocks are on the current page. If so, it
     * saves the page block data as an option in the database.
     *
     * @param WP_Post $post The post object of the page being saved.
     */
    private function savePageBlockData($post)
    {
        $postID = $post->ID;
        $content = $post->post_content;
        $blockNames = collect(parse_blocks($content))->pluck('blockName')->intersect(collect($this->blocks)->keys());
        $parsedBlockNames = $blockNames->intersect(collect($this->blocks)->keys())->isNotEmpty();

        // Get the cached page blocks
        $cachedPageBlocks = get_option($this->optionField, '');
        $cachedPageBlocks = json_decode($cachedPageBlocks, true) ?? [];

        // If the page does not contain any of the blocks listed in $blocks and is not cached, return
        if (empty($parsedBlockNames) && !in_array($postID, $cachedPageBlocks)) {
            return;
        }

        // If the page contains any of the blocks listed in $blocks and is already cached, return
        if (!empty($parsedBlockNames) && in_array($postID, $cachedPageBlocks)) {
            return;
        }

        // If the page does not contain any of the blocks listed in $blocks and is cached, remove it from the cache
        if (empty($parsedBlockNames) && in_array($postID, $cachedPageBlocks)) {
            $cachedPageBlocks = collect($cachedPageBlocks)->filter(function ($blocks, $id) use ($postID) {
                return $id !== $postID;
            });
        } else {
            // If the page contains any of the blocks listed in $blocks and is not cached, add it to the cache
            $cachedPageBlocks[$postID] = $blockNames->toArray();
        }

        // Save the cached page blocks
        update_option($this->optionField, json_encode($cachedPageBlocks));

        // Save the last update timestamp
        update_option(self::$pageCachedLastUpdate, date('Y-m-d H:i:s'));
    }

    /**
     * Clear the page cache for the pages that contain any of the blocks
     * listed above based on the current post type being saved.
     *
     * This function is meant to be called when saving a post from any of the
     * post types listed in the class property $blocks. It checks if any of the
     * blocks listed in the class property $blocks are on the current page and
     * if so, it clears the page cache for the page.
     *
     * @param int $postID The post ID of the post being saved.
     */
    public function clearPageCache($postID)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        /**
         * Only run if the pantheon_clear_edge_paths function exists
         */
        if (!function_exists('pantheon_clear_edge_paths')) {
            return;
        }

        $postType = get_post_type($postID);

        if ($postType === 'page' || $postType === 'revision') {
            return;
        }

        // get the pages saved in an options row
        $pages = get_option($this->optionField, '');
        $pages = json_decode($pages) ?: [];

        if (empty($pages)) {
            return;
        }

        // gather the blocks that are associated with the current post type
        $blocksToClear = collect($this->blocks)->filter(function ($cpts) use ($postType) {
            return in_array($postType, $cpts);
        })->keys();

        if (empty($blocksToClear)) {
            return;
        }

        // gather the pages that are associated with the current post type,
        // excluding the one that is being saved and any that contain blocks
        $pagesToClear = collect($pages)->filter(function ($blocks, $id) use ($blocksToClear, $postID) {
            return $postID !== $id && collect($blocks)->intersect($blocksToClear)->isNotEmpty();
        })->keys()->unique();

        if (empty($pagesToClear)) {
            return;
        }

        $urls = [];
        // loop through each page and clear the page cache
        foreach ($pagesToClear as $pageID) {
            $urls[] = parse_url(get_permalink($pageID), PHP_URL_PATH);
        }

        if (!empty($urls)) {
            pantheon_clear_edge_paths($urls);
        }
    }

    /**
     * Clear the REST API endpoint cache for the given post type.
     *
     * This function clears the Edge cache for the specified post type's REST API endpoints.
     *
     * @param string $postType The post type to clear the REST API endpoint cache for.
     */
    public function clearEndpointCache($postID)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        /**
         * Only run if the pantheon_clear_edge_paths function exists
         */
        if (!function_exists('pantheon_clear_edge_paths')) {
            return;
        }

        $postType = get_post_type($postID);

        if ($postType === 'page' || $postType === 'revision') {
            return;
        }

        // Define the endpoints that need cache clearing
        $routes = array_merge($this->routes, [
            $postType . '/posts',
        ]);

        $urls = [];
        // Iterate over each endpoint and clear its cache
        foreach ($routes as $route) {
            $endpoint = get_rest_url(null, 'sage-api/v2/' . $route);

            // Parse the REST API path from the endpoint URL
            $urls[] = parse_url($endpoint, PHP_URL_PATH);
        }

        // Clear the cache for the REST API path
        if (!empty($urls)) {
            pantheon_clear_edge_paths(array_unique($urls));
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
