@if ($block->preview)
  <x-preview :block="$block" />
@else
  <section class="{{ $block->classes }} text-container my-15">
    <div class="{{$colors->classes('wrapper')}} px-5 md:px-20 py-15 md:pt-20 md:pb-25 flex flex-col gap-12.5">
      @if(!empty($text))
        <h2 animate-text>
          {!! $text !!}
        </h2>
      @endif
      @if(!empty($button))
        <div animate>
          <x-button :link="$button" color="link" icon="arrow-right" class="border-white" /> 
        </div>
      @endif
    </div>
  </section>
@endif
