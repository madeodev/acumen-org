<?php

namespace App\Models;

use App\Concerns\Colors\ColorwaysDark;
use App\Concerns\Colors\ColorwaysLight;

class Problem extends Post
{
    public function toArray(): array
    {
        $color = get_field('color', $this->id) ?? '';
        $parent = parent::toArray();
        $regions = Term::alphabetizeTerms($parent['regions']);
        return [
            ...$parent,
            'regions' => $regions,
            'topics' => $regions,
            'custom_link' => get_field('custom_link', $this->id),
            'stats' => get_field('stats', $this->id),
            'color' => $color,
            'bg_class' => (new ColorwaysLight($color))->classes('wrapper'),
            'program_hover' => (new ColorwaysDark(get_field('secondary_color', $this->id) ?? ''))->classes('hover'),
            'countries' => $this->getCountries($parent),
            'post_type' => 'problem',
        ];
    }

    public function getCountries($parent){
        $choice = get_field('country_display', $this->id);

        switch ($choice) {
            case 'manual':
                return get_field('countries', $this->id);
                break;

            case 'region':
                return $this->countriesFromRegions($parent);
                break;

            case 'add_to_region':
                return array_merge(
                    $this->countriesFromRegions($parent),
                    get_field('countries', $this->id)
                );
                break;

            default:
                return [];
                break;
        }
    }

    public function countriesFromRegions($parent) : Array {
        if(empty($parent['regions'])) return [];

        $countries = [];
        foreach($parent['regions'] as $region){

            $region_cpt = get_field('linked_region_cpt', 'term_'.$region['ID']);
            if(empty($region_cpt)) continue;

            $region_countries = get_field('countries', $region_cpt);
            if(!is_array($region_countries)) continue;

            $countries = array_merge($countries, $region_countries);
        }
        return $countries;
    }
}
