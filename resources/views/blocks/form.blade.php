@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} py-20 bg-tulip">
    <div class="container-fluid">
      <div class="flex flex-col xl:flex-row bg-stone rounded-card overflow-hidden">
        <div class="xl:w-2/3">
          <div class="p-10">
            @if (!empty($title))
              <h2 class="mb-3">{!! $title !!}</h2>
            @endif

            @if (!empty($intro))
              <p class="mt-2">{!! $intro !!}</p>
            @endif

            @if (!empty($form))
              {!! $form !!}
            @endif
          </div>
        </div>

        <div class="xl:w-1/3 relative">
          <x-image :id="$image" class="hidden xl:block xl:absolute xl:inset-0 w-full h-full object-cover"/>
        </div>
      </div>
    </div>
  </section>
@endif
