<div
  class="absolute inset-x-0 text-white bg-amethyst top-full shadow-nav"
  x-collapse
  x-cloak
  x-show="isOpen('{{ $loop->iteration }}')"
  @focusout="handleFocusOut('button{{ $loop->iteration }}')"
  @click.outside="clickOutside({{ $loop->iteration }})"
>
  <div
    class="container-fluid grid grid-cols-4 gap-7.5 py-15"
    x-data="{ open: null }"
    x-id="['child-description']"
  >
    {{-- Column 1 --}}
    <div class="flex flex-col gap-5">

      @if (!empty($item['title']))
        <div class="text-xl font-bold">
          {!! $item['title'] !!}
        </div>
      @endif

      @if (!empty($item['description']))
        <p class="mb-5">
          {!! $item['description'] !!}
        </p>
      @endif
      @if (!empty($item['url']) && $item['url'] !== '#')
        <x-button
          :link="$item"
          type="icon"
          icon="arrow-right"
          color="icon-white"
        />
      @endif
    </div>
    {{-- Column 2 --}}
    <ul class="pl-5 border-l border-white">
      @foreach ($item['children'] as $child)
        <li>
          <x-button
            :link="$child"
            color="subnav"
            icon="arrow-right"
            x-bind:class="open === {{ $loop->iteration }} && 'bg-white/30'"
            @mouseenter="open = {{ $loop->iteration }}"
            @focusin="open = {{ $loop->iteration }}"
            x-bind:aria-describedby="$id('child-description', {{ $loop->iteration }})"
          />
        </li>
      @endforeach
    </ul>
    {{-- Columns 3/4 --}}
    <div class="col-span-2 pl-5 border-l border-white">
      @foreach ($item['children'] as $child)
        <div
          x-show="open === {{ $loop->iteration }}"
          class="grid grid-cols-2 gap-7.5"
          role="tooltip"
          :id="$id('child-description', {{ $loop->iteration }})"
        >
          <div>
            <div
              aria-hidden="true"
              class="my-5 text-base font-semibold"
            >
              {!! $child['title'] !!}
            </div>
            <p class="text-base leading-5">
              {!! $child['description'] !!}
            </p>
          </div>
          <x-image
            :id="$child['image']"
            class="object-cover w-full mask aspect-square"
          />
        </div>
      @endforeach
    </div>

  </div>

</div>
