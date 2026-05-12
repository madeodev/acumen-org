@if (!empty($label))
  <span
    {{ $attributes->merge([
        'class' => 'inline-flex gap-1.5 items-center justify-center w-fit text-md',
    ]) }}>

    @if (!empty($icon))
      @svg($icon)
    @endif

    @if (!empty($label))
      <span>
        {!! $label !!}
      </span>
    @endif

  </span>
@endif
