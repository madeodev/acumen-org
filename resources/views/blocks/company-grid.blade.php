@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} my-20">
    <div class="container-fluid company-grid-vue">
      <company-grid
        :endpoints='@json($endpoints)'
        :labels='@json($labels)'
        :classes='@json($classes)'
        :prefilter='@json($prefilter)'
        :preselected='@json($preselected)'
      >
        @if (!empty($heading))
          <template v-slot:title>
            {!! $heading !!}
          </template>
        @endif
      </company-grid>
    </div>
  </section>
@endif
