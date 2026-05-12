@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} interactive-map-vue">
    <interactive-map
      :labels='@json($labels)'
      :sections='@json($data)'
      endpoint='{{$endpoint}}'
    />
  </section>

@endif
