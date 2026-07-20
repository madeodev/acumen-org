<div
  class="ml-auto flex xl:hidden flex-col gap-5"
  x-data="nav(true)"
  @keydown.escape.window="handleEscape"
  @resize.window.debounce="handleWindowResize"
>

  <div class="container-fluid absolute top-4 right-0">
    <button
      @click="toggleMobileNav"
      aria-label="{!! __('Open navigation menu', 'header') !!}"
      class=" h-9 w-9 border border-black rounded-full flex flex-col items-center justify-center group hover:bg-black"
    >
      <div
        aria-hidden="true"
        class="h-[1.5px] w-3.5 bg-black my-[1.5px] rounded-1 group-hover:bg-white transform-gpu transition origin-center"
        :class="mobileNavOpen && 'rotate-[135deg] translate-y-[4.5px]'"
      ></div>
      <div
        aria-hidden="true"
        class="h-[1.5px] w-3.5 bg-black my-[1.5px] rounded-1 group-hover:bg-white transform-gpu transition origin-center"
        :class="mobileNavOpen ? 'rotate-[135deg] opacity-0' : 'opacity-100'"
      ></div>
      <div
        aria-hidden="true"
        class="h-[1.5px] w-3.5 bg-black my-[1.5px] rounded-1 group-hover:bg-white transform-gpu rotat transition origin-center"
        :class="mobileNavOpen && 'rotate-[225deg] -translate-y-[4.5px]'"
      ></div>
    </button>
  </div>

  <div
    x-ref="mobileNav"
    class="absolute top-full w-full bg-stone overflow-auto transition-all duration-300 hidden"
    :class="mobileNavOpen ? 'h-[calc(100vh-100%)]' : 'h-0'"
  >
    {{-- Main Nav --}}
    @if (!empty($main_nav))
      <nav aria-label="{{ wp_get_nav_menu_name('main_navigation') }}">
        <ul>


          {{-- Static Knowledge Hub item --}}
          <li
            x-data="{ isButton: false }"
            class="w-full transition-colors my-2.5"
            :class="isOpen('knowledge-hub') && 'bg-amethyst'"
          >
            <div class="container-fluid">
              <x-button
                x-ref="button-knowledge-hub"
                element="button"
                :link="['title' => 'Knowledge Hub']"
                color="main-nav-mobile-btn"
                @click="toggleMenu('knowledge-hub')"
                x-bind:aria-expanded="isOpen('knowledge-hub')"
                x-bind:class="isOpen('knowledge-hub') ?
                    'h4 leading-extra-tight text-white pt-7.5 mb-0 pb-0 focus-visible:!outline-none' :
                    'text-md'"
              />
            </div>
            @include('partials.subnav-mobile-static')
          </li>

          @foreach ($main_nav as $item)
            {{-- Normal links --}}
            @if ($item['children']->isEmpty() && !$loop->last)
              <li class="container-fluid my-2.5">
                <x-button
                  :link="$item"
                  color="main-nav-mobile"
                />
              </li>

              {{-- Links with submenus --}}
            @elseif(!$loop->last)
              <li
                x-data="{ isButton: false }"
                class="w-full transition-colors my-2.5"
                :class="isOpen({{ $loop->iteration }}) && 'bg-amethyst'"
              >
                <div class="container-fluid">
                  <x-button
                    x-ref="button{{ $loop->iteration }}"
                    element="button"
                    :link="$item"
                    color="main-nav-mobile-btn"
                    @click="toggleMenu({{ $loop->iteration }})"
                    x-bind:aria-expanded="isOpen({{ $loop->iteration }})"
                    x-bind:class="isOpen({{ $loop->iteration }}) ?
                        'h4 text-white pt-7.5 mb-0 focus-visible:!outline-none' :
                        'text-md'"
                  />
                </div>
                @if (count($item['featured_posts'] ?? []) === 3)
                  @include('partials.subnav-mobile-featured')
                @else
                  @include('partials.subnav-mobile')
                @endif
              </li>

              {{-- Last item looks like a button and has search in front of it --}}
            @else
              {{-- Search --}}
              <li class="mt-7.5 mb-5 container-pl inline-block">
                <x-button
                  x-ref="button-mobileSearch"
                  @click="toggleMenu('mobileSearch'); $nextTick(()=>$refs.mobileSearch.focus())"
                  element="button"
                  icon="search"
                  color="icon-search-mobile"
                  aria-label="{!! __('Search', 'header') !!}"
                  x-bind:class="{
                      'mt-4 border-white bg-transparent text-white hover:bg-white hover:text-black hover:border-white': isOpen(
                          'mobileSearch'),
                      'bg-black text-white hover:bg-transparent hover:text-black': !isOpen('mobileSearch')
                  }"
                />
              </li>

              {{-- Last menu item (e.g., Donate button) --}}
              <li class="mt-7.5 mb-5 inline-block">
                <x-button
                  :link="$item"
                  color="nav-donate"
                  icon="none"
                />
              </li>

              {{-- Search form --}}
              <div
                class="pb-7.5 bg-amethyst text-white transition-all -mt-24 pt-24"
                x-collapse
                x-show="isOpen('mobileSearch')"
                @focusout="handleFocusOut('button-mobileSearch')"
                @click.outside="clickOutside('mobileSearch')"
              >
                <div class="container-fluid flex items-center justify-center py-7.5">
                  <x-search-form ref="mobileSearch" />
                </div>
              </div>
            @endif
          @endforeach

        </ul>
      </nav>
    @endif

    {{-- Utility Nav --}}
    @if (!empty($util_nav))
      <nav
        class="container-fluid flex flex-col gap-5 border-t border-black py-5"
        aria-label="{{ wp_get_nav_menu_name('utility_navigation') }}"
      >
        @if (!empty($util_nav))
          <div class="text-sm font-semibold">
            {!! $util_intro !!}
          </div>
        @endif
        <ul class="flex gap-4 flex-wrap">
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
  </div>

</div>
