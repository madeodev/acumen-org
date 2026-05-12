<?php

namespace App\Concerns;

/**
 * Colors
 *
 * Use to add color choices to FieldsBuilder and to retrieve matching color classes for components
 *
 * Public functions: getColorOptions, classes, hasSection, static getSiteTheme
 */
class Colors
{
    private $colors;
    private $color_classes;

    /**
     * Colors
     *
     * When defining keys here that are offered to the user with getColorOptions() be sure to set up a matching button style in wpUiButtons()
     *
     * The first key will be considered 'default' in that it will be returned if a requested key does not exist
     * and if a color option is an array, missing keys will be filled in from the first key.
     *
     * @return array the color choices for the component
     */
    protected static function colors() : array
    {
        return [];
    }

    /**
     * Site Color Themes
     *
     * If this is a multi-site you may want to allow sites to use different sets of colors.
     *
     * Set up matching options (e.g theme_1, theme_2) in the CustomizerProvider.
     *
     * Consider adding a note in Site Settings to point users to this setting in the Customizer.
     *
     * Each color theme here is composed of a color theme key and the color styles that are available
     * in that color theme.
     *
     * When you use the getColorOptions function to build color options, those options will be
     * automatically filtered for you based on the site color theme defined here.
     *
     * Override this in a component Class to set up theme specific colors for a given component.
     *
     * @return array the site color themes
     */
    protected function siteColorThemes() : array
    {
        return [
            'theme_1' => ['black', 'white'],
            'theme_2' => ['white'],
          ];
    }

    /**
     * WP UI Buttons
     *
     * Every color key in $colors should have a button style and label defined.
     * The button_style key should contain tailwind classes for text and background color.
     *
     * @return array the
     */
    private function wpUiButtons()
    {
        return [
            'black' => [
                'label' => __('Black', 'sage'),
                'button_style' => 'text-white bg-black'
            ],
            'white' => [
                'label' => __('White', 'sage'),
                'button_style' => 'text-black bg-white'
            ],
            'stone' => [
                'label' => __('Stone', 'sage'),
                'button_style' => 'text-black bg-stone'
            ],
            'orange' => [
                'label' => __('Orange', 'sage'),
                'button_style' => 'text-black bg-orange'
            ],
            'spice' => [
                'label' => __('Spice', 'sage'),
                'button_style' => 'text-black bg-spice'
            ],
            'gold' => [
                'label' => __('Gold', 'sage'),
                'button_style' => 'text-black bg-gold'
            ],
            'lime' => [
                'label' => __('Lime', 'sage'),
                'button_style' => 'text-black bg-lime'
            ],
            'mizuna' => [
                'label' => __('Mizuna', 'sage'),
                'button_style' => 'text-black bg-mizuna'
            ],
            'turquoise' => [
                'label' => __('Turquoise', 'sage'),
                'button_style' => 'text-black bg-turquoise'
            ],
            'provence-text-black' => [
                'label' => __('Provence', 'sage'),
                'button_style' => 'text-black bg-provence'
            ],
            'azalea' => [
                'label' => __('Azalea', 'sage'),
                'button_style' => 'text-black bg-azalea'
            ],
            'ember' => [
                'label' => __('Ember', 'sage'),
                'button_style' => 'text-black bg-ember'
            ],
            'daisy' => [
                'label' => __('Daisy', 'sage'),
                'button_style' => 'text-black bg-daisy'
            ],
            'racecar' => [
                'label' => __('Racecar', 'sage'),
                'button_style' => 'text-white bg-racecar'
            ],
            'cactus' => [
                'label' => __('Cactus', 'sage'),
                'button_style' => 'text-white bg-cactus'
            ],
            'woad' => [
                'label' => __('Woad', 'sage'),
                'button_style' => 'text-white bg-woad'
            ],
            'verdigris' => [
                'label' => __('Verdigris', 'sage'),
                'button_style' => 'text-white bg-verdigris'
            ],
            'sapphire' => [
                'label' => __('Sapphire', 'sage'),
                'button_style' => 'text-white bg-sapphire'
            ],
            'lapis' => [
                'label' => __('Lapis', 'sage'),
                'button_style' => 'text-white bg-lapis'
            ],
            'provence' => [
                'label' => __('Provence', 'sage'),
                'button_style' => 'text-white bg-provence'
            ],
            'amethyst' => [
                'label' => __('Amethyst', 'sage'),
                'button_style' => 'text-white bg-amethyst'
            ],
            'tulip' => [
                'label' => __('Tulip', 'sage'),
                'button_style' => 'text-white bg-tulip'
            ],
            'cinnabar' => [
                'label' => __('Cinnabar', 'sage'),
                'button_style' => 'text-white bg-cinnabar'
            ],
            'nutmeg-light' => [
                'label' => __('Nutmeg Light', 'sage'),
                'button_style' => 'text-white bg-nutmeg-light'
            ],
            'ocean' => [
                'label' => __('Ocean', 'sage'),
                'button_style' => 'text-white bg-ocean'
            ],
            'plum' => [
                'label' => __('Plum', 'sage'),
                'button_style' => 'text-white bg-plum'
            ],

        ];
    }

    /**
     * Colors
     *
     * Pass $component and $component_color parameters to generate the color classes.
     *
     * Use the classes() method to return them for your view.
     *
     * E.g in with():
     * 'colors' => new ButtonColors(cinnabar),
     * and in your view:
     * {{ $colors->classes('text') }}
     *
     * @param string $component_color (optional) the key of a color defined for the component in ColorValues->colors(). Will return default (first key) colors if unspecified or key doesn't exist.
     */
    public function __construct(
        private string $component_color = ''
    ) {
        $this->colors = static::colors();
        $this->color_classes = $this->getColorClasses();
    }


