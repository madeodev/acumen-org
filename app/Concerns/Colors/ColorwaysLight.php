<?php

namespace App\Concerns\Colors;

use App\Concerns\Colors;

class ColorwaysLight extends Colors
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
          'black' => [
            'wrapper' => 'bg-black text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'racecar' => [
            'wrapper' => 'bg-racecar text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'cactus' => [
            'wrapper' => 'bg-cactus text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'woad' => [
            'wrapper' => 'bg-woad text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'verdigris' => [
            'wrapper' => 'bg-verdigris text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'sapphire' => [
            'wrapper' => 'bg-sapphire text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'lapis' => [
            'wrapper' => 'bg-lapis text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'provence' => [
            'wrapper' => 'bg-provence text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'amethyst' => [
            'wrapper' => 'bg-amethyst text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'tulip' => [
            'wrapper' => 'bg-tulip text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'cinnabar' => [
            'wrapper' => 'bg-cinnabar text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'nutmeg-light' => [
            'wrapper' => 'bg-nutmeg-light text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'ocean' => [
            'wrapper' => 'bg-ocean text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
          'plum' => [
            'wrapper' => 'bg-plum text-white',
            'button' => 'outline-white',
            'button_active' => 'outline-white-active',
          ],
        ];
    }

}
