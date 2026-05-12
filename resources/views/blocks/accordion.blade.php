@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if(!empty($items))
    <section class="{{ $block->classes }} container-fluid my-7.5">

      @foreach ($items as $item)
          @continue(empty($item['title']) || empty($item['textarea']))
          <div 
            x-data="accordion" 
            x-id="['title','section']"
            class="border-b border-black"
          >
            <h2>
              <button 
                animate
                type="button"
                @click="toggle()"
                :id="$id('title')"
                :aria-expanded="open"
                :aria-controls="$id('section')"
                class="py-10 flex justify-between gap-10 items-center w-full text-left"
              >
                {!! $item['title'] !!}

                <x-button element="span" color="icon-black">
                  @svg('images.chevron-down', 'transition-all', [':class' => "open ? 'rotate-360' : '' "])
                  @svg('images.chevron-down', 'transition-all', [':class' => "open ? 'rotate-180 -mt-0.5' : 'rotate-0 -mt-1.75 opacity-0' "])
                </x-button>
              </button>
            </h2>
            <div
              :id="$id('section')"
              :aria-labelledby="$id('section')"
              role="region"
              x-collapse
              x-show="open"
              
            >
              <div class="pt-3 pb-15 flex flex-col gap-7.5">
                <div class="wysiwyg max-w-4xl">
                  {!! $item['textarea'] !!}
                </div>
  
                @if(!empty($item['button']))
                  <div>
                    <x-button :link="$item['button']" />
                  </div>
                @endif
              </div>

            </div>
          </div>
      @endforeach

    </section>
  @endif
@endif
