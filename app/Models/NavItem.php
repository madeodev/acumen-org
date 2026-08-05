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
     * Build the featured Knowledge Hub posts.
     *
     * The CMS selection is the main feature. The remaining two items are the
     * latest published Knowledge Hub posts, excluding the selected post.
     *
     * @param mixed $posts
     * @return array
     */
    private function serializeFeaturedPosts($posts): array
    {
        if (!is_array($posts) || empty($posts)) {
            return [];
        }

        $featured = $posts[0];

        if (!$featured instanceof \WP_Post) {
            $featured = get_post($featured);
        }

        $allowedPostTypes = ['news', 'post', 'report', 'case-study'];

        if (
            empty($featured) ||
            $featured->post_status !== 'publish' ||
            !in_array($featured->post_type, $allowedPostTypes, true)
        ) {
            return [];
        }

        $latestPosts = get_posts([
            'post_type' => $allowedPostTypes,
            'post_status' => 'publish',
            'posts_per_page' => 2,
            'post__not_in' => [$featured->ID],
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true,
            'suppress_filters' => false,
        ]);

        if (count($latestPosts) !== 2) {
            return [];
        }

        return collect([$featured, ...$latestPosts])
            ->map(function ($post) {
                return $this->serializeKnowledgeHubPost($post);
            })
            ->filter()
            ->values()
            ->toArray();
    }

    /**
     * Serialize a Knowledge Hub post with its post-type model.
     *
     * @param \WP_Post $post
     * @return array|null
     */
    private function serializeKnowledgeHubPost(\WP_Post $post): ?array
    {
        switch ($post->post_type) {
            case 'news':
                return News::serialize($post);

            case 'report':
                return Report::serialize($post);

            case 'case-study':
                return CaseStudy::serialize($post);

            case 'post':
                return Blog::serialize($post);

            default:
                return null;
        }
    }
}
