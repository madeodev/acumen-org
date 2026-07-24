@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($image))
    <div class="container-fluid my-5 lg:my-15 lg:mx-20 {{ $block->classes }}">
      <figure class="flex-1 h-fit">
        <div
          class="overflow-hidden lg:rounded-10 max-h-171.25"
          animate-image="reveal" 
        >
          <x-image
            :id="$image['id']"
            class="object-cover w-full"
          />
        </div>

        @if (!empty($image['caption']))
          <figcaption class="px-4 pt-6 pb-4 m-0 font-serif text-sm font-medium sm:px-0 leading-1.4">
            {!! $image['caption'] !!}
          </figcaption>
        @endif
      </figure>
    </div>
  @endif
@endif
