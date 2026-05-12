<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminSettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->polylangCacheBust();

        add_filter('auto_update_plugin', '__return_false');
        add_filter('auto_update_theme', '__return_false');

        add_action('admin_menu', [&$this, 'hideMenuItems']);

        add_action('init', [&$this, 'removeCommentsFromAdminBar']);
        add_action('admin_init', [&$this, 'removeCommentsAccess']);

        add_filter( 'tiny_mce_before_init', [&$this, 'hideTinyMceH1']);
        add_filter('wp_get_nav_menu_items', [&$this, 'ensureNavItemsHaveDescription']);
    }

    private function polylangCacheBust()
    {
        if(in_array('polylang/polylang.php', apply_filters('active_plugins', get_option('active_plugins'))) && !defined('PLL_COOKIE')) {
            define('PLL_COOKIE', false);
        }
    }

    public function hideMenuItems()
    {
        remove_menu_page('edit.php?post_type=acf-field-group');
        remove_menu_page('edit-comments.php');
    }

    public function removeCommentsFromAdminBar()
    {
        if (is_admin_bar_showing()) {
            remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
        }
    }

    public function removeCommentsAccess()
    {
        // Redirect any user trying to access comments page
        global $pagenow;

        if ($pagenow === 'edit-comments.php') {
            wp_redirect(admin_url());
            exit;
        }

        // Remove comments metabox from dashboard
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

        // Disable support for comments and trackbacks in post types
        foreach (get_post_types() as $post_type) {
            if (post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }
    }

    /**
     *  Remove the h1 tag from the TinyMCE editor.
     *
     *  @param   array  $settings  The array of editor settings
     *  @return  array             The modified edit settings
     */
    public function hideTinyMceH1($settings){

        $settings['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
        return $settings;

    }

    
    function ensureNavItemsHaveDescription($items) {
        foreach($items as $key => $item) {
            $items[$key]->description =  $item->description ?? '';
        }
    
        return $items;
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
