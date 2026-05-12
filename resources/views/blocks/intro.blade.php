<header class="{{$block->classes}} {{$colors->classes('wrapper')}} py-4 lg:py-6">

  <div class="container-fluid flex flex-col gap-10 lg:flex-row">

    @if(!empty($image))
      <x-image :id="$image" class="aspect-square object-cover w-full lg:!max-w-lg xl:!max-w-xl lg:order-2" />
    @endif

    <div class="{{$image_condition_class}} self-center max-w-2xl">

      @if(!empty($headline))
        <h1 animate-text>
          {!! $headline !!}
        </h1>
      @endif

      @if(!empty($paragraph))
        <p animate-text>
          {!! $paragraph !!}
        </p>
      @endif

      @if(!empty($link))
        <div animate>
          <x-button :link="$link" :color="$colors->classes('button')"/>
        </div>
      @endif

    </div>

  </div>

</header>
