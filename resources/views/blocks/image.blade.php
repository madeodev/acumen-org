@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($images))
    <div class="container-fluid my-5 lg:my-15 {{ $count > 1 ? 'grid grid-cols-1 md:grid-cols-2 gap-7.5' : '' }}">
      @foreach ($images as $image)
        <figure class="flex-1 h-fit">
          <div
            class="overflow-hidden lg:rounded-10 {{ $count === 1 ? 'aspect-video xl:aspect-auto max-h-171.25' : '' }}">
            <x-image
              :id="$image['id']"
              class="w-full object-cover {{ $count > 1 ? 'md:aspect-square ' : 'h-full' }}"
            />
          </div>
          @if (!empty($image['caption']))
            <figcaption class="px-4 pt-6 pb-4 m-0 font-serif text-sm font-medium lg:px-0 leading-1.4">
              {!! $image['caption'] !!}
            </figcaption>
          @endif
        </figure>
      @endforeach
    </div>
  @endif
@endif
