@php
  $main = ($item['featured_posts'] ?? [])[0] ?? [];
@endphp

<div
  class="pb-7.5 bg-amethyst text-white transition-all"
  :class="isButton ? '-mt-24 pt-24' : 'pt-[20px]'"
  x-collapse
  x-show="isOpen('{{ $loop->iteration }}')"
  @focusout="handleFocusOut('button{{ $loop->iteration }}')"
  @click.outside="clickOutside({{ $loop->iteration }})"
>
  <div class="container-fluid flex flex-col gap-5">

    {{-- Featured article card: image + text side by side (first item only) --}}
    @if (!empty($main))
      <a
        href="{!! $main['link'] ?? '#' !!}"
        @if (!empty($main['target'])) target="{!! $main['target'] !!}" @endif
        class="flex group link-no-underline"
      >
        <div class="relative w-[110px] shrink-0 rounded-tl-10 overflow-hidden min-h-[142px]">
          @if (!empty($main['featured_image_html']['card']))
            <div class="absolute inset-0 w-full h-full [&>img]:absolute [&>img]:inset-0 [&>img]:w-full [&>img]:h-full [&>img]:object-cover">
              {!! $main['featured_image_html']['card'] !!}
            </div>
          @endif
        </div>
        <div class="relative flex-1 bg-plum rounded-tr-10 rounded-br-10 overflow-hidden">
          <div class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
          <div class="relative z-5 flex flex-col gap-2.5 p-5 max-w-[350px]">
            @if (!empty($main['title']))
              <p class="text-base font-semibold leading-extra-tight mb-0">{!! $main['title'] !!}</p>
            @endif
            @svg('images.arrow-right', 'm-0.5 h-auto transition-transform duration-300 group-hover:translate-x-2.5')
          </div>
        </div>
      </a>
    @endif

    {{-- Navigation links --}}
    <ul class="flex flex-col gap-[4px]">
      @foreach ($item['children'] as $child)
        <li>
          <x-button
            :link="$child"
            color="subnav-mobile"
            icon="arrow-right"
          />
        </li>
      @endforeach
    </ul>

  </div>
</div>
