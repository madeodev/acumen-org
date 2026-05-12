<?php

namespace App\Models;

class Foundry extends Post
{
    public function toArray(): array
    {
        $parent = parent::toArray();
        $link = get_field('link', $this->id);
        $year = Term::getSingleByPostID($this->id, 'acumen-year');

        return [
            ...$parent,
            'first_name' => get_field('first_name', $this->id) ?? '',
            'last_name' => get_field('last_name', $this->id) ?? '',
            'job_title' => get_field('title', $this->id) ?: '',
            'angel' => get_field('angel', $this->id) ?? '',
            'fellowship' => Term::getSingleByPostID($this->id, 'fellowship'),
            'year' => $year,
            'link' => [
                'url' => $link ?: $parent['link'],
                'target' => !empty($link) ? '_blank' : '_self',
            ],
            'card_tax' => [
                Term::getSingleByPostID($this->id, 'fellowship'),
                $year,
            ]
        ];
    }
}
