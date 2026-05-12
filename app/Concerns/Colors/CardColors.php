<?php

namespace App\Concerns\Colors;

use App\Concerns\Colors;

class CardColors extends Colors
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
    $image_default = 'w-full h-full object-cover group-hover/card:scale-105 transition-transform duration-500';
    $image_wrapper_default = 'rounded-card rounded-bl-none';
    $wrapper_default = 'group/card';
    $title_default = 'transition-all duration-500 font-normal';
    $icon_default = 'rounded-full border border-white text-white absolute bottom-7.5 left-7.5 flex items-center justify-center p-2';

    return [
      '4-up' => [
        'wrapper' => $wrapper_default . ' flex flex-col gap-5',
        'image' => $image_default . ' aspect-[1.165]',
        'image-wrapper' => $image_wrapper_default,
        'sizes' => ['md' => '1/2', 'xl' => '1/3'],
        'text-area' => 'flex flex-col gap-5 items-start',
        'title' => $title_default . ' h3',
        'excerpt' => 'm-0',
        'button' => 'link',
        'button_icon' => 'arrow-right',
        'icon' => $icon_default,
      ],
      '3-up' => [
        'wrapper' => $wrapper_default . ' flex flex-col gap-7.5',
        'image' => $image_default . ' aspect-[1.165]',
        'image-wrapper' => $image_wrapper_default,
        'sizes' => ['md' => '1/2', 'xl' => '1/3'],
        'text-area' => 'flex flex-col gap-7.5 items-start',
        'title' => $title_default . ' h3',
        'excerpt' => 'm-0',
        'button' => 'link',
        'button_icon' => 'arrow-right',
        'icon' => $icon_default,
      ],
      '2-up' => [
        'wrapper' => $wrapper_default . ' flex flex-col gap-7.5',
        'image-wrapper' => $image_wrapper_default,
        'image' => 'aspect-[1.8625] ' . $image_default,
        'sizes' => ['md' => '1/2'],
        'title' => $title_default,
      ],
      '1-up' => [
        'wrapper' => $wrapper_default . ' flex flex-col lg:flex-row gap-7.5',
        'image-wrapper' => $image_wrapper_default . ' flex-1',
        'image' => 'aspect-[1.55] ' . $image_default,
        'sizes' => ['lg' => 'min(976px, calc(100% - 370px))'],
        'text-area' => 'flex flex-col gap-7.5 items-start lg:basis-92.5 lg:flex-shrink-0',
        'title' => $title_default,
        'icon' => $icon_default,
      ],
      'large' => [
        'wrapper' => $wrapper_default . ' flex flex-col gap-7.5',
        'image-wrapper' => $image_wrapper_default . ' overflow-hidden aspect-[55/32]',
        'sizes' => [
          'lg' => '3/4'
        ],
        'image' => $image_default,
        'title' => $title_default . ' h3',
        'icon' => $icon_default,
      ],
      'list' => [
        'image' => $image_default . ' aspect-[19/16] w-1/3',
        'image-wrapper' => $image_wrapper_default . ' aspect-[19/16] w-1/3 min-w-[125px] shrink-0',
        'wrapper' => $wrapper_default . ' inline-flex flex-row-reverse gap-7.5 w-full group/card border-t mt-7.5 pt-7.5 first:my-0 first:py-0 first:border-t-0 last:pb-0 last:mb-0 items-center',
        'text-area' => 'w-2/3 inline-flex w-full gap-7.5 flex-col',
        'title' => $title_default . ' body',
        'icon' => $icon_default,
        'button' => 'link',
      ]
    ];
  }
}
