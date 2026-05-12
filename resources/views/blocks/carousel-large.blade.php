@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($cards))
    <section
      x-data="carouselLarge"
      class="{{ $block->classes }} {{ $colors->classes('wrapper') }} py-5 relative"
    >

      <div
        class="swiper w-full h-fit"
        class="w-full h-fit"
        tabindex="0"
        x-ref="swiper"
      >
        <div class="swiper-wrapper">
          @foreach ($cards as $card)
            <div
              class="swiper-slide h-fit p-1 md:px-7.5 md:-mr-10 xl:mr-0 lg:pl-20 3xl:pl-0 md:w-10/12 3xl:ml-[calc((100vw-1376px)/2)] 3xl:-mr-[calc(((100vw-1376px)/2)-80px)] max-w-200 last:md:mr-[16.666%] min-[962px]:last:mr-[calc(100vw-50rem)]"
            >
              <{!! $card['element_start'] !!}
                class="rounded-card block link-no-underline py-5 px-4 md:p-5 md:pb-8 {{ $card['style'] }}"
              >

                @if (!empty($card['image']))
                  <div class="aspect-[10/6] w-full mb-5 rounded-card relative overflow-hidden">
                    <div data-swiper-parallax-x="25%">
                      <x-image
                        :id="$card['image']"
                        class="scale-125 origin-left w-full h-full object-cover"
                        :sizes="['md' => '10/12', '2xl' => '64rem']"
                      />
                    </div>
                  </div>
                @endif

                <div
                  class="transition-opacity duration-700"
                  :class="activeSlide == {{ $loop->index }} ? 'opacity-100' : 'opacity-0'"
                >
                  @if (!empty($card['title']))
                    <h2
                      class="mb-10"
                      animate-text
                    >
                      {!! $card['title'] !!}
                    </h2>
                  @endif

                  @if (!empty($card['button']))
                    <div animate>
                      <x-button
                        :link="$card['button']"
                        element="span"
                        :color="$colors->classes('button')"
                        class="group-hover:text-black group-hover:bg-white group-hover:border-white"
                      />
                    </div>
                  @endif
                </div>

                </{!! $card['element_end'] !!}>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Nav buttons --}}
      @if (count($cards) > 1)
        <div
          class="z-10 absolute bottom-6 -right-2.5 px-7.5 p-5 flex flex-col items-end max-w-200 pointer-events-none
         md:w-10/12 md:right-auto md:bottom-auto md:top-0 md:left-0 md:py-11 md:px-12.5 md:gap-9
         lg:pl-25
         3xl:pl-5 3xl:ml-[calc((100vw-1376px)/2)]"
          animate
        >
          <div
            class="w-full aspect-[10/6] hidden md:block relative z-0"
            aria-hidden="true"
          ></div>
          <div class="flex gap-5 md:-mr-38 lg:-mr-50 xl:-mr-60 pointer-events-auto">
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
        </div>
      @endif
    </section>
  @endif
@endif
