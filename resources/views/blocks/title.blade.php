@if ($block->preview)
  <x-preview :block="$block" />
@else
  <x-title 
    :title="$title"
    :logo="$logo"
    :image="$image"
    :excerpt="$excerpt"
    :button="$button"
  />
@endif
