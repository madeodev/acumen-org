@if(!empty($mp4) || !empty($webm))


    <figure
        x-data="localVideo({{$preload}})"
        x-intersect.margin.400px.once="load"
        x-intersect:enter="videoIsVisible"
        x-intersect:leave="videoIsNotVisible"
        class="absolute inset-0 w-full h-full"
    >
        <video 
            autoplay muted loop playsinline 
            x-ref="video"
            id="{{ $videoId }}"
            class="absolute inset-0 overflow-hidden h-full w-full object-cover"
            @if(!empty($thumbnail_url))
                poster="{{$thumbnail_url}}"
            @endif
            @if(!empty($accessibleLabel))
                aria-label="{{ e($accessibleLabel) }}"
            @elseif($decorative)
                aria-hidden="true"
                role="presentation"
            @endif
        >
            {{-- WEBM file --}}
            @if(!empty($webm['url']))
                <source 
                    @if($preload)
                        src="{{$webm['url']}}" 
                    @else
                        :src="src('{{$webm['url']}}')"
                    @endif
                    type="video/webm"
                >
            @endif

            {{-- MP4 file --}}
            @if(!empty($mp4['url']))
                <source 
                    @if($preload)
                        src="{{$mp4['url']}}" 
                    @else
                        :src="src('{{$mp4['url']}}')"
                    @endif
                    type="video/mp4"
                >
            @endif

            {{-- Fallback image if <video> tag unsupported --}}
            <x-image :id="$placeholder" />

        </video>

        @if(!empty($caption))
            <figcaption class="sr-only">
                {!! $caption !!}
            </figcaption>
        @endif

        <button
            type="button"
            class="absolute inset-0 focus-visible:-outline-offset-4 focus-visible:outline-white w-full"
            @click="playPause()"
            aria-controls="{{ $videoId }}"
            aria-pressed="{{ $preload ? 'true' : 'false' }}"
            aria-label="{{ e($preload ? $pauseAriaLabel : $playAriaLabel) }}"
            :aria-pressed="isPlaying"
            :aria-label="isPlaying ? @json($pauseAriaLabel) : @json($playAriaLabel)"
            :title="isPlaying ?
                '{!! __('Click to pause video', 'video') !!}' :
                '{!! __('Click to play video', 'video') !!}'"
        >
        </button>
    </figure>


@endif