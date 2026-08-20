@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} bg-stone">
    <div class="container-fluid py-15 lg:py-20">
      <div class="rounded-card lg:grid lg:grid-cols-2 overflow-hidden {{ $colors->classes('wrapper') }}">

        <div
          class="aspect-[1.14] sm:aspect-video lg:max-h-none lg:aspect-auto w-full lg:h-full relative {{ $image_alignment === 'right' ? 'lg:order-2' : 'lg:order-1' }}"
        >
          @if (!empty($image))
            <x-image :id="$image" />
          @elseif(!empty($webm) || !empty($mp4))
            <x-local-video-loop
              :placeholder="$placeholder ?? ''"
              :webm="$webm ?? ''"
              :mp4="$mp4 ?? ''"
              :aria-label="$headline ?? ''"
              :decorative="empty($headline)"
            />
          @endif
        </div>

        <div
          class="p-7.5 sm:pb-12 flex flex-col gap-7.5 lg:px-15 lg:pt-20 lg:pb-30 lg:gap-15 {{ $image_alignment === 'right' ? 'lg:order-1' : 'lg:order-2' }}"
        >

          @if (!empty($topic))
            <div animate>
              <x-topic-label
                :label="$topic"
                :icon="$topic_icon"
              />
            </div>
          @endif

          <div>
            @if (!empty($headline))
              <h3
                class="mb-5"
                animate-text
              >
                {!! $headline !!}
              </h3>
            @endif

            @if (!empty($text))
              <div
                class="wysiwyg"
                animate-text
              >
                {!! $text !!}
              </div>
            @endif
          </div>

          @if (!empty($buttons))
            <div
              class="flex flex-col gap-7.5 sm:flex-row"
              animate
            >
              @foreach ($buttons as $item)
                @continue(empty($item['button']['url']))

                <x-button
                  :link="$item['button']"
                  :color="$colors->classes('button')"
                  class="w-fit"
                />
              @endforeach
            </div>
          @endif

        </div>

      </div>
    </div>
  </section>
@endif
