<article {{ $attributes->merge([
    'class' => $colors->classes('wrapper'),
]) }}>

  @if (!empty($card['featured_image']))
    <{{ $element }}
      {{ $link_attrs }}
      class="block link-no-underline overflow-hidden {{ $colors->classes('image-wrapper') }}"
      aria-hidden="true"
      tabindex="-1"
    >
      <x-image
        :id="$card['featured_image']"
        :sizes="$colors->classes('sizes')"
        :class="$colors->classes('image')"
      />
    </{{ $element }}>
  @endif

  <div class="{{ $colors->classes('text-area') }}" >

    <div class="inline-flex gap-5" animate >
      @if (!empty($card['topic']) || !empty($card['term']))
        <x-topic-label
          :term="$card['term'] ?? []"
          :label="$card['topic'] ?? ''"
          :icon="$card['topic_icon'] ?? ''"
        />
      @endif

      @if (!empty($secondaryTopic))
        <x-topic-label :term="$secondaryTopic ?? []" />
      @endif
    </div>

    @if (!empty($card['title']))
      <{{ $headingTag }} class="{{ $colors->classes('title') }}" animate-text >
        <a {{ $link_attrs }}>{!! $card['title'] !!}</a>
      </{{ $headingTag }}>
    @endif

    @if (!empty($card['excerpt']) && $showExcerpt)
      <p class="{{ $colors->classes('excerpt') }}" animate-text >
        {!! $card['excerpt'] !!}
      </p>
    @endif

    @if (!empty($card['button']))
      <div animate >
        <x-button
          :link="$card['button']"
          :color="$colors->classes('button')"
          :icon="$colors->classes('button_icon')"
          aria-hidden="true"
          tabindex="-1"
        />
      </div>
    @endif
  </div>
</article>
