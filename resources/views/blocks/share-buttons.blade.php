@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} text-container border-black border-t mt-15 mb-7.5 py-7.5">
    <div class="py-2.5 flex gap-10 items-center" animate>
      <h2 class="h4 m-0">
        {!! __('Share', 'share_buttons') !!}
      </h2>
      <ul class="flex gap-2 items-center" x-data="shareButtons('{{$copied}}', '{{$copy_failed}}')">

        @foreach ($share_options as $option)

          <li>
            <x-button 
              @click.prevent="open($el)" 
              :link="[...$option, 'target' => '_blank']" 
              :title="$option['title']"
              color="icon-black-small" 
              icon-class="w-auto" 
              type="icon" 
              :icon="$option['image']" 
            />
          </li>

        @endforeach

        {{-- Copy --}}
        <li class="relative" x-id="['tooltip']">

          <x-button 
            element="button"
            @click="copyLink()"
            x-bind:aria-describedby="tooltip && $id('tooltip')"
            title="{!! __('Copy link', 'share_buttons') !!}"
            color="icon-black-small" 
            icon-class="pr-0.5 w-auto" 
            type="icon" 
            icon="share" 
          />
          <div 
            :id="$id('tooltip')" 
            x-show="tooltip"
            x-text="tooltip"
            class="absolute bg-black text-white rounded-md py-1 px-2 text-sm whitespace-nowrap left-1/2 -translate-x-1/2 -top-9"
          ></div>
        </li>
      </ul>
    </div>

  </section>
@endif
