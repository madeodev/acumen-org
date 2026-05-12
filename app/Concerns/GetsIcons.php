<?php

namespace App\Concerns;

class GetsIcons
{
    public static $icons = [
        'media-format' => [
            'video' => 'play_circle',
            'article' => 'news',
            'podcast' => 'podcasts',
            'pdf' => 'picture_as_pdf'
        ],
        'problem-tax' => [
            'generic' => 'center_focus_weak',
            'sustainable-agriculture' => 'psychiatry',
            'climate' => 'wb_sunny',
            'quality-education' => 'laptop_mac',
            'renewable-energy' => 'electric_bolt',
            'gender' => 'woman',
            'healthy-communities' => 'health_and_safety',
            'dignified-jobs' => 'groups',
        ],
        'region' => 'globe',
        'region-tax' => 'globe',
        'fellowship' => 'globe',
        'office' => 'globe',
        'report' => 'lab_profile',
        'program' => 'lens_blur',
        'news' => 'newsmode',
        'case-study' => 'person_celebrate',
        'blog' => 'rss_feed',
        'post' => 'rss_feed',
    ];

    /**
     * Get an icon by taxonomy, post type or taxonomy and term
     *
     * @var string $tax - the taxonomy or post type
     * @var string $slug (optional) the taxonomy term
     * @var string $format (optional) the return type
     *
     * @return string if $format = 'icon' a string to be used in @svg()
     *   - if $format = 'path', the svg path
     *   - returns '' if no icon found
     */
    public static function icon($tax, $slug = null, $format = 'icon'): string
    {
        $icon = self::iconFromSlug($tax, $slug);

        if (empty($icon))
            $icon = self::iconFromTax($tax);

        if (empty($icon)) return '';

        if ($format === 'path')
            return self::getTaxSvgPath($icon);

        return self::getTaxSvg($icon);
    }

    public static function iconFromSlug($tax, $slug = null)
    {
        $icons = self::$icons;
        if (is_null($slug)) return false;
        if (empty($icons[$tax][$slug])) return false;
        if (!is_string($icons[$tax][$slug])) return false;

        return $icons[$tax][$slug];
    }

    /**
     * returns an icon based on the taxonomy or post type
     */
    public static function iconFromTax($tax,)
    {
        $icons = self::$icons;
        if (empty($icons[$tax])) return false;
        if (!is_string($icons[$tax])) return false;

        return $icons[$tax];
    }

    public static function getTaxSvg($icon)
    {
        return 'images.tax-icons.' . $icon;
    }

    public static function getTaxSvgPath($icon)
    {
        $icon = \Roots\asset('/images/tax-icons/' . $icon . '.svg');

        return $icon->uri();
    }

    // Map the icons array into a format we can use in an ACF select
    public static function iconOptions(): array
    {
        return collect(self::$icons)->flatMap(function ($value, $key) {

            $key = str_replace('-tax', '', $key);
            $key = str_replace('-', ' ', $key);

            if (is_array($value)) {
                return collect($value)->flatMap(function ($icon, $tax) use ($key) {
                    return [$icon => ucwords("$key - $tax")];
                })->toArray();
            }

            return [$value => ucwords($key)];
        })->toArray();
    }
}
