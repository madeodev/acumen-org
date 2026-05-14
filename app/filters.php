<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Redirect News and Program pages to external url if relevant
 */
add_action('wp', function() {
    if(
        is_singular() &&
        in_array(get_post_type(), ['news', 'program', 'report']) 
    ) {
        $external_url = get_field('external_url', get_the_ID());
        if(empty($external_url)) return;
        wp_redirect($external_url);
    }
});