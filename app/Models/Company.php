<?php

namespace App\Models;

class Company extends Post
{
    public function toArray(): array
    {
        $parent = parent::toArray();
        $year = Term::getSingleByPostID($this->id, 'acumen-year');
        $status = Term::getSingleByPostID($this->id, 'company-status');

        if (!empty($year)) {
            $parent['topics'][] = $year;
        }

        if (!empty($status)) {
            $parent['topics'][] = $status;
        }

        return [
            ...$parent,
            'date' => '',
            'status' => $status,
            'title_button' => get_field('title_button', $this->id) ?: [],
            'year' => $year,
            'link' => [
                'url' => $parent['link'],
                'target' => '_self',
            ],
            'card_tax' => [
                $parent['primary_problem'],
                $parent['primary_region'],
            ],
        ];
    }
}
