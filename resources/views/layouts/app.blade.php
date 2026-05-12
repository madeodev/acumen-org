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