    /**
     * classes()
     *
     * Returns classes for the component and color specified in the class constructor
     *
     * @param string $section (optional) the key of the component 'section' you wish to return. (I.e. your 'colorway' component may have keys for 'text' and 'button' classes.) Omit if the component is a simple string with no sections
     *
     * @return string the component classes
     */
    public function classes(string $section = '') : string|array
    {
        $color_classes = $this->color_classes;

        if(is_string($color_classes)) {
            return $color_classes;
        }

        return $color_classes[$section] ?? '';
    }

    /**
     * @return bool returns true if the 'section' array key exists.
     */
    public function hasSection(string $section) : bool
    {
        return !empty($this->color_classes[$section]);
    }

    /**
    * getColorOptions()
    *
    * Use to add color choices to a FieldsBuilder
    *
    * Get all colors:
    * ->addRadio('color', ['label' => __('Color', 'sage'),])
    *   ->addChoices((new ButtonColors())->getColorOptions())
    *
    * Get only specified colors:
    * - note if using Site Color Themes these specified colors will only be returned if they are part of the active color theme
    *
    * ->addRadio('color', ['label' => __('Color', 'sage'),])
    *   ->addChoices((new ButtonColors())->getColorOptions(['beige', 'cactus-200', 'aqua']))
    *
    * @param array $specified_colors (optional) pass an array of colors to get only those options.
    *
    * @return array return the color options
    */
    public function getColorOptions(array $specified_colors = [])
    {
        $colors = $this->colors;

        $component_site_color_theme = $this->getComponentColorTheme();

        if (!empty($specified_colors)) {
            $colors = $this->filterColors($colors, $specified_colors, $component_site_color_theme);
        }
        return $this->getButtons($colors);
    }

    /**
     * getSiteTheme()
     *
     * Get the site color theme from the WP Customizer.
     * If you wish to use this feature, be sure to setup this option in Providers/SiteSettingsProvider.
     *
     * Note that View/Composers/App includes a siteTheme variable that you can use in any view.
     *
     * @return array|false returns the value of the site_theme as selected in the settings page.
     */
    public static function getSiteTheme()
    {
        return once(function () {
            return get_option('site_theme')['site_theme'] ?? false;
        });
    }

    /**
     * getColorClasses()
     *
     * Gets the color classes to populate $color_classes
     *
     * @return array|string the requested color palette
     */
    private function getColorClasses()
    {
        $color = $this->component_color;
        $colors = $this->colors;

        if (array_key_exists($color, $colors)) {
            if(is_array($colors[$color]) && is_array(reset($colors))) {
                return array_merge(reset($colors), $colors[$color]);
            } else {
                return $colors[$color];
            }
        }

        return reset($colors);
    }

    /**
     * getSiteColorTheme()
     *
     * Get the site color theme from the site settings.
     * If you wish to use this feature, be sure to setup this option in Providers/SiteSettingsProvider.
     *
     * Note that View/Composers/App includes a siteColorTheme variable that you can use in any view.
     *
     * @return array|false returns the site_color_theme array or false
     */
    private function getSiteColorTheme()
    {
        $site_color_theme_name = self::getSiteTheme() ?? false;
        $site_color_themes = $this->siteColorThemes();

        // Check if the color theme defined in the site settings exists in our site_color_themes array
        if ($site_color_theme_name !== false && key_exists($site_color_theme_name, $site_color_themes)) {
            return $site_color_themes[$site_color_theme_name];
        }

        return false;
    }

    /**
     * getComponentColorTheme()
     *
     * If using Site Color Themes this gets the color options for a component
     * for the current site theme as defined in ColorValues->siteColorThemes().
     *
     * Returns false if there is no active site color theme.
     *
     * @param string $component (required) the component to get color options for.
     * @return array|false returns the component colors array from siteColorThemes or false
     */
    private function getComponentColorTheme()
    {
        $active_color_theme = $this->getSiteColorTheme();

        if ($active_color_theme === false) {
            return false;
        }

        return $active_color_theme ;
    }

    /**
     * filterColors()
     *
     * @param array $colors
     * @param array $specified_colors
     * @param bool|array $color_theme
     * @return array filters colors for specified and in color theme
     */
    private function filterColors(array $colors, $specified_colors, $color_theme)
    {
        return collect($colors)
            ->filter(function ($value, $key) use ($specified_colors, $color_theme) {
                return
                    (in_array($key, $specified_colors) && ($color_theme === false || in_array($key, $color_theme)))
                    || (empty($specified_colors) && ($color_theme === false || in_array($key, $color_theme)));
            })
            ->toArray();
    }

    /**
     * getButtons()
     *
     * @param array $colors
     * @return array the requested color palette
     */
    private function getButtons(array $colors)
    {
        $wp_ui_buttons = $this->wpUiButtons();

        return collect($colors)
            ->mapWithKeys(function ($value, $key) use ($wp_ui_buttons) {
                $button_is_defined = key_exists($key, $wp_ui_buttons);
                $label = $button_is_defined ? $wp_ui_buttons[$key]['label'] : $key;
                $button_style = $button_is_defined ? $wp_ui_buttons[$key]['button_style'] : reset($wp_ui_buttons)['button_style'];

                return [$key => "<div class='{$button_style} m-1 px-4 py-1.5 inline-flex rounded-full border border-solid border-opacity-75 border-black text-sm'>{$label}</div>"];
            })
            ->toArray();
    }

}
