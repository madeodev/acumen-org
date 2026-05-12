<header class="flex flex-col">
  <div
    class="flex flex-col container-fluid gap-7.5 py-7.5 w-full {{ $imagePosition === 'above' ? 'order-last' : 'order-first' }}"
  >
    <div class="flex gap-10 justify-between items-center">
      <div class="flex flex-col max-w-5xl gap-7.5 md:gap-10 md:py-7.5">

        @if (!empty($logo))
          <x-image
            :id="$logo"
            class="w-fit h-15"
          />
        @endif

        @if (!empty($title))
          <h1 animate-text>
            {!! $title !!}
          </h1>
        @endif

        @if (!empty($image) && $imagePosition === 'side')
          <x-parallax-image
            :id="$image"
            class="overflow-hidden rounded-image aspect-square md:hidden"
            image-class="object-cover w-full h-full"
          />
        @endif

        @if (!empty($excerpt))
          <p
            class="mb-0 h3"
            animate-text
          >
            {!! $excerpt !!}
          </p>
        @endif

        @if (!empty($date) || !empty($author))
          <div
            class="flex flex-wrap mb-0 gap-x-7.5 h5 md:min-h-4"
            animate
          >
            @if (!empty($date))
              <time datetime="{{ $datetime }}">
                {!! $date !!}
              </time>
            @endif
            @if (!empty($author))
              <span>
                {!! __('By:', 'title') . ' ' . $author !!}
              </span>
            @endif
          </div>
        @endif

        @if (!empty($button) && !empty($button['url']))
          <div animate>
            <x-button
              :link="$button"
              :icon="$buttonIcon"
              external-gets-icon-new-tab
            />
          </div>
        @endif

      </div>

      {{-- Desktop image --}}
      @if (!empty($image) && $imagePosition === 'side')
        <x-parallax-image
          :id="$image"
          class="flex-shrink-0 overflow-hidden rounded-image xl:rounded-image-xl aspect-square w-150 max-w-[40%] 2xl:max-w-none hidden md:block my-7.5 self-start"
          image-class="object-cover w-full h-full"
          :sizes="['md' => '4/10 * 1.25', '2xl' => 'calc(37.5rem) * 1.25']"
        />
      @endif

    </div>

    @if (!empty($taxonomies))
      <ul class="flex flex-wrap gap-5 items-center border-t border-black pt-7.5">
        @foreach ($taxonomies as $term)
          <li
            class="flex items-center h-7"
            animate
          >
            <x-topic-label :term="$term" />
          </li>
        @endforeach
      </ul>
    @endif
  </div>

  @if (!empty($image) && (empty($imagePosition) || $imagePosition !== 'side'))
    <div class="{{ $imagePosition === 'above' ? 'order-first mb-8' : 'order-last mt-8' }}">
      <figure class="overflow-hidden relative max-h-171.25">
        <div class="aspect-video">
          <x-parallax-image
            :id="$image"
            image-class="object-cover w-full h-full"
          />

          @if (!empty($video))
            @if (!empty($video['webm']) || !empty($video['mp4']))
              <x-local-video-loop
                preload
                :placeholder="$image ?? null"
                :webm="$video['webm'] ?? ''"
                :mp4="$video['mp4'] ?? ''"
              />
            @endif
          @endif
        </div>
      </figure>

      @if (!empty($imageCaption))
        <figcaption class="mt-6 mb-0 font-serif text-sm container-fluid">
          <div class="lg:w-1/2">
            {!! $imageCaption !!}
          </div>
        </figcaption>
      @endif
    </div>
  @endif
</header>
