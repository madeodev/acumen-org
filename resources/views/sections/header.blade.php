<header
  class="relative z-50 bg-stone"
  x-data="nav"
  @mouseover.away="handleEscape"
>
  <div
    x-data="logoAnimation"
    @if (is_front_page()) @scroll.window.once="animate" @click.once="animate" @resize.window="onResize" @endif
  >
    <div>
      <div class="container-fluid flex py-2 xl:py-7.5 gap-15">

        <a
          class="link-no-underline"
          href="{{ home_url('/') }}"
          aria-label="{!! $siteName !!}"
        >
          @if (is_front_page())
            @svg('images.logomark', 'h-auto w-12.5 xl:w-25', ['x-ref' => 'logomark'])
            @svg('images.logo', 'hidden h-auto w-12.5 xl:w-25', ['x-ref' => 'logo'])
            <span
              class="block h-2.5 xl:h-3.5 duration-1000 transition-height"
              x-ref="wordmarkSpacer"
              aria-hidden="true"
            ></span>
          @else
            @svg('images.logo', 'h-auto w-12.5 xl:w-25')
          @endif
        </a>

        @include('partials.nav-desktop')

      </div>
      <div id="nav-desktop-container"></div>
    </div>

    @if (is_front_page())
      <div
        class="text-center container-fluid"
        x-ref="logoDiv"
      >
        @svg('images.logo-text', 'h-auto max-w-full inline-block transition-all duration-1000 origin-top-left my-[10%]', ['x-ref' => 'logoText'])
      </div>
    @endif
  </div>
  @include('partials.nav-mobile')

</header>
