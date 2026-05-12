@if ($block->preview)
  <x-preview
    :block="$block"
    :variant="$module_bg"
  />
@else
  <header
    class="{{ $block->classes }} {{ $colors->classes('wrapper') }} relative overflow-hidden"
    @if (!empty($modal['video'])) x-data="videoModal" @endif
  >
    <div class="container-fluid pt-15 md:pt-18.75 pb-20 md:pb-45 relative z-10">
      <div class="md:max-w-[75%]">
        @if (!empty($title))
          <h1
            class="hero-headline"
            id="{{ !empty($modal) ? $modal['id'] . '_label' : '' }}"
            animate-text
          >
            {!! $title !!}
          </h1>
        @endif

        @if (!empty($intro))
          <p
            class="h3 mt-8 md:mt-15"
            animate-text
            id="{{ !empty($modal) ? $modal['id'] . '_desc' : '' }}"
          >
            {!! $intro !!}
          </p>
        @endif

        @if (!empty($button))
          <div
            class="mt-8 md:mt-15"
            animate
          >
            @if ($button_type === 'modal' && !empty($modal['video']))
              <x-button
                icon="play-arrow"
                element="button"
                color="fill"
                @click="triggerOpenModal"
              >
                {!! $button['title'] !!}
              </x-button>
            @else
              <x-button
                :link="$button"
                external-gets-icon-new-tab
                color="fill"
              />
            @endif
          </div>
        @endif
      </div>
    </div>

    @if ($module_bg === 'media')
      <div
        class="top-0 left-0 absolute w-full h-full
          before:bg-overlay before:absolute before:top-0 before:left-0 before:w-full before:h-full before:z-5"
      >
        @if (!empty($image))
          <x-parallax-image
            :id="$image"
            class="relative h-full w-full"
          />
        @endif

        @if(!empty($webm) || !empty($mp4))
          <x-local-video-loop
            preload
            :placeholder="$placeholder ?? ''"
            :webm="$webm ?? ''"
            :mp4="$mp4 ?? ''"
          />
        @endif

      </div>
    @endif

    @if (!empty($modal))
      <x-modal-video :modal="$modal" />
    @endif
  </header>
@endif
