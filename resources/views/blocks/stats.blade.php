@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} {{ $colors->classes('wrapper') }} py-15 md:py-20">
    <div class="container-fluid">

      <x-stats :title="$title ?? ''" :stats="$stats ?? []" />
  
      @if(!empty($button))
        <div animate>
          <x-button :link="$button" :colors="$colors->classes('button')" class="mt-10 md:mt-15"/>
        </div>
      @endif

    </div>

  </section>
@endif
