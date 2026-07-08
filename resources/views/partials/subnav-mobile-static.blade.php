<div
  class="pb-7.5 bg-amethyst text-white transition-all"
  :class="isButton ? '-mt-24 pt-24' : 'pt-2'"
  x-collapse
  x-show="isOpen('knowledge-hub')"
  @focusout="handleFocusOut('button-knowledge-hub')"
  @click.outside="clickOutside('knowledge-hub')"
>
  <div class="container-fluid flex flex-col gap-5">

    {{-- Featured article card: image + text side by side --}}
    <div class="flex">
      {{-- Image: fluid, fills height of the text side --}}
      <div class="relative w-1/4 shrink-0 rounded-tl-10 overflow-hidden min-h-[142px]">
        <img
          src="{{ \Roots\asset('images/knowledge-hub-featured.jpg')->uri() }}"
          alt="Acumen appoints Carsten Stendevad as President and Chief Investment Officer"
          class="absolute inset-0 w-full h-full object-cover"
        />
      </div>
      {{-- Text area --}}
      <div class="flex-1 flex flex-col gap-5 bg-plum rounded-tr-10 rounded-br-10 p-5">
        <p class="text-base font-semibold leading-extra-tight">Acumen appoints Carsten Stendevad as President and Chief Investment Officer</p>
        <x-button
          :link="['title' => 'Read more', 'url' => '#']"
          type="icon"
          icon="arrow-right"
          color="icon-white"
        />
      </div>
    </div>

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
