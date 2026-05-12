@if ($block->preview)
  <x-preview :block="$block" />
@else
  <x-featured-posts :data="$featured_posts" />
@endif
