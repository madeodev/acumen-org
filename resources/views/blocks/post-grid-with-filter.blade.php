@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if(!empty($post_type))
    <section class="{{ $block->classes }} my-20">
      <div class="container-fluid post-grid-filter-vue">
        <post-grid-filter
          :endpoints='@json($endpoints)'
          :labels='@json($labels)'
          :classes='@json($classes)'
          :prefilter='@json($prefilter)'
          :post-type='@json($post_type)'
          :filters='@json($filters)'
        >
          @if (!empty($heading))
            <template v-slot:title>
              {!! $heading !!}
            </template>
          @endif
        </post-grid-filter>
      </div>
    </section>
  @endif
@endif
