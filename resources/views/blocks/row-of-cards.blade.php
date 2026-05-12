<header class="{{$block->classes}} {{$colors->classes('wrapper')}} py-4 lg:py-6">

  <div class="container-fluid py-24 flex flex-col gap-12">

    <div class="self-center max-w-2xl text-center">

      @if(!empty($headline))
        <{{$heading_primary}} class="mb-6" animate-text>
          {!! $headline !!}
        </{{$heading_primary}}>
      @endif

      @if(!empty($paragraph))
        <p animate-text>
          {!! $paragraph !!}
        </p>
      @endif

    </div>

    @if(!empty($cards))
      <ul class="grid grid-cols-1 gap-10 list-none {{$card_classes}}">
        @foreach($cards as $card)
          <li class="">
            <x-card :card="$card" :heading-tag="$heading_secondary" is-link />
          </li>
        @endforeach
      </ul>
    @endif

    @if(!empty($link))
      <div animate>
        <x-button :link="$link" :color="$colors->classes('button')" class="mx-auto"/>
      </div>
    @endif

  </div>

</header>
