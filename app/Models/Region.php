<?php

namespace App\Models;

use App\Concerns\Colors\ColorwaysDark;
use App\Concerns\Colors\ColorwaysLight;

class Region extends Post
{
    public function toArray(): array
    {
        $color = get_field('color', $this->id) ?? '';
        $parent = parent::toArray();
        $problems = Term::alphabetizeTerms($parent['problems']);

        return [
            ...$parent,
            'problems' => $problems,
            'topics' => $problems,
            'custom_link' => get_field('custom_link', $this->id),
            'stats' => get_field('stats', $this->id),
            'color' => $color,
            'bg_class' => (new ColorwaysLight($color))->classes('wrapper'),
            'program_hover' => (new ColorwaysDark(get_field('secondary_color', $this->id) ?? ''))->classes('hover'),
            'countries' => get_field('countries', $this->id),
        ];
    }
}
