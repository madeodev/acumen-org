<?php

namespace App\Models;

class CaseStudy extends Post
{
    public function toArray(): array
    {
        $parent = parent::toArray();
        $year = Term::getSingleByPostID($this->id, 'acumen-year');

        if (!empty($year)) {
            $parent['topics'][] = $year;
        }

        return [
            ...$parent,
            'media_format' => Term::getSingleByPostID($this->id, 'media-format'),
            'type' => Term::getSingleByPostID($this->id, 'case-study-type'),
            'year' => $year,
            'stats' => get_field('stats', $this->id),
            'featured_image_position' => get_field('featured_image_location', $this->id) ?? 'side',
            'featured_video' => get_field('show_video', $this->id) ? [
                'webm' => get_field('webm', $this->id),
                'mp4' => get_field('mp4', $this->id),
            ] : [],
        ];
    }
}
