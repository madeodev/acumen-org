<?php

namespace App\Models;

class Program extends Post
{
    public function toArray(): array
    {
        $parent = parent::toArray();
        $external_url = get_field('external_url', $this->id) ?? '';
        return [
            ...$parent,
            'type' => Term::getSingleByPostID($this->id, 'program-type'),
            'link' =>  $external_url ?: $parent['link'],
            'target' => empty($external_url) ? '_self' : '_blank',
            'secondary_logo' => get_field('secondary_logo', $this->id) ?? '',
            'topics' => [
                $parent['post_type_object'],
                $parent['primary_problem'],
                ...Term::alphabetizeTerms($parent['regions']),
            ]
        ];
    }
}
