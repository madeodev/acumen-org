<?php

namespace App\Concerns;

use function esc_html;

class AcfUtils
{
    /**
     * blockTitle
     *
     * Use to add a nice big heading with the block title, the block icon, and an optional message. Aims to solve the problem of it being hard to see the beginning and end of blocks in edit mode.
     *
     * Usage:
     * ->addMessage('block_title', '', AcfUtils::blockTitle(
     *   $this->name, $this->icon, __('Optionally add a message')
     * ))
     *
     *
     * @param string $title The block title - use $this->name to avoid double typing the block name
     * @param string $icon The block icon - use $this->icon to reference the icon as defined in the block
     * @param string $message The block message - use $this-description to use the block description or include edit screen specific instructions here like __('your message', 'sage')
     * @return array the ACF Fields Builder Message fields
     */
    public static function blockTitle(string $title, string $icon, string $message = '')
    {
        return
            [
                'label' => '',
                'message' => '<h2 class="flex items-center">
                                <span class="dashicon dashicons dashicons-' . $icon . ' mr-4"></span>' .
                                esc_html($title) .
                            '</h2>'
                            . (! empty($message) ? '<p class="mt-2">' . esc_html($message) . '</p>' : '')
            ]
        ;
    }

    /**
     * repeaterTitle
     *
     * Use this to add a nice big heading at the start of each repeater item with a name like 'Tab', 'Card' etc and an icon. Aims to solve the problem of it being hard to see where one repeater item ends and the next begins.
     *
     * Usage:
     * ->addMessage('repeater_title', '', AcfUtils::repeaterTitle('Tab','icon'))
     *
     * @param string $title The repeater section title - i.e. Tab, Card, Image, whatever you're repeating
     * @param string $icon an icon from dashicons - e.g. align-wide (that's the default)
     * @return array the ACF Fields Builder Message fields
     */
    public static function repeaterTitle(string $title, string $icon = 'align-wide')
    {
        return
            [
                'label' => '',
                'message' => '<h3 class="text-xl flex items-center gap-4 border-b border-current/50 pb-2">
                                <span class="dashicon dashicons dashicons-' . $icon . '"></span>' .
                                esc_html($title) .
                            '</h3>',
                'wrapper' => [ 'width' => '30%', ],
            ]
        ;
    }

    /**
     * get country options for acf field from json file
     */
    public static function countryOptions()
    {
        $countries = \Roots\asset('json/country-data.json');

        return collect(json_decode($countries->contents()))
            ->transform(function ($country) {
                return $country->name;
            })
            ->toArray();
    }
}
