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
 * Funraise donation tracking — push to GTM dataLayer on successful donation.
 * Deduplicates by transactionId to prevent double-firing.
 */
add_action('wp_footer', function () {
    ?>
    <script>
    window.funraise = window.funraise || [];
    console.log('funraise', window.funraise);
    window.funraise.push('onSuccess', function(donor, donation) {
        window._frProcessedTransactions = window._frProcessedTransactions || [];

        var transactionId = donation ? donation.transactionId : null;

        if (!transactionId || window._frProcessedTransactions.indexOf(transactionId) !== -1) {
            return;
        }

        window._frProcessedTransactions.push(transactionId);

        var rawAmount = donation ? donation.amount : 0;
        var numericValue = typeof rawAmount === 'number'
            ? rawAmount
            : parseFloat(String(rawAmount).replace(/[^0-9.-]+/g, ''));

        var currencyCode = (donation && donation.currency && donation.currency.name)
            ? donation.currency.name
            : 'USD';

        var submittedFormId = donation ? donation.formId : 'unknown_form';

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'funraiseDonation',
            transaction_id: transactionId,
            value: isNaN(numericValue) ? 0 : numericValue,
            currency: currencyCode,
            form_id: submittedFormId,
            items: [{
                item_name: 'Donation',
                quantity: 1
            }]
        });
    });
    </script>
    <?php
});

/**
 * Redirect News and Program pages to external url if relevant
 */
add_action('wp', function() {
    if(
        is_singular() &&
        in_array(get_post_type(), ['news', 'program']) 
    ) {
        $external_url = get_field('external_url', get_the_ID());
        if(empty($external_url)) return;
        wp_redirect($external_url);
    }
});