<{!! $element !!} {{ $attributes->merge([
    'class' => $colors->classes('outer'),
    ...$link_attrs,
]) }}>

  @if (!empty($icon))
    @svg('images.' . $icon, $icon_class)
  @endif

  <span class="relative z-5 {{ $type === 'icon' ? 'sr-only' : '' }}">
    {!! $slot->isNotEmpty() ? $slot : $title !!}
  </span>

  </{!! $element !!}>
