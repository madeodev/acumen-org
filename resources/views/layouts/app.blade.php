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
    window._frProcessedFailures = window._frProcessedFailures || [];
    window._frLoadedForms = window._frLoadedForms || [];

    function funraiseToNumber(v) {
        if (v == null || v === '') return NaN;
        return typeof v === 'number' ? v : parseFloat(String(v).replace(/[^0-9.-]+/g, ''));
    }

    function funraiseNumericOrZero(v) {
        var n = funraiseToNumber(v);
        return isNaN(n) ? 0 : n;
    }

    function funraiseCurrency(donation) {
        return (donation && donation.currency && donation.currency.name) ? donation.currency.name : 'USD';
    }

    function funraiseText(v) {
        return v == null ? '' : String(v);
    }

    function pushFunraiseEvent(payload) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push(payload);
    }

        
    function pushFunraiseDonationToDataLayer(donor, donation) {
        if (!donation) return;

        var transactionId = donation.transactionId != null
            ? String(donation.transactionId).trim()
            : '';

        var numericValue = funraiseToNumber(donation.amount);

        var currencyCode = donation.currency && donation.currency.name
            ? String(donation.currency.name).trim().toUpperCase()
            : '';

        // Do not create GA4 purchases with invalid tracking data.
        if (
            !transactionId ||
            !Number.isFinite(numericValue) ||
            numericValue <= 0 ||
            !/^[A-Z]{3}$/.test(currencyCode)
        ) {
            console.warn(
                '[Funraise] Purchase tracking skipped: invalid transaction data'
            );
            return;
        }

        // Deduplicate using the real Funraise transaction ID.
        var dedupeKey = 'funraise:' + transactionId;

        window._frProcessedTransactions =
            window._frProcessedTransactions || [];

        if (window._frProcessedTransactions.indexOf(dedupeKey) !== -1) {
            return;
        }

        window._frProcessedTransactions.push(dedupeKey);

        var formId = donation.formId != null
            ? donation.formId
            : 'unknown_form';

        var formName = donation.formName
            ? String(donation.formName)
            : 'Donation';

        var frequency = funraiseText(donation.frequency);

        var item = {
            item_id: 'donation_' + formId,
            item_name: formName,
            price: numericValue,
            quantity: 1
        };

        if (frequency) {
            item.item_category = frequency;
        }

        pushFunraiseEvent({
            event: 'funraiseDonation',
            transaction_id: transactionId,
            value: numericValue,
            currency: currencyCode,
            form_id: formId,
            form_name: formName,
            frequency: frequency,
            recurring: donation.recurring === true,
            payment_type: funraiseText(donation.paymentType),
            tip_amount: funraiseNumericOrZero(donation.tipAmount),
            base_amount: funraiseNumericOrZero(donation.baseAmount),
            items: [item]
        });
    }

    function pushFunraiseFailureToDataLayer(formId, donation) {
        var payload = {
            event: 'funraiseDonationFailed',
            form_id: (donation && donation.formId != null) ? donation.formId : formId
        };

        if (donation) {
            payload.value = funraiseNumericOrZero(donation.amount);
            payload.currency = funraiseCurrency(donation);
            if (donation.frequency != null && String(donation.frequency) !== '') {
                payload.frequency = String(donation.frequency);
            }

            var rawTx = donation.transactionId != null ? donation.transactionId : donation.id;
            if (rawTx != null && String(rawTx) !== '') {
                var dedupeKey = 'fail:' + String(rawTx);
                window._frProcessedFailures = window._frProcessedFailures || [];
                if (window._frProcessedFailures.indexOf(dedupeKey) !== -1) {
                    return;
                }
                window._frProcessedFailures.push(dedupeKey);
            }
        }

        pushFunraiseEvent(payload);
    }

    // Register before create — repeat per form (e.g. 49641, 49591)
    [49641, 49591].forEach(function (formId) {
        window.funraise.push('onSetup', { form: formId }, function () {
            window._frLoadedForms = window._frLoadedForms || [];
            if (window._frLoadedForms.indexOf(formId) !== -1) {
                return;
            }
            window._frLoadedForms.push(formId);
            pushFunraiseEvent({
                event: 'funraiseFormLoaded',
                form_id: formId
            });
        });

        window.funraise.push('onInfo', { form: formId }, function () {
            pushFunraiseEvent({
                event: 'funraiseFormInfo',
                form_id: formId
            });
        });

        window.funraise.push('onFailure', { form: formId }, function (_donor, donation) {
            pushFunraiseFailureToDataLayer(formId, donation);
        });

        window.funraise.push('onSuccess', { form: formId }, function (donor, donation) {
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
