<?php

namespace App\Concerns;

use App\Concerns\Colors\Colorways;
use App\Concerns\Colors\ButtonColors;
use App\Models\Term;

class Filters
{
    /**
     * @var string
     */
    private $post_type;

    public function __construct($post_type)
    {
        $this->post_type = $post_type;
    }

    /**
     * set filters based on the URL parameters if a
     * user lands on a pre-filtered page. The return value will be
     * passed to a Vue component to manage the pre-filters.
     *
     * get all the URL parameters and unset the `search`
     * parameter as only the terms / taxonomies are needed.
     *
     * @return array
     */
    public function getPreFilters()
    {
        if (empty($this->post_type)) {
            return [];
        }

        $taxonomies = $_REQUEST ?? [];

        if (empty($taxonomies)) {
            return [];
        }

        if (!empty($taxonomies['search'])) {
            unset($taxonomies['search']);
        }

        $prefilter = [];
        foreach ($taxonomies as $tax => $term) {
            $query_var = htmlspecialchars($term);

            if (empty($query_var)) {
                continue;
            }

            $term_data = get_term_by('slug', $query_var, $tax);

            if (empty($term_data)) {
                continue;
            }

            $prefilter[] = Term::serialize($term_data);
        }

        if (!empty($taxonomies['content-type'])) {
            $prefilter[] = Filters::postTypeFilter($taxonomies['content-type']);
        }

        return $prefilter;
    }

    /**
     * Constructs a 'Term' like object for including post types as filter options
     * @param string $type - the post type
     */
    public static function postTypeFilter($type): array
    {
        return [
            'label' => Filters::getPostTypeOptions()[$type] ?? '',
            'slug' => $type,
            'taxonomy' => 'content-type',
            'param' => 'post_type',
            'ID' => $type,
        ];
    }

    /**
     * The Post Grid with Filters post type options
     */
    public static function getPostTypeOptions()
    {
        return [
            'report' => __('Report', 'filters'),
            'news' => __('News', 'filters'),
            'post' => __('Blog', 'filters'),
            'case-study' => __('Case study', 'filters'),
            'program' => __('Program', 'filters'),
            'region' => __('Region', 'filters'),
        ];
    }

    /**
     * The Post Grid with Filters filter options
     */
    public static function getFilterOptions(): array
    {
        return [
            'acumen-year' => __('Years', 'filters'),
            'blog-type' => __('Blog Types', 'filters'),
            'case-study-type' => __('Case Study Types', 'filters'),
            'content-type' => __('Content Types', 'filters'),
            'media-format' => __('Media Formats', 'filters'),
            'news-type' => __('News Types', 'filters'),
            'problem-tax' => __('Impact Sectors', 'filters'),
            'program-type' => __('Program Types', 'filters'),
            'region-tax' => __('Regions', 'filters'),
            'report-type' => __('Report Types', 'filters'),
        ];
    }

    /**
     * set filter labels
     *
     * @return array
     */
    public function getLabels()
    {
        return [
            'empty' => $this->getEmptyMessage(),
            'loading' => __('Loading...', 'filters'),
            'read_more' => __('Read more →', 'filters'),
            'navigation' => [
                'previous' => __('Previous Slide', 'filters'),
                'next' => __('Next Slide', 'filters'),
            ],
            'pagination' => [
                'page' => __('Page x of y', 'filters'),
                'next' => __('Next', 'filters'),
                'prev' => __('Previous', 'filters'),
            ],
            'search' => [
                'placeholder' => $this->getSearchPlaceholder(),
                'label' => __('Search', 'filters'),
                'submit' => __('Submit', 'filters'),
            ],
            'drawer' => [
                'close' => __('Close drawer', 'filters'),
            ],
            'filters' => [
                'all_posts' => __('Show all', 'filters'),
                'all_label' => __('All', 'filters'),
                'clear' => __('Clear all', 'filters'),
                'dropdowns' => [
                    'open' => __('Open dropdown', 'filters'),
                    'close' => __('Close dropdown', 'filters'),
                ],
                'mobile_label' => __('Filter', 'filters'),
                'remove_filter' => __('Remove %term% filter', 'filters'),
                'filter_by' => __('Filter by', 'filters'),
                'filtered_by' => __('Filtered by', 'filters'),
            ]
        ];
    }

    /**
     * Get the appropriate empty message based on post type
     *
     * @return string
     */
    private function getEmptyMessage()
    {
        switch ($this->post_type) {
            case 'team':
                return __('There are no team members to display', 'filters');
                break;

            default:
                return __('There are no companies to display', 'filters');
                break;
        }
    }

    private function getSearchPlaceholder()
    {
        switch ($this->post_type) {
            case 'team':
                return __('Search by name...', 'filters');
                break;

            default:
                return __('Search keyword...', 'filters');
                break;
        }
    }

    public function getClasses()
    {
        $colors = new Colorways('stone');
        $btnColor = $colors->classes('button');
        $btnColorActive = $colors->classes('button_active');

        return [
            'button' => [
                'init' => (new ButtonColors($btnColor))->classes(),
                'icon' => (new ButtonColors('icon-black'))->classes(),
                'active' => (new ButtonColors($btnColorActive))->classes(),
            ],
            'filter' => [
                'button' => (new ButtonColors($btnColor))->classes(),
                'dropdown' => $colors->classes('wrapper'),
            ],
            'wrapper' => $colors->classes('wrapper'),
        ];
    }

    /**
     * get end points
     *
     * @return array
     */
    public function getEndpoints(array $preselected = [], array $exclude_terms = [])
    {
        return [
            'posts' => get_rest_url(null, 'sage-api/v2/' . $this->post_type),
            'terms' => $this->getTermEndpoint($preselected, $exclude_terms),
        ];
    }

    /**
     * get the term endpoint. if there are pre-selected posts,
     * adjust the endpoint so it only returns the terms from the
     * pre-selected posts
     *
     * @return array
     */
    private function getTermEndpoint(array $preselected, array $exclude_terms = [])
    {
        $params_arr = [];
        $params = '';

        if (!empty($preselected)) {
            $args = [
                'object_ids' => $preselected,
            ];

            $params_arr[] = 'args=' . json_encode($args);
        }

        if (!empty($exclude_terms)) {
            $params_arr[] = 'exclude=' . implode(',', $exclude_terms);
        }

        if (!empty($params_arr)) {
            $params = implode('&', $params_arr);
            $params = '?' . $params;
        }

        return get_rest_url(null, 'sage-api/v2/terms/' . $this->post_type . $params);
    }
}
