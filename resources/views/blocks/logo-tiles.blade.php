@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} bg-stone">
    <div class="container-fluid">
      <div class="border-current {{ $divider_classes }} grid grid-cols-1 lg:grid-cols-2 py-30 gap-10">
        <div>
          @if (!empty($headline))
            <h2 animate-text>{!! $headline !!}</h2>
          @endif

          @if (!empty($paragraph))
            <p
              animate-text
              class="mt-5 lg:mt-12.5"
            >{!! $paragraph !!}</p>
          @endif

          @if (!empty($button))
            <div animate>
              <x-button
                :link="$button"
                color="outline-dark"
                class="mt-5 lg:mt-12.5"
              />
            </div>
          @endif
        </div>

        <div>
          @if (!empty($posts))
            <div class="flex flex-wrap -m-2.75 xl:-m-3.75 lg:justify-start">
              @foreach ($posts as $item)
                <div class="w-1/2 md:w-1/3">
                  <div class="m-2.75 xl:m-3.75 border border-black/20 rounded-card overflow-hidden aspect-[59/44]">
                    <x-image
                      :id="$item['featured_image']"
                      class="object-cover w-full h-full"
                      size="full"
                      :sizes="['DEFAULT' => '1/2', 'lg' => '1/3', 'xl' => '1/6']"
                    />
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
@endif
