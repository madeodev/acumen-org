<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\HeadingIntro;
use App\Providers\PageCacheProvider;

class SiteSettings extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Site Settings';

    /**
     * The option page menu slug.
     *
     * @var string
     */
    public $slug = 'site-settings';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Site Settings | Options';

    /**
     * The option page permission capability.
     *
     * @var string
     */
    public $capability = 'edit_theme_options';

    /**
     * The option page menu position.
     *
     * @var int
     */
    public $position = PHP_INT_MAX;

    /**
     * The slug of another admin page to be used as a parent.
     *
     * @var string
     */
    public $parent = null;

    /**
     * The option page menu icon.
     *
     * @var string
     */
    public $icon = null;

    /**
     * Redirect to the first child page if one exists.
     *
     * @var boolean
     */
    public $redirect = true;

    /**
     * The post ID to save and load values from.
     *
     * @var string|int
     */
    public $post = 'options';

    /**
     * The option page autoload setting.
     *
     * @var bool
     */
    public $autoload = true;

    /**
     * Localized text displayed on the submit button.
     *
     * @return string
     */
    public function updateButton()
    {
        return __('Update', 'acf');
    }

    /**
     * Localized text displayed after form submission.
     *
     * @return string
     */
    public function updatedMessage()
    {
        return __('Site Settings Updated', 'acf');
    }

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $siteSettings = new FieldsBuilder('site_settings');
        $pageCachedLastUpdate = get_option(PageCacheProvider::$pageCachedLastUpdate, '');

        $siteSettings
            ->addTab('featured_posts', [
                'label' => __('Featured Posts', 'sage')
            ])
            ->addGroup('featured_posts', [
                'label' => __('Default Settings', 'sage'),
                'instructions' => __('Default settings for the featured post module displayed for single posts. The fields below can be updated per post type under their corresponding settings page.<br /><br /><strong>Note: This does not affect the usage of the Featured Posts module in pages.</strong>', 'sage'),
            ])
            ->addFields($this->get(HeadingIntro::class))
            ->endGroup()
            ->addTab('cached_page_blocks', ['label' => __('Cached Page Blocks', 'sage'),])
            ->addMessage('clear_cached_page_blocks', 'Clear the cached page blocks', [
                'message' => __('Admin use only! Only use this if some of the modules that automatically pulling posts are not up-to-date as a new post is added.

                This was last updated on: ' . $pageCachedLastUpdate . '

                <a class="button button-primary button-large" href="' . get_admin_url() . '?clear_page_block_cache=true">Clear cached page blocks</a>', 'sage'),
            ]);

        return $siteSettings->build();
    }
}
