@if ($block->preview)
  <x-preview :block="$block" />
@else
  <x-featured-posts
    :class="$block->classes"
    :data="$data"
  />
@endif
