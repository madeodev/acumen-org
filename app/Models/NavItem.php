<?php

namespace App\Models;

use App\Models\Resource;

class NavItem extends Resource
{
    /**
    * @var int
    */
    protected $id;

    public function __construct($post)
    {
        parent::__construct($post);
        $this->id = $post->ID;
    }

    public function toArray(): array
    {
        $fields = get_fields($this->id) ?: [];
        $featuredPosts = $this->serializeFeaturedPosts($fields['featured_posts'] ?? []);
        unset($fields['featured_posts']);

        return [
          'ID' => $this->id,
          'object_id' => (int) $this->resource->object_id,
          'title' => $this->resource->title,
          'url' => $this->resource->url,
          'target' => $this->resource->target,
          'description' => $this->resource->description,
          'children' => $this->resource->children,
          ...$fields,
          'featured_posts' => $featuredPosts,
        ];
    }

    /**
     * Serialize featured Knowledge Hub posts when exactly 3 are selected.
     *
     * @param mixed $posts
     * @return array
     */
    private function serializeFeaturedPosts($posts): array
    {
        if (!is_array($posts) || count($posts) !== 3) {
            return [];
        }

        $serialized = collect($posts)
            ->map(function ($post) {
                if (!$post instanceof \WP_Post) {
                    $post = get_post($post);
                }

                if (empty($post) || $post->post_status !== 'publish') {
                    return null;
                }

                switch ($post->post_type) {
                    case 'news':
                        return News::serialize($post);

                    case 'report':
                        return Report::serialize($post);

                    case 'case-study':
                        return CaseStudy::serialize($post);

                    default:
                        return Blog::serialize($post);
                }
            })
            ->filter()
            ->values()
            ->toArray();

        return count($serialized) === 3 ? $serialized : [];
    }
}
