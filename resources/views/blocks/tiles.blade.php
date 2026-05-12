@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($tiles))
    <section class="{{ $block->classes }} bg-stone pt-7.5 pb-20">
      <div class="container-fluid">
        <div class="flex flex-col md:flex-row md:flex-wrap -m-7.5">
          @foreach ($tiles as $tile)
            <div class="md:w-1/2 lg:w-1/3 flex-grow">
              <div class="block p-7.5 h-full link-no-underline">
                <{{ $tile['tag'] }}
                  {{ !empty($tile['button']) ? 'href=' . $tile['button']['url'] . ' target=' . $tile['button']['target'] : '' }}
                  class="h-full relative group"
                >
                  <div
                    class="mask overflow-hidden min-h-56 lg:min-h-0 p-7.5 {{ $tile['color']->classes('wrapper') }} h-full flex flex-col justify-between"
                  >
                    <div class="md:mb-24">
                      @if (!empty($tile['title']))
                        <h3 animate-text class="h2 relative z-10 mb-4">{!! $tile['title'] !!}</h3>
                      @endif

                      @if (!empty($tile['description']))
                        <p animate-text class="group-hover:opacity-0 transition duration-500">{!! $tile['description'] !!}</p>
                      @endif
                    </div>

                    @if (!empty($tile['button']))
                      <div class="relative z-10" animate>
                        <x-button
                          element="span"
                          aria-hidden="true"
                          color="icon-white"
                          icon="arrow-right"
                          class="relative z-10 mt-10 md:mt-0"
                        />
                      </div>
                    @endif

                    @if (!empty($tile['image']))
                      <div
                        class="rounded-card absolute w-full h-full inset-0 group-hover:opacity-100 opacity-0 transition duration-500 z-0 overflow-hidden
                        before:bg-overlay before:absolute before:w-full before:h-full before:inset-0 before:z-[2]"
                      >
                        <x-image
                          :id="$tile['image']"
                          :sizes="[
                              'DEFAULT' => 'container',
                              'lg' => '1/2',
                              'xl' => '1/3',
                          ]"
                        />
                      </div>
                    @endif
                  </div>
                  </{{ $tile['tag'] }}>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endif
