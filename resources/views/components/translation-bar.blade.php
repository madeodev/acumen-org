@if (!empty($translations))
  <nav
    aria-label="{!! $label !!}"
    class="bg-amethyst text-white"
  >
    <ul class="container-fluid flex justify-end items-center py-2.5">
      @foreach ($translations as $translation)
        <li class="px-3.5 border-r-2 last:pr-0 last:border-none h-6.5 flex items-center">
          <x-button
            :element="$translation['element']"
            :link="$translation"
            :color="$translation['color']"
          />
        </li>
      @endforeach
    </ul>
  </nav>
@endif
