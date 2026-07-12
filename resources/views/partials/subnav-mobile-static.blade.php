<div
  class="pb-7.5 bg-amethyst text-white transition-all"
  :class="isButton ? '-mt-24 pt-24' : 'pt-4'"
  x-collapse
  x-show="isOpen('knowledge-hub')"
  @focusout="handleFocusOut('button-knowledge-hub')"
  @click.outside="clickOutside('knowledge-hub')"
>
  <div class="container-fluid flex flex-col gap-5">

    {{-- Featured article card: image + text side by side --}}
    <a href="#" class="flex group link-no-underline">
      {{-- Image: fluid, fills height of the text side --}}
      <div class="relative w-[110px] shrink-0 rounded-tl-10 overflow-hidden min-h-[142px]">
        <img
          src="{{ \Roots\asset('images/knowledge-hub-featured.jpg')->uri() }}"
          alt="Acumen appoints Carsten Stendevad as President and Chief Investment Officer"
          class="absolute inset-0 w-full h-full object-cover"
        />
      </div>
      {{-- Text area --}}
      <div class="relative flex-1 bg-plum rounded-tr-10 rounded-br-10 overflow-hidden">
        <div class="absolute inset-0 bg-white/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
        <div class="relative z-5 flex flex-col gap-2.5 p-5">
          <p class="text-base font-semibold leading-extra-tight mb-0">Acumen appoints Carsten Stendevad as President and Chief Investment Officer</p>
          @svg('images.arrow-right', 'm-0.5 h-auto transition-transform duration-300 group-hover:translate-x-2.5')
        </div>
      </div>
    </a>

    {{-- Navigation links --}}
    <ul>
      <li>
        <x-button
          :link="['title' => 'Reports', 'url' => '#']"
          color="subnav-mobile"
          icon="arrow-right"
        />
      </li>
      <li>
        <x-button
          :link="['title' => 'Blogs', 'url' => '#']"
          color="subnav-mobile"
          icon="arrow-right"
        />
      </li>
      <li>
        <x-button
          :link="['title' => 'Case Studies', 'url' => '#']"
          color="subnav-mobile"
          icon="arrow-right"
        />
      </li>
      <li>
        <x-button
          :link="['title' => 'News', 'url' => '#']"
          color="subnav-mobile"
          icon="arrow-right"
        />
      </li>
    </ul>

  </div>
</div>
