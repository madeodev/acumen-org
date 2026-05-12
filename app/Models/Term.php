<?php

namespace App\Models;

use App\Concerns\GetsIcons;
use App\Models\Resource;
use App\Models\Taxonomy;

class Term extends Resource
{
    public function toArray(): array
    {
        $slug = $this->resource->slug;
        $taxonomy = $this->resource->taxonomy;

        return [
            'ID' => $this->resource->term_id,
            'label' => $this->resource->name,
            'description' => $this->resource->description,
            'slug' => $slug,
            'taxonomy' => $taxonomy,
            'icon' => GetsIcons::icon($taxonomy, $slug),
            'icon_path' => GetsIcons::icon($taxonomy, $slug, 'path'),
        ];
    }

    /**
     * Alphabetize an array of terms by label
     *
     * @param array $terms
     *
     * @return array
     */
    public static function alphabetizeTerms(array $terms)
    {
        if (empty($terms)) return [];
        if (!is_array($terms)) return [];
        return collect($terms)->sortBy('label')->values()->toArray();
    }

    public static function getByPostType($post_type, $exclude = [], $existing = [], $args = [])
    {
        $exclude = [
            ...$exclude,
            'category',
            'post_tag',
            'post_format',
            'translation_priority'
        ];

        if (is_array($post_type)) {
            $taxonomies = [];

            foreach ($post_type as $cpt) {
                $group = array_filter(
                    get_object_taxonomies($cpt, 'objects'),
                    function ($tax) use ($exclude) {
                        return !in_array($tax->name, $exclude);
                    }
                );

                $taxonomies = array_merge($taxonomies, $group);
            }
        } else {
            $taxonomies = array_filter(
                get_object_taxonomies($post_type, 'objects'),
                function ($tax) use ($exclude) {
                    return !in_array($tax->name, $exclude);
                }
            );
        }

        $result = [];

        foreach ($taxonomies as $tax) {

            $term_args = array_merge([
                'taxonomy' => $tax->name,
                'hide_empty' => false,
            ], $args);

            $terms = get_terms($term_args);

            $tax->terms = self::collection(array_values($terms));
            $result[] = Taxonomy::serialize($tax);
        }

        return collect($result)->sortBy('filter_order', SORT_NATURAL)->values()->all();
    }

    public static function getByPostId($id, $tax = ''): array
    {
        $taxonomies =  !empty($tax) ? array($tax) : get_post_taxonomies($id);

        $terms = collect($taxonomies)->flatMap(function ($tax_name) use ($id) {
            return get_the_terms($id, $tax_name);
        })->filter(function ($term) {
            return $term;
        })->toArray();

        return self::collection($terms);
    }

    public static function getSingleByPostID($id, $tax = ''): array
    {
        $collection = self::getByPostId($id, $tax);

        if (empty($collection[0])) {
            return [];
        }

        return $collection[0];
    }
}
