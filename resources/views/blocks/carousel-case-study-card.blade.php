@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($items))
    <section
      class="{{ $block->classes }} py-15 lg:py-20"
      x-data="carouselCaseStudyCard"
    >
      <div class="container-fluid relative">
        <div
          class="swiper h-fit"
          x-ref="swiper"
          tabindex="0"
        >
          <div class="swiper-wrapper">
            @foreach ($items as $item)
              <div class="swiper-slide h-auto">
                <div
                  class="rounded-card overflow-hidden grid grid-cols-1 lg:grid-cols-2 h-full {{ $item['color']->classes('wrapper') }}"
                >
                  <div class="py-7.5 px-5 lg:py-20 lg:px-15 inline-flex w-full flex-col gap-5 md:gap-7.5">
                    @if (!empty($item['term']))
                      <div animate>
                        <x-topic-label :term="$item['term']" />
                      </div>
                    @endif

                    @if (!empty($item['title']))
                      <h2
                        animate-text
                        class="mb-0"
                      >{!! $item['title'] !!}</h2>
                    @endif

                    @if (!empty($item['primary_problem']) || !empty($item['primary_region']) || !empty($item['year']))
                      <div
                        class="border-t pt-5 inline-flex gap-x-5 gap-y-2 flex-wrap"
                        animate
                      >
                        @if (!empty($item['primary_problem']))
                          <x-topic-label :term="$item['primary_problem']" />
                        @endif
                        @if (!empty($item['primary_region']))
                          <x-topic-label :term="$item['primary_region']" />
                        @endif
                        @if (!empty($item['year']))
                          <x-topic-label :term="$item['year']" />
                        @endif
                      </div>
                    @endif

                    @if (!empty($item['excerpt']))
                      <p
                        animate-text
                        class="h3 text-lg md:text-2xl mb-0"
                      >{!! $item['excerpt'] !!}</p>
                    @endif

                    @if (!empty($item['stats']['stats']))
                      <div class="border-t w-full hidden md:inline-flex gap-5 lg:gap-15 pt-5">
                        @foreach ($item['stats']['stats'] as $stat)
                          <figure>
                            @if (!empty($stat['stat']))
                              <p
                                animate
                                class="h3 mb-0"
                              >{!! $stat['stat'] !!}</p>
                            @endif

                            @if (!empty($stat['description']))
                              <figcaption
                                animate-text
                                class="mb-0"
                              >
                                {!! $stat['description'] !!}
                              </figcaption>
                            @endif
                          </figure>
                        @endforeach
                      </div>
                    @endif

                    <div animate>
                      <x-button
                        :link="$item['button']"
                        color="outline-white"
                        class="self-start lg:mt-7.5"
                      />
                    </div>
                  </div>

                  <div>
                    @if (!empty($item['featured_image']))
                      <x-image
                        :id="$item['featured_image']"
                        class="aspect-[335/167] lg:aspect-auto h-full w-full object-cover"
                        :sizes="[
                            'DEFAULT' => 'container',
                            'lg' => '3/4',
                        ]"
                      />
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        @if (count($items) > 1)
          <div class="flex justify-between lg:block mt-5 lg:mt-0 items-center">
            <div class="inline-flex gap-5 lg:block">
              <x-button
                element="button"
                x-ref="prev"
                type="icon"
                color="icon-black"
                icon="arrow-left"
                class="lg:absolute left-0 top-1/2 lg:-translate-y-1/2 lg:ml-4"
              >
                {!! __('Previous slide', 'case-study-carousel') !!}
              </x-button>
              <x-button
                element="button"
                x-ref="next"
                type="icon"
                color="icon-black"
                icon="arrow-right"
                class="lg:absolute right-0 top-1/2 lg:-translate-y-1/2 lg:mr-4"
              >
                {!! __('Previous slide', 'case-study-carousel') !!}
              </x-button>
            </div>

            <div
              class="lg:mt-7.5 lg:pb-1 flex items-center justify-end lg:justify-center"
              x-ref="pagination"
            ></div>
          </div>
        @endif
      </div>
    </section>
  @endif
@endif
