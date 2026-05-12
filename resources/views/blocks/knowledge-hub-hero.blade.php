@if ($block->preview)
  <x-preview :block="$block" />
@else
<section class="{{ $block->classes }} py-10 sm:py-16 relative bg-maize">
    
    <!-- Hero Header -->
    <div class="container-fluid">
      @if (!empty($heading))
        <{{$heading_primary}} class="font-bold mb-8">
          {!! $heading !!}
        </{{$heading_primary}}>
      @endif
      
      @if (!empty($subheading))
        <p class="text-xl lg:text-2xl">
          {!! $subheading !!}
        </p>
      @endif
    </div>

    <div class="knowledge-hub-hero-posts-slider-vue py-6 sm:py-16">
          <!-- Posts Slider -->
      <knowledge-hub-hero-posts-slider
        :endpoints='@json($endpoints)'
        :labels='@json($labels)'
        :post-types='@json($post_types)'
        :posts-slider-title='@json($posts_slider_title)'
      />  
    </div>
  </section>
@endif