<?php

namespace App\Concerns\Colors;

use App\Concerns\Colors;

class ButtonColors extends Colors
{
    /**
     * Colors
     *
     * When defining keys here that are offered to the user with getColorOptions() be sure to set up a matching button style in ColorsSettings->wpUiButtons()
     *
     * The first key will be considered 'default' in that it will be returned if a requested key does not exist
     * and if a color option is an array, missing keys will be filled in from the first key.
     *
     * @return array the color choices for the component
     */
    public static function colors(): array
    {
        /**
         * Default styles added to both black and white button styles
         */
        $button_default = [
            'display' => 'inline-flex items-center justify-center text-center transition-all duration-300 text-md link-no-underline disabled:opacity-50 disabled:pointer-events-none',
            'link_display' => 'inline-flex flex-row-reverse gap-x-2 items-center justify-center text-left transition-all duration-300 text-md disabled:opacity-50 disabled:pointer-events-none',
            'spacing' => 'py-1.25 px-3.5 gap-2',
            'border' => 'rounded-full border',
          ];

        $button_default_all = implode(' ', $button_default);

        $button_icon_default = "h-auto flex-shrink-0 relative z-5
        h-auto flex-shrink-0 relative z-5";

        return [
            'outline-black' => $button_default['spacing'] .' ' . $button_default['border'] . ' border-current text-black bg-transparent hover:text-white hover:bg-black inline-flex items-center justify-center text-center transition-colors duration-300 text-md hover:border-black
            active:border-black link-no-underline',

            'outline-black-active' => $button_default['spacing'] .' ' . $button_default['border'] . ' inline-flex items-center justify-center text-md text-center text-white bg-black border-black hover:bg-black/80 transition duration-300',

            'outline-black-nav' => $button_default['spacing'] .' ' . $button_default['border'] . ' border-current inline-flex items-center justify-center text-center  transition-all duration-300 text-md
            active:border-black hover:border-black hover:text-white hover:bg-black',

            'outline-white' => $button_default_all . ' border-current text-white bg-transparent hover:text-black hover:bg-white hover:border-white
            active:bg-white',

            'outline-white-active' => $button_default['spacing'] .' ' . $button_default['border'] . ' inline-flex items-center justify-center text-md text-center text-white bg-white border-white hover:bg-white/80 transition duration-300',

            'fill' => $button_default_all . ' border-white bg-white text-black
            hover:text-white hover:border-black hover:bg-black',

            'fill-black' => $button_default_all . ' border-black bg-black text-white
            hover:text-black hover:border-white hover:bg-white',

            'nav-donate' =>  $button_default['display'] . ' ' . $button_default['spacing'] . ' ' . $button_default['border'] . ' bg-amethyst border-amethyst text-md text-white hover:border-black hover:bg-stone hover:text-black',

            'link' => $button_default['link_display'] . ' leading-none pb-1 text-left self-start
            animate-underline hover:border-transparent',

            'link-translation' => $button_default['link_display'] . ' leading-none pb-1 font-semibold
            animate-underline',

            'current-page-translation' => $button_default['link_display'] . ' leading-none pb-1 border-b-2 font-semibold',

            'icon-black' => $button_default['display'] . ' ' . $button_default['border'] . ' w-9 h-9 flex-shrink-0 border-current text-black bg-transparent p-1
            hover:text-white hover:bg-black hover:border-black
            active:text-white active:bg-black active:border-black',

            'icon-search-mobile' => $button_default['display'] . ' ' . $button_default['border'] . ' w-9 h-9 flex-shrink-0 border-current p-1',

            'icon-white' => $button_default['display'] . ' ' . $button_default['border'] . ' w-9 h-9 flex-shrink-0 border-current text-white bg-transparent p-1
            hover:text-black hover:bg-white hover:border-white
            focus-visible:text-black focus-visible:bg-white focus-visible:border-white
            active:text-black active:bg-white active:border-white
            group-hover:text-black group-hover:bg-white group-hover:border-white
            group-focus-visible:text-black group-focus-visible:bg-white group-focus-visible:border-white
            group-active:text-black group-active:bg-white group-active:border-white',

            'icon-white-small' => 'h-7 w-7 link-no-underline rounded-full hover:bg-white hover:text-black active:bg-white active:text-black flex items-center justify-center shrink-0',

            'icon-black-small' => 'h-7 w-7 link-no-underline rounded-full hover:bg-black hover:text-white active:bg-black active:text-white flex items-center justify-center shrink-0',

            'icon-search' => $button_default['display'] . ' absolute right-2.75 top-1/2 -translate-y-1/2 rounded-full w-9 h-9 flex-shrink-0 border-current text-white bg-transparent p-1
            hover:text-black hover:bg-white hover:border-white
            focus-visible:text-black focus-visible:bg-white focus-visible:border-white
            active:text-black active:bg-white active:border-white',

            'utility-nav' => [
                'outer' => 'text-sm transition-all hover:pb-2.5 hover:pt-0 inline-block flex flex-row-reverse gap-2.5 py-1.25 px-1 link-no-underline',
                'icon-class' => 'w-2.5 ' . $button_icon_default,
            ],

            'main-nav' => 'text-md pt-3 pb-2 block transition-all border-amethyst link-no-underline',

            'main-nav-mobile' => 'w-full text-left text-md pt-3 pb-2 block transition-all leading-5',

            'main-nav-mobile-btn' => 'w-full text-left pt-3 py-2 block transition-all leading-5',

            'subnav' => [
                'outer' => 'flex items-center whitespace-nowrap flex-row-reverse p-2.5 pr-4.5 gap-2.5 text-base font-semibold rounded group link-no-underline',
                'icon-class' => 'ml-auto mr-0.6 transition-transform group-hover:translate-x-2.5',
            ],

            'subnav-mobile' => [
                'outer' => 'flex items-center whitespace-nowrap flex-row-reverse p-2.5 pr-4.5 gap-2.5 text-base font-semibold rounded group hover:bg-white/30 link-no-underline',
                'icon-class' => 'ml-auto mr-0.6 transition-transform group-hover:translate-x-2.5',
            ],
        ];
    }

}
