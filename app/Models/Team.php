<?php

namespace App\Models;

class Team extends Post
{
    public function toArray(): array
    {
        $parent = parent::toArray();
        $custom_link = get_field('custom_link', $this->id) ?? [];

        $type = Term::getSingleByPostID($this->id, 'team-type');
        $office = Term::getSingleByPostID($this->id, 'office');
        $function = Term::getSingleByPostID($this->id, 'team-function');

        return [
            ...$parent,
            'first_name' => get_field('first_name', $this->id) ?? '',
            'last_name' => get_field('last_name', $this->id) ?? '',
            'open_page' => get_field('open_page', $this->id) ?? false,
            'role' => get_field('title', $this->id) ?? '',
            'excerpt' => get_field('title', $this->id) ?? '',
            'linkedIn' => get_field('linkedIn', $this->id) ?? '',
            'type' => $type,
            'office' => $office,
            'function' => $function,
            'link' => !empty($custom_link) ? $custom_link['url'] : get_permalink($this->id),
            'topics' => [
                $office,
            ],
            'drawer_topics' => [
                $office,
                $type,
                $function,
            ],
        ];
    }

    /**
     * set the chip filter to team-type
     *
     * @return string
     */
    public static function getChipFilter()
    {
        return 'team-type';
    }
}
