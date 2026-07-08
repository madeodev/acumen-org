<div
  class="absolute inset-x-0 text-white bg-amethyst top-full shadow-nav"
  x-collapse
  x-cloak
  x-show="isOpen('resources')"
  @focusout="handleFocusOut('button-resources')"
  @click.outside="clickOutside('resources')"
>
  <div class="container-fluid grid grid-cols-3 gap-7.5 py-15">

    {{-- Column 1: Intro --}}
    <div class="flex flex-col gap-5">
      <div class="text-xl font-bold">Resources</div>
      <p class="mb-5">Explore our library of guides, reports, and tools to support your work.</p>
      <x-button
        :link="['title' => 'View all resources', 'url' => '#']"
        type="icon"
        icon="arrow-right"
        color="icon-white"
      />
    </div>

    {{-- Column 2: Links --}}
    <ul class="pl-5 border-l border-white">
      <li>
        <x-button
          :link="['title' => 'Blog', 'url' => '#']"
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
          :link="['title' => 'Whitepapers', 'url' => '#']"
          color="subnav"
          icon="arrow-right"
        />
      </li>
      <li>
        <x-button
          :link="['title' => 'Webinars', 'url' => '#']"
          color="subnav"
          icon="arrow-right"
        />
      </li>
      <li>
        <x-button
          :link="['title' => 'FAQs', 'url' => '#']"
          color="subnav"
          icon="arrow-right"
        />
      </li>
    </ul>

    {{-- Column 3: Featured --}}
    <div class="pl-5 border-l border-white flex flex-col gap-5">
      <div class="text-base font-semibold">Featured</div>
      <p class="text-base leading-5">Our latest annual report highlighting key achievements and impact metrics from the past year.</p>
      <x-button
        :link="['title' => 'Read the Annual Report', 'url' => '#']"
        color="subnav"
        icon="arrow-right"
      />
    </div>

  </div>
</div>
