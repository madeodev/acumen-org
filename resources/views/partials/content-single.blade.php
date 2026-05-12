<article @php(post_class('h-entry'))>

  <x-title
    :title="$title ?? ''"
    :logo="$secondary_logo ?? ''"
    :image="$featured_image ?? ''"
    :image-position="$featured_image_position ?? 'side'"
    :image-caption="$featured_caption ?? ''"
    :video="$featured_video ?? []"
    :excerpt="$excerpt ?? ''"
    :button="$title_button ?? []"
    :datetime="$datetime ?? ''"
    :date="$date ?? ''"
    :author="$authors['list'] ?? ''"
    :taxonomies="$topics ?? []"
    :post-type="$post_type ?? ''"
  />

  @if (!empty($stats['stats']))
    <x-stats
      inner-classes="container-fluid py-15 md:py-20"
      :title="$stats['title']"
      :stats="$stats['stats']"
      :color="$stats['color'] ?? ''"
    />
  @endif

  <div class="pt-10 mb-10 gutenberg lg:pt-20 xl:pt-30 lg:mb-20 xl:mb-30">
    @php(the_content())

    @if (!empty($authors['array']))
      <aside class="flex flex-col gap-10 mt-10 text-container mb-7.5 pb-7.5">
        @if (!empty($authors['title']))
          <h2 class="h4">{!! $authors['title'] !!}</h2>
        @endif

        @foreach ($authors['array'] as $item)
          <x-author-card :data="$item" />
        @endforeach
      </aside>
    @endif
  </div>
</article>
