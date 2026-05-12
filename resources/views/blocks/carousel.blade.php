@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($cards))
    <section
      class="{{ $block->classes }} transition-colors duration-700 relative"
      :class="activeSlide"
      x-data='carousel(@json($colors))'
      x-id="['carousel']"
    >
      <div
        class="swiper w-full h-fit"
        @if (count($cards) > 1) tabindex="0" @endif
        x-ref="swiper"
      >
        <div class="swiper-wrapper">
          @foreach ($cards as $slide)
            @continue(empty($slide))
            <div class="swiper-slide h-auto">
              <div class="container-fluid flex flex-col h-full md:flex-row gap-y-7.5 py-15 lg:py-20">
                <div class="flex flex-col gap-10 mr-auto md:pr-10 lg:pr-20 xl:pr-30 w-full">
                  @if (!empty($slide['topic']))
                    <div animate>
                      <x-topic-label
                        :label="$slide['topic']"
                        :icon="$slide['topic_icon']"
                      />
                    </div>
                  @endif

                  @if (!empty($slide['title']))
                    <h2 animate-text>
                      {!! $slide['title'] !!}
                    </h2>
                  @endif

                  <div
                    class="flex w-full gap-5 md:flex-col flex-grow md:pb-9"
                    animate
                  >
                    @if (!empty($slide['button']))
                      <x-button
                        :link="$slide['button']"
                        color="outline-white"
                        class="w-fit"
                      />
                    @endif

                    {{-- Mobile nav buttons --}}
                    @if (count($cards) > 1)
                      <div class="flex gap-5 ml-auto md:ml-0 md:mt-auto md:hidden">
                        <x-button
                          x-bind:class="'prev-' + $id('carousel')"
                          type="icon"
                          icon="arrow-left"
                          element="button"
                          color="icon-white"
                        >
                          {!! __('Previous Slide', 'carousel') !!}
                        </x-button>

                        <x-button
                          x-bind:class="'next-' + $id('carousel')"
                          type="icon"
                          icon="arrow-right"
                          element="button"
                          color="icon-white"
                        >
                          {!! __('Next Slide', 'carousel') !!}
                        </x-button>

                      </div>
                    @endif
                  </div>
                </div>

                @if (!empty($slide['image']))
                  <div class="w-full md:max-w-[50%] xl:max-w-screen-sm">

                    <x-image
                      :id="$slide['image']"
                      class="object-cover aspect-[16/15] w-full rounded-image xl:rounded-image-xl "
                    />
                  </div>
                @endif

              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Desktop nav buttons --}}
      @if (count($cards) > 1)
        <div
          class="gap-5 hidden md:flex absolute z-30 left-0 right-0 bottom-15 container-fluid"
          animate
        >
          <x-button
            x-ref="prev"
            type="icon"
            icon="arrow-left"
            element="button"
            color="icon-white"
          >
            {!! __('Previous Slide', 'carousel') !!}
          </x-button>

          <x-button
            x-ref="next"
            type="icon"
            icon="arrow-right"
            element="button"
            color="icon-white"
          >
            {!! __('Next Slide', 'carousel') !!}
          </x-button>

        </div>
      @endif
    </section>
  @endif
@endif
