<div
  class="hidden xl:flex flex-col gap-5 ml-auto xl:min-w-[77%]"
  x-ref="nav"
>
  {{-- Utility Nav --}}
  @if (!empty($util_nav))
    <nav
      class="flex border-b border-black pb-1.25"
      aria-label="{!! wp_get_nav_menu_name('utility_navigation') !!}"
    >
      @if (!empty($util_nav))
        <div class="text-sm font-semibold py-1.25">
          {!! $util_intro !!}
        </div>
      @endif
      <ul class="flex gap-5 ml-auto">
        @foreach ($util_nav as $item)
          <li>
            <x-button
              :link="$item"
              color="utility-nav"
              icon="arrow-outward"
            />
          </li>
        @endforeach
      </ul>
    </nav>
  @endif

  {{-- Main Nav --}}
  @if (!empty($main_nav))
    <nav
      aria-label="{!! wp_get_nav_menu_name('main_navigation') !!}"
      {{-- @mouselave="handleEscape" --}}
    >
      <ul class="flex items-baseline gap-10">

        {{-- Static Resources Nav Item --}}
        <li>
          <x-button
            x-ref="button-resources"
            element="button"
            :link="['title' => 'Resources']"
            class="menu-item-parent"
            color="main-nav"
            @mouseover="openMenu('resources')"
            x-bind:aria-expanded="isOpen('resources')"
            x-bind:class="isOpen('resources') ?
                'font-bold text-amethyst border-amethyst border-b-4' :
                'border-transparent mb-0.5'"
          />

          <template x-teleport="#nav-desktop-container">
            @include('partials.subnav-desktop-static')
          </template>
        </li>

        @foreach ($main_nav as $item)
          {{-- Normal links --}}
          @if ($item['children']->isEmpty() && !$loop->last)
            <li>
              <x-button
                :link="$item"
                color="main-nav"
              />
            </li>

            {{-- Links with submenus --}}
          @elseif(!$loop->last)
            <li>
              <x-button
                x-ref="button{{ $loop->iteration }}"
                :link="$item"
                class="menu-item-parent"
                color="main-nav"
                @mouseover="openMenu({{ $loop->iteration }})"
                x-bind:aria-expanded="isOpen({{ $loop->iteration }})"
                x-bind:class="isOpen({{ $loop->iteration }}) ?
                    'font-bold text-amethyst border-amethyst border-b-4' :
                    'border-transparent mb-0.5'"
              />

              <template x-teleport="#nav-desktop-container">
                @include('partials.subnav-desktop')
              </template>
            </li>

            {{-- Last item looks like a button and has search in front of it --}}
          @else
            {{-- Search --}}
            <li class="ml-auto">
              <x-button
                x-ref="button-search"
                @click="toggleMenu('desktopSearch'); $nextTick(()=>$refs.desktopSearch.focus())"
                element="button"
                icon="search"
                color="icon-black"
                aria-label="{!! __('Search', 'header') !!}"
                x-bind:aria-expanded="isOpen('desktopSearch')"
              />
              {{-- Search form --}}
              <div
                class="absolute inset-x-0 text-white bg-amethyst top-full shadow-nav"
                x-collapse
                x-cloak
                x-show="isOpen('desktopSearch')"
                @focusout="handleFocusOut('button-search')"
                @click.outside="clickOutside('desktopSearch')"
              >
                <div class="flex items-center justify-center container-fluid py-30">
                  <x-search-form ref="desktopSearch" />
                </div>
              </div>
            </li>

            {{-- Last menu item (e.g., Donate button) --}}
            <li>
              <x-button
                :link="$item"
                color="nav-donate"
                icon="none"
              />
            </li>
          @endif
        @endforeach

      </ul>
    </nav>
  @endif
</div>
