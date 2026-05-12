@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} {{ $colors->classes('wrapper') }}">
    <div class="container-fluid">
      <div class="border-current {{ $divider_classes }} grid grid-cols-1 lg:grid-cols-2 gap-y-7.5 py-7.5 lg:py-15">
        @if(!empty($headline))
          <{{$heading_tag}} class="h2 lg:mr-20 xl:mr-30" animate-text >
            {!! $headline !!}
          </{{$heading_tag}}>
        @endif

        @if(!empty($text_area))
          <div class="wysiwyg" animate-text>
            {!! $text_area !!}
          </div>
        @endif
      </div>
    </div>
  </section>
@endif
