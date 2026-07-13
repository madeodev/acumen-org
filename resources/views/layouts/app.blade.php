<!doctype html>
<html
  <?php language_attributes(); ?>
  class="bg-stone overflow-x-hidden min-w-[375px]"
>

<head>
  <meta charset="utf-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1"
  >
  <?php wp_head(); ?>
  <script>
    window.funraise = window.funraise || [];
    window._frProcessedTransactions = window._frProcessedTransactions || [];

    function pushFunraiseDonationToDataLayer(donor, donation) {
        if (!donation) return;

        var toNumber = function (v) {
            if (v == null || v === '') return NaN;
            return typeof v === 'number' ? v : parseFloat(String(v).replace(/[^0-9.-]+/g, ''));
        };

        var rawTx = donation.transactionId != null ? donation.transactionId : donation.id;
        var formId = donation.formId != null ? donation.formId : 'unknown_form';

        var dedupeKey;
        if (rawTx != null && String(rawTx) !== '') {
            dedupeKey = String(rawTx);
        } else {
            var email = donor && donor.email ? String(donor.email) : '';
            var bucket = Math.floor(Date.now() / 3000);
            dedupeKey = 'fr:' + formId + ':' + String(donation.amount) + ':' + String(donation.baseAmount) + ':' + email + ':' + bucket;
        }

        if (window._frProcessedTransactions.indexOf(dedupeKey) !== -1) {
            console.log('Duplicate prevented', dedupeKey);
            return;
        }
        window._frProcessedTransactions.push(dedupeKey);

        var numericValue = toNumber(donation.amount);
        var currencyCode = (donation.currency && donation.currency.name) ? donation.currency.name : 'USD';

        var transactionIdForTag = (rawTx != null && String(rawTx) !== '')
            ? String(rawTx)
            : ('funraise_test_' + formId + '_' + Date.now());

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'funraiseDonation',
            transaction_id: transactionIdForTag,
            value: isNaN(numericValue) ? 0 : numericValue,
            currency: currencyCode,
            form_id: formId,
            // HARDENED: Added strict GA4 ecommerce parameters to prevent production validation drops
            items: [{ 
                item_name: 'Donation',
                item_id: 'donation_' + formId,
                price: isNaN(numericValue) ? 0 : numericValue,
                quantity: 1
            }]
        });

        console.log('✅ dataLayer funraiseDonation successfully pushed:', { transaction_id: transactionIdForTag, value: numericValue });
    }

    // Register listeners for current in-scope forms
    [49641, 49591].forEach(function (formId) {
        window.funraise.push('onSuccess', { form: formId }, function (donor, donation) {
            console.log('🚨 Funraise onSuccess event fired live for form:', formId, donation);
            pushFunraiseDonationToDataLayer(donor, donation);
        });
    });
  </script>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <?php do_action('get_header'); ?>

  <div id="app">
    <a
      class="sr-only focus-visible:not-sr-only"
      href="#main"
    >
      {{ __('Skip to content') }}
    </a>

    @include('sections.header')
    <div
      id="overlay"
      aria-hidden="true"
      class="hidden bg-black/5 absolute inset-0 z-40"
    ></div>

    <main
      id="main"
      class="main"
    >
      <x-translation-bar />
      @yield('content')
    </main>

    <x-footer />

  </div>

  <?php do_action('get_footer'); ?>
  <?php wp_footer(); ?>
</body>

</html>
