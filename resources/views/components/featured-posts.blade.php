<section {{ $attributes->merge(['class' => 'my-20']) }}>
  <div class="container-fluid">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 border-b border-black pb-7.5">
      @if (!empty($title))
        <h2 animate-text>{!! $title !!}</h2>
      @endif

      @if (!empty($intro))
        <p animate-text class="h3 lg:pt-2">{!! $intro !!}</p>
      @endif
    </div>

    @if (!empty($large) || !empty($list))
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 my-20">
        @if (!empty($large))
          <x-card
            :card="$large"
            :is-link="true"
            :secondary-topic="$large['secondary_term'] ?? []"
            color="large"
          />
        @endif

        @if (!empty($list))
          <div>
            @foreach ($list as $item)
              <x-card
                color="list"
                :card="$item"
                :is-link="true"
                :show-excerpt="false"
              />
            @endforeach
          </div>
        @endif
      </div>
    @endif

    @if (!empty($button))
      <div class="text-center" animate>
        <x-button :link="$button" />
      </div>
    @endif
  </div>
</section>
