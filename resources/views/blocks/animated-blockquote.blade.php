@if ($block->preview)
  <x-preview :block="$block" />
@else
  @if (!empty($quote))
    <div class="{{ $block->classes }}" @if(!empty($animate)) x-data="parallaxBlockquote" @endif>
      <div class="text-container relative overflow-hidden font-serif" x-ref="blockquoteContent">
        <blockquote class="my-15 text-black lg:w-3/4 mx-auto">
          <p class="mb-0 text-1.5xl leading-1.4 font-book tracking-tight">"{!! $quote !!}"</p>
          @if (!empty($citation))
            <cite class="h4 text-2md leading-1.4 font-book font-serif mt-12.5 mb-0 block">
              {!! $citation !!}
            </cite>
          @endif
        </blockquote>
      </div>
    </div>
  @endif
@endif
