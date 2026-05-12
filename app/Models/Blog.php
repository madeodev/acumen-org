<?php

namespace App\Models;

class Blog extends Post
{
    public function toArray(): array
    {
        $vanityAuthor = get_field('vanity_author', $this->id) ?? 'Acumen';
        $authors = $this->getAuthor($this->id, $vanityAuthor);

        return [
            ...parent::toArray(),
            'vanity_author' => get_field('vanity_author', $this->id) ?? 'Acumen',
            'title_button' => get_field('title_button', $this->id) ?: [],
            'type' => Term::getSingleByPostID($this->id, 'blog-type'),
            'media_format' => Term::getSingleByPostID($this->id, 'media-format'),
            'authors' => $authors,
            'featured_image_position' => get_field('featured_image_location', $this->id) ?? 'below',
            'featured_video' => get_field('show_video', $this->id) ? [
                'webm' => get_field('webm', $this->id),
                'mp4' => get_field('mp4', $this->id),
            ] : [],
        ];
    }
}
