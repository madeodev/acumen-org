@if (!empty($links))
  <ul {{ $attributes->merge(['class' => 'list-none flex gap-2']) }}>
    @foreach ($links as $link)
      @continue(empty($link['url']) || $link['url'] === '#')
      <li>
        <x-button
          :link="[...$link, 'target' => '_blank']"
          :title="$link['title']"
          color="icon-white-small"
          icon-class="w-auto"
          type="icon"
          :icon="$link['social']"
        />
      </li>
    @endforeach
  </ul>
@endif
