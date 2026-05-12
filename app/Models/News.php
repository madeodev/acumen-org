<?php

namespace App\Models;

class News extends Post
{
    public function toArray(): array
    {
        $authors = $this->getAuthor($this->id);
        $parent = parent::toArray();

        return [
            ...$parent,
            'title_button' => get_field('title_button', $this->id) ?: [],
            'type' => Term::getSingleByPostID($this->id, 'news-type'),
            'link' => get_field('external_url', $this->id) ?: $parent['link'],
            'target' => get_field('external_url', $this->id) ? '_blank' : '_self',
            'media_format' => Term::getSingleByPostID($this->id, 'media-format'),
            'authors' => $authors,
            'featured_image_position' => get_field('featured_image_location', $this->id) ?? 'side',
            'featured_video' => get_field('show_video', $this->id) ? [
                'webm' => get_field('webm', $this->id),
                'mp4' => get_field('mp4', $this->id),
            ] : [],
        ];
    }
}
