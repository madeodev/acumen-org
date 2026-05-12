<?php

namespace App\Concerns\Colors;

use App\Concerns\Colors;

class ColorwaysDark extends Colors
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
        return [
          'white' => [
            'wrapper' => 'bg-white text-black',
            'hover' => 'hover:bg-white hover:text-black focus-visible:bg-white focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'stone' => [
            'wrapper' => 'bg-stone text-black',
            'hover' => 'hover:bg-stone hover:text-black focus-visible:bg-stone focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'orange' => [
            'wrapper' => 'bg-orange text-black',
            'hover' => 'hover:bg-orange hover:text-black focus-visible:bg-orange focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'spice' => [
            'wrapper' => 'bg-spice text-black',
            'hover' => 'hover:bg-spice hover:text-black focus-visible:bg-spice focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'gold' => [
            'wrapper' => 'bg-gold text-black',
            'hover' => 'hover:bg-gold hover:text-black focus-visible:bg-gold focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'lime' => [
            'wrapper' => 'bg-lime text-black',
            'hover' => 'hover:bg-lime hover:text-black focus-visible:bg-lime focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'mizuna' => [
            'wrapper' => 'bg-mizuna text-black',
            'hover' => 'hover:bg-mizuna hover:text-black focus-visible:bg-mizuna focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'turquoise' => [
            'wrapper' => 'bg-turquoise text-black',
            'hover' => 'hover:bg-turquoise hover:text-black focus-visible:bg-turquoise focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'provence-text-black' => [
            'wrapper' => 'bg-provence text-black',
            'hover' => 'hover:bg-provence hover:text-black focus-visible:bg-provence focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'azalea' => [
            'wrapper' => 'bg-azalea text-black',
            'hover' => 'hover:bg-azalea hover:text-black focus-visible:bg-azalea focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'ember' => [
            'wrapper' => 'bg-ember text-black',
            'hover' => 'hover:bg-ember hover:text-black focus-visible:bg-ember focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
          'daisy' => [
            'wrapper' => 'bg-daisy text-black',
            'hover' => 'hover:bg-daisy hover:text-black focus-visible:bg-daisy focus-visible:text-black',
            'button' => 'outline-black',
            'button_active' => 'outline-black-active',
          ],
        ];
    }

}
