<?php

namespace App\Models;

use App\Concerns\GetsIcons;
use App\Models\Resource;
use App\Models\Author;
use App\Concerns\Colors\CardColors;
use App\Concerns\Image as ImageConcern;
use Illuminate\Support\Str;

class Post extends Resource
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
        $post_type_pretty = $this->postTypePrettyName($this->resource->post_type);
        $problems = Term::getByPostId($this->id, 'problem-tax');
        $regions = Term::getByPostId($this->id, 'region-tax');
        $datetime = strtotime($this->resource->post_date);
        $icon = GetsIcons::icon($this->resource->post_type);
        $icon_path = GetsIcons::icon($this->resource->post_type, null, 'path');

        return [
            'ID' => $this->id,
            'title' => $this->resource->post_title,
            'slug' => $this->resource->post_name,
            'content' => $this->resource->post_content,
            'excerpt' => $this->resource->post_excerpt,
            'auto_excerpt' => $this->resource->post_excerpt ? wp_trim_words($this->resource->post_excerpt, 30, '...')
                : wp_trim_words($this->resource->post_content, 30, '...'),
            'link' => get_permalink($this->id),
            'featured_image' => get_post_thumbnail_id($this->id),
            'featured_caption' => get_the_post_thumbnail_caption($this->id),
            'icon' => $icon,
            'icon_path' => $icon_path,
            'datetime' => wp_date(DATE_W3C, $datetime),
            'date' => wp_date('M j, Y', $datetime),
            'featured_image_html' => [
                'card' => get_the_post_thumbnail($this->id, 'large', [
                    'class' => 'object-cover w-full h-full',
                    'sizes' => ImageConcern::getScrsetSizes([
                        'DEFAULT' => 'container',
                        'md' => '1/2',
                        'lg' => '1/3',
                        'xl' => '1/4',
                    ])
                ]),
                'drawer' => get_the_post_thumbnail($this->id, 'large', [
                    'class' => 'object-cover w-full h-full',
                    'sizes' => ImageConcern::getScrsetSizes([
                        'DEFAULT' => 'container',
                        'md' => '1/2',
                    ])
                ]),
            ],
            'button' => [
                'title' => __('Read more', 'post'),
                'url' => get_permalink($this->id),
                'target' => '_self',
            ],
            'post_type' => $this->resource->post_type,
            'post_type_pretty' => $post_type_pretty,
            'post_type_object' => [
                'icon' => $icon,
                'icon_path' => $icon_path,
                'slug' => $this->resource->post_type,
                'label' => $post_type_pretty,
                'taxonomy' => __('Content type', 'labels')
            ],
            'problems' => $problems,
            'primary_problem' => $problems[0] ?? [],
            'regions' => $regions,
            'primary_region' => $regions[0] ?? [],
            'topics' => $this->topics($post_type_pretty, $icon, $icon_path, $problems, $regions),
            'labels' => [
                'readmore' => __('Read more', 'filters'),
                'multiRegion' => [
                    'label' => __('Cross region', 'filters'),
                    'tax' => 'region',
                    'icon_path' => GetsIcons::icon('region-tax', null, 'path'),
                ],
                'multiProblem' => [
                    'label' => __('Cross sector', 'filters'),
                    'tax' => 'problem',
                    'icon_path' => GetsIcons::icon('problem-tax', null, 'path'),
                ],
            ],
            'card_classes' => CardColors::colors()
        ];
    }

    protected function getAuthor(int $id, string $vanityAuthor = '') {
        $author = get_field('author', $id) ?? [];

        if (empty($author)) {
            return [
                'array' => [],
                'list' => $vanityAuthor,
            ];
        }

        $authors = Author::collection($author);

        $list = collect($authors)->pluck('label')->when(count($authors) > 1, function ($list) {
            $last = $list->pop();
            return sprintf('%s and %s', $list->join(', '), $last);
        }, function($list) {
            return $list->first() ?? '';
        });

        return [
            'array' => $authors,
            'list' => $list,
            'title' => Str::plural(__('Author Profile', 'author_card'), count($authors)),
        ];
    }

    /**
     * Converts a post type slug to a human-readable format
     *
     * @param string $post_type The post type slug to convert
     * @return string The formatted post type name
     */
    public function postTypePrettyName($post_type)
    {
        return $post_type === 'post' ? __('Blog', 'sage') : ucwords(str_replace('-', ' ', $post_type));
    }

    /**
     * set the chip filter based on the taxonomy
     *
     * @return string
     */
    public static function getChipFilter()
    {
        return '';
    }

    /**
     * Builds an array of topic items for the post
     *
     * Creates a list of topics including post type and taxonomy information.
     * Handles special cases for multiple problems and regions.
     *
     * @param string $post_type The formatted post type name
     * @param string $icon The icon identifier
     * @param string $icon_path The path to the icon
     * @param array $problems Array of problem taxonomy items
     * @param array $regions Array of region taxonomy items
     * @return array List of topic items with labels and icons
     */
    public function topics($post_type, $icon, $icon_path, $problems, $regions): array
    {
        $list = [
            [
                'label' => $post_type,
                'icon' => $icon,
                'icon_path' => $icon_path,
            ]
        ];

        // Handle multiple problems
        if (!empty($problems)) {
            $list[] = count($problems) > 1 ? [
                'label' => __('Cross sector', 'filters'),
                'tax' => 'problem',
                'icon_path' => GetsIcons::icon('problem-tax', null, 'path'),
            ] : $problems[0];
        }

        // Handle multiple regions
        if (!empty($regions)) {
            $list[] = count($regions) > 1 ? [
                'label' => __('Cross region', 'filters'),
                'tax' => 'region',
                'icon_path' => GetsIcons::icon('region-tax', null, 'path'),
            ] : $regions[0];
        }

        return $list;
    }
}
