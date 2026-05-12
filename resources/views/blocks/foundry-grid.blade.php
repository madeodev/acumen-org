@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} my-20">
    <div class="container-fluid foundry-grid-vue">
      <foundry-grid
        :endpoints='@json($endpoints)'
        :labels='@json($labels)'
        :classes='@json($classes)'
        :prefilter='@json($prefilter)'
        :preselected='@json($preselected)'
        chips="{{ $chip_tax }}"
      >
        @if (!empty($heading))
          <template v-slot:title>
            {!! $heading !!}
          </template>
        @endif
      </foundry-grid>
    </div>
  </section>
@endif
