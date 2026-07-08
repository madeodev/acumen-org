<div
  class="absolute inset-x-0 text-white bg-amethyst top-full shadow-nav"
  x-collapse
  x-cloak
  x-show="isOpen('knowledge-hub')"
  @focusout="handleFocusOut('button-knowledge-hub')"
  @click.outside="clickOutside('knowledge-hub')"
>
  <div class="container-fluid flex flex-col gap-7.5 py-15">

    <p class="text-xl font-bold">Featured</p>

    <div class="grid grid-cols-4 gap-7.5">

      {{-- Cols 1–2: Large featured article card --}}
      <a href="#" class="col-span-2 flex group link-no-underline">
        {{-- Image: fluid, fills height of text side via flex-stretch --}}
        <div class="relative w-1/2 shrink-0 rounded-tl-10 overflow-hidden">
          <img
            src="{{ \Roots\asset('images/knowledge-hub-featured.jpg')->uri() }}"
            alt="Acumen appoints Carsten Stendevad as President and Chief Investment Officer"
            class="absolute inset-0 w-full h-full object-cover"
          />
        </div>
        {{-- Text area --}}
        <div class="relative w-1/2 bg-plum rounded-tr-10 rounded-br-10 overflow-hidden">
          {{-- White overlay: fades in on group-hover, stacks over bg-plum --}}
          <div class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
          {{-- Content sits above the overlay --}}
          <div class="relative z-5 flex flex-col gap-5 p-7.5">
            <p class="text-base font-semibold leading-extra-tight">Acumen appoints Carsten Stendevad as President and Chief Investment Officer</p>
            <p class="text-base">Former ATP CEO and Bridgewater co-Chief Investment Officer for Sustainable Investing to lead Acumen's $500M impact investments.</p>
            @svg('images.arrow-right', 'w-3.5 h-auto transition-transform duration-300 group-hover:translate-x-2.5')
          </div>
        </div>
      </a>

      {{-- Col 3: Two stacked article teasers --}}
      <div class="flex flex-col gap-5">
        <a href="#" class="flex flex-col bg-plum rounded-tl-10 rounded-tr-10 rounded-br-10 relative overflow-hidden flex-1 group link-no-underline">
          <div class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
          <div class="relative z-5 flex flex-col gap-5 p-7.5">
            <p class="text-base font-semibold leading-extra-tight">Scaling decent work in Africa starts by supporting informal jobs</p>
            @svg('images.arrow-right', 'w-3.5 h-auto transition-transform duration-300 group-hover:translate-x-2.5')
          </div>
        </a>
        <a href="#" class="flex flex-col bg-plum rounded-tl-10 rounded-tr-10 rounded-br-10 relative overflow-hidden flex-1 group link-no-underline">
          <div class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
          <div class="relative z-5 flex flex-col gap-5 p-7.5">
            <p class="text-base font-semibold leading-extra-tight">When hardware meets heart: Reimagining farmland for a dual-purpose future</p>
            @svg('images.arrow-right', 'w-3.5 h-auto transition-transform duration-300 group-hover:translate-x-2.5')
          </div>
        </a>
      </div>

      {{-- Col 4: Navigation links with left border --}}
      {{-- subnav button color already has group-hover:translate-x-2.5 on the icon --}}
      <ul class="pl-5 border-l border-white">
        <li>
          <x-button
            :link="['title' => 'Reports', 'url' => '#']"
            color="subnav"
            icon="arrow-right"
          />
        </li>
        <li>
          <x-button
            :link="['title' => 'Blogs', 'url' => '#']"
            color="subnav"
            icon="arrow-right"
          />
        </li>
        <li>
          <x-button
            :link="['title' => 'Case Studies', 'url' => '#']"
            color="subnav"
            icon="arrow-right"
          />
        </li>
        <li>
          <x-button
            :link="['title' => 'News', 'url' => '#']"
            color="subnav"
            icon="arrow-right"
          />
        </li>
      </ul>

    </div>
  </div>
</div>
