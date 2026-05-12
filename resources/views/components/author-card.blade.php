<article class="flex flex-col gap-5 md:gap-10 md:flex-row max-w-160">
  <div class="w-45">
    <div class="overflow-hidden w-full rounded-10 aspect-square bg-black/10">
      @if (!empty($image))
        <x-image
          :id="$image"
          class="object-cover w-full h-full"
        />
      @else
        @svg('images.logo', 'p-5 w-full h-full grayscale opacity-30 object-contain')
      @endif
    </div>
  </div>

  <div class="w-full">
    @if (!empty($name))
      <h3 class="mb-1.5 text-lg font-bold h5">{!! $name !!}</h3>
    @endif

    @if (!empty($title))
      <p class="mb-3 text-base font-bold">{!! $title !!}</p>
    @endif

    @if (!empty($bio))
      <p class="mt-3 mb-0 text-base">{!! $bio !!}</p>
    @endif
  </div>
</article>
