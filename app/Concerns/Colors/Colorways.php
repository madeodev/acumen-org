<?php

namespace App\Concerns\Colors;

use App\Concerns\Colors;

class Colorways extends Colors
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
  static function colors(): array
  {
    return [
      ...ColorwaysLight::colors(),
      ...ColorwaysDark::colors(),
    ];
  }

}
