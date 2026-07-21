@php
  $featured = $item['featured_posts'] ?? [];
  $main = $featured[0] ?? [];
  $secondary = array_slice($featured, 1, 2);
@endphp

<div
  class="absolute inset-x-0 text-white bg-amethyst top-full shadow-nav"
  x-collapse
  x-cloak
  x-show="isOpen('{{ $loop->iteration }}')"
  @focusout="handleFocusOut('button{{ $loop->iteration }}')"
  @click.outside="clickOutside({{ $loop->iteration }})"
>
  <div class="container-fluid flex flex-col gap-7.5 py-15">

    <p class="text-xl leading-extra-tight font-bold mb-0">{!! __('Featured', 'sage') !!}</p>

    <div class="grid grid-cols-4 gap-[20px]">

      {{-- Cols 1–2: Large featured article card --}}
      @if (!empty($main))
        <a
          href="{!! $main['link'] ?? '#' !!}"
          @if (!empty($main['target'])) target="{!! $main['target'] !!}" @endif
          class="col-span-2 flex group link-no-underline"
        >
          <div class="relative w-1/2 shrink-0 rounded-tl-10 overflow-hidden aspect-[305/328]">
            @if (!empty($main['featured_image_html']['card']))
              <div class="absolute inset-0 w-full h-full [&>img]:absolute [&>img]:inset-0 [&>img]:w-full [&>img]:h-full [&>img]:object-cover">
                {!! $main['featured_image_html']['card'] !!}
              </div>
            @endif
          </div>
          <div class="relative w-1/2 bg-plum rounded-tr-10 rounded-br-10 overflow-hidden">
            <div class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
            <div class="relative z-5 flex flex-col gap-5 p-7.5">
              @if (!empty($main['title']))
                <p class="text-base font-semibold leading-extra-tight mb-0">{!! $main['title'] !!}</p>
              @endif
              @if (!empty($main['excerpt']) || !empty($main['auto_excerpt']))
                <p class="text-base leading-extra-tight mb-0">{!! $main['excerpt'] ?: ($main['auto_excerpt'] ?? '') !!}</p>
              @endif
              @svg('images.arrow-right', 'w-3.5 h-auto transition-transform duration-300 group-hover:translate-x-2.5')
            </div>
          </div>
        </a>
      @endif

      {{-- Col 3: Two stacked article teasers --}}
      <div class="flex flex-col gap-5">
        @foreach ($secondary as $teaser)
          <a
            href="{!! $teaser['link'] ?? '#' !!}"
            @if (!empty($teaser['target'])) target="{!! $teaser['target'] !!}" @endif
            class="flex flex-col bg-plum rounded-tl-10 rounded-tr-10 rounded-br-10 relative overflow-hidden flex-1 group link-no-underline"
          >
            <div class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
            <div class="relative z-5 flex flex-col gap-5 p-7.5">
              @if (!empty($teaser['title']))
                <p class="text-base font-semibold leading-extra-tight mb-0">{!! $teaser['title'] !!}</p>
              @endif
              @svg('images.arrow-right', 'w-3.5 h-auto transition-transform duration-300 group-hover:translate-x-2.5')
            </div>
          </a>
        @endforeach
      </div>

      {{-- Col 4: Navigation links with left border --}}
      <ul class="pl-5 border-l border-white">
        @foreach ($item['children'] as $child)
          <li>
            <x-button
              :link="$child"
              color="subnav"
              icon="arrow-right"
              class="w-full hover:bg-white/30 transition-colors duration-0"
            />
          </li>
        @endforeach
      </ul>

    </div>
  </div>
</div>
