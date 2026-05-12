<section class="{{ $block->classes }} {{$colors->classes('wrapper')}}">
  <div class="container-fluid py-10 lg:pt-24 lg:pb-16 lg:px-48">
    {{-- Headline --}}
    @if(!empty($heading))
      <div class="pb-11 lg:pb-16 text-center lg:text-left">
        <{{$heading_primary}} animate-text class="font-normal text-4xl lg:text-5xl">{!! $heading !!}</{{$heading_primary}}>
      </div>
    @endif

    {{-- Repeater - Numbers - Single headline and description --}}
    @if(!empty($stats))
      <div class="flex flex-wrap">
        @foreach ($stats as $stat)
          {{-- Single stat container --}}
          <div class="pt-10 first:pt-0 lg:pt-0 lg:pb-10 w-full lg:w-1/2">
            {{-- Single stat heading --}}
            @if(!empty($stat['stat_heading']))
              <{{$heading_secondary}} class="font-bold text-4xl text-center lg:text-left" animate-text>
                {!! $stat['stat_heading'] !!}
              </{{$heading_secondary}}>
            @endif

            {{-- Single stat description --}}
            @if(!empty($stat['stat_description']))
              <p class="leading-8 text-2xl font-light text-center mx-auto lg:mx-0 lg:text-left lg:pt-7 max-w-[550px] lg:max-w-[85%] opacity-60" animate-text> 
                {!! $stat['stat_description'] !!}
              </p>
            @endif
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
