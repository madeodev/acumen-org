@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($tabs))
    <section
      x-data="tabs({{ $tab_count }})"
      x-id="['tab', 'tabpanel']"
      class="{{ $block->classes }}"
    >
      <div class="container-fluid">
        <div class="border-current {{ $divider_classes }} grid grid-cols-1 md:grid-cols-2 py-18.75">
          <div
            class="flex flex-col mb-7.5 md:mb-0 -mt-5 md:-mt-7.5 {{ $image_alignment === 'right' ? 'md:order-1 md:pr-10 lg:pr-20' : 'md:order-2 md:pl-10 lg:pl-20' }}"
          >
            @foreach ($tabs as $tab)
              <div
                class="border-b"
                animate
              >
                @if (!empty($tab['label']))
                  <h3 class="font-bold">
                    <button
                      :id="$id('tab', {{ $loop->iteration }})"
                      @click="selectTab({{ $loop->iteration }}); $dispatch('tab-click')"
                      :aria-expanded="isSelected({{ $loop->iteration }})"
                      :aria-controls="$id('tabpanel', {{ $loop->iteration }})"
                      class="text-left py-5 md:py-7.5 w-full"
                      type="button"
                    >
                      {!! $tab['label'] !!}
                    </button>
                  </h3>
                @endif

                @if (!empty($tab['content']) || !empty($tab['button']))
                  <div
                    x-collapse
                    x-show="isSelected({{ $loop->iteration }})"
                    role="region"
                    :id="$id('tabpanel', {{ $loop->iteration }})"
                    :aria-labelledby="$id('tab', {{ $loop->iteration }})"
                  >
                    <div class="pb-7.5">
                      <p>{!! $tab['content'] !!}</p>

                      @if (!empty($tab['button']))
                        <x-button
                          :link="$tab['button']"
                          color="link"
                          icon="arrow-right"
                        />
                      @endif
                    </div>
                  </div>
                @endif
              </div>
            @endforeach
          </div>

          <div
            class="relative overflow-hidden rounded-image lg:rounded-image-xl aspect-[640/683] {{ $image_alignment === 'right' ? 'md:order-2' : 'md:order-1' }}"
          >
            @foreach ($tabs as $tab)
              <div
                class="absolute inset-0 w-full h-full"
                x-transition:enter.duration.600ms
                x-transition:leave.duration.300ms
                x-show="isSelected({{ $loop->iteration }})"
                :aria-labelledby="$id('tab', {{ $loop->iteration }})"
              >
                @if ($tab['media_type'] === 'image')
                  @if (!empty($tab['image']))
                    <x-parallax-image
                      :id="$tab['image']"
                      class="relative h-full"
                      :sizes="[
                          'md' => '3/4',
                      ]"
                    />
                  @endif
                @else
                  @if (!empty($tab['webm']) || !empty($tab['mp4']))
                    <x-local-video-loop
                      :placeholder="$tab['placeholder'] ?? ''"
                      :webm="$tab['webm'] ?? ''"
                      :mp4="$tab['mp4'] ?? ''"
                    />
                  @endif
                @endif
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  @endif
@endif
