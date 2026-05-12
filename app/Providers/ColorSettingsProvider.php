<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ColorSettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_action('admin_init', [&$this, 'registerColorThemeSettings']);
        add_action('admin_menu', [&$this, 'addThemeSettingsPage']);
    }

    public function addThemeSettingsPage()
    {
        add_submenu_page(
            'options-general.php',
            __('Theme Settings', 'sage'),
            __('Theme Settings', 'sage'),
            'manage_options',
            'theme_settings',
            [&$this, 'themeSettingsPageHtml']
        );
    }

    public function themeSettingsPageHtml()
    {
        // check user capabilities
        if (! current_user_can('manage_options')) {
            return;
        }

        // show error/update messages
        settings_errors('theme_settings_messages');
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "theme_settings"
                settings_fields('theme_settings');
        do_settings_sections('theme_settings');
        submit_button('Save Settings');
        ?>
            </form>
        </div>
        <?php
    }

    public function registerColorThemeSettings($wp_customize)
    {
        $options = get_option('theme_settings');
        register_setting('theme_settings', 'site_theme');

        add_settings_section(
            'site_theme_section',
            '',
            [&$this, 'siteThemeSectionCallback'],
            'theme_settings'
        );

        add_settings_field(
            'site_theme',
            __('Site Theme', 'sage'),
            [&$this, 'getSiteThemeOptions'],
            'theme_settings',
            'site_theme_section',
            [
                'type' => 'select',
                'option_group' => 'site_theme',
                'name' => 'site_theme',
                'label_for' => 'site_theme',
                'value' => $options['site_theme'] ?? 0,
                'checked' => $options['site_theme'] ?? 0,
            ]
        );
    }

    public function siteThemeSectionCallback($args)
    {
        // display nothing
    }

    public function getSiteThemeOptions(array $args)
    {
        $theme_options = [
            'theme_1' => __('Theme 1', 'sage'),
            'theme_2' => __('Theme 2', 'sage'),
        ];

        $options = get_option($args['option_group']);

        $html = '<select id="' . esc_attr($args['name']) . '" name="' . esc_attr($args['option_group'] . '['.$args['name'].']') .'">';
        foreach ($theme_options as $value => $label) {
            $option_value = (!isset($options[$args['name']]))
            ? null : $options[$args['name']];

            $checked = '';
            if(!empty($option_value) && $option_value === $value) {
                $checked = ' selected="selected" ';
            }

            $html .= '<option value="' . $value . '" ' . $checked . '>' . $label . '</option>';
        }

        $html .= '</select>';

        if (!empty($args['description'])) {
            $html .= '<br /><span class="wndspan">' . esc_html($args['description']) .'</span>';
        }

        if (!empty($args['tip'])) {
            $html .= '<b class="wntip" data-title="'. esc_attr($args['tip']) .'"> ? </b>';
        }

        echo $html;
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
