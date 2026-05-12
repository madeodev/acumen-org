<?php

namespace App\Concerns\Colors;

use App\Concerns\Colors;

class ModuleBgColors extends Colors
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
        $selected_dark_colors = [
          'spice',
        ];

        $dark_colors = collect(ColorwaysDark::colors())->filter(function ($value, $color) use ($selected_dark_colors) {
            return in_array($color, $selected_dark_colors);
        })->toArray();

        return [
          ...ColorwaysLight::colors(),
          ...$dark_colors,
        ];
    }
}
