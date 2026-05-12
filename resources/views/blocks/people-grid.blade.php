@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} my-20">
    <div class="container-fluid people-grid-vue">
      <people-grid
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
      </people-grid>
    </div>
  </section>
@endif
