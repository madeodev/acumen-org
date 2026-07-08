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
      <div class="col-span-2 flex">
        {{-- Image: fluid, fills height of text side via flex-stretch --}}
        <div class="relative w-2/5 shrink-0 rounded-tl-10 overflow-hidden">
          <img
            src="{{ \Roots\asset('images/knowledge-hub-featured.jpg')->uri() }}"
            alt="Acumen appoints Carsten Stendevad as President and Chief Investment Officer"
            class="absolute inset-0 w-full h-full object-cover"
          />
        </div>
        {{-- Text area --}}
        <div class="flex-1 flex flex-col gap-5 bg-plum rounded-tr-10 rounded-br-10 p-7.5">
          <p class="text-base font-semibold leading-extra-tight">Acumen appoints Carsten Stendevad as President and Chief Investment Officer</p>
          <p class="text-base">Former ATP CEO and Bridgewater co-Chief Investment Officer for Sustainable Investing to lead Acumen's $500M impact investments.</p>
          <x-button
            :link="['title' => 'Read more', 'url' => '#']"
            type="icon"
            icon="arrow-right"
            color="icon-white"
          />
        </div>
      </div>

      {{-- Col 3: Two stacked article teasers --}}
      <div class="flex flex-col gap-5">
        <div class="flex flex-col gap-5 bg-plum rounded-tl-10 rounded-tr-10 rounded-br-10 p-7.5 flex-1">
          <p class="text-base font-semibold leading-extra-tight">Scaling decent work in Africa starts by supporting informal jobs</p>
          <x-button
            :link="['title' => 'Read more', 'url' => '#']"
            type="icon"
            icon="arrow-right"
            color="icon-white"
          />
        </div>
        <div class="flex flex-col gap-5 bg-plum rounded-tl-10 rounded-tr-10 rounded-br-10 p-7.5 flex-1">
          <p class="text-base font-semibold leading-extra-tight">When hardware meets heart: Reimagining farmland for a dual-purpose future</p>
          <x-button
            :link="['title' => 'Read more', 'url' => '#']"
            type="icon"
            icon="arrow-right"
            color="icon-white"
          />
        </div>
      </div>

      {{-- Col 4: Navigation links with left border --}}
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
