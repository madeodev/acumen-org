<?php

namespace App\Concerns;

class Image
{

    /**
     * getScrsetSizes
     *
     * A helper function to make it easier to define srcset sizes
     *
     */
    public static function getScrsetSizes(string|array $sizes, bool $fluid = false)
    {

        if(is_string($sizes)) {
            return $sizes;
        }

        // This should match your Tailwind config screens array + 'DEFAULT' as the first entry
        $screens = [
            'DEFAULT' => '',
            'sm' => '640px',
            'md' => '768px',
            'lg' => '1024px',
            'xl' => '1280px',
            '2xl' => '1536px',
        ];
        // This should match your tailwind container padding
        // 'DEFAULT' is required
        $paddingArr = [
            'DEFAULT' => '1.25rem',
            'lg' => '3.75rem',
        ];

        return collect($screens)->map(function ($screen, $key) use ($paddingArr, $sizes) {
            static $value = 'container';
            static $padding;
            $value = $sizes[$key] ?? $value;
            $padding = $paddingArr[$key] ?? $padding;
            if($key === 'DEFAULT' && $value === 'container') {
                return "calc(100vw - ($padding * 2))";
            }
            if($key === 'DEFAULT') {
                return $value;
            }
            if($value === 'container') {
                return "(min-width: $screen) calc((100vw - ($padding * 2))";
            }
            if (str_contains($value, '/')) {
                return "(min-width: $screen) calc((100vw - ($padding * 2)) * $value)";
            }
            return "(min-width: $screen) $value";
        })
        ->reverse()
        ->implode(',
      ');
    }
}
