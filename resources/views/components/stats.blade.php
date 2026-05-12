<div {{ $attributes->merge(['class' => $wrapper_classes]) }}>
    <div class="{{$innerClasses}}">

        @if(!empty($title))
            <h2 class="mb-10 md:mb-15" animate-text>
                {!! $title !!}
            </h2>
        @endif

        @if(!empty($stats))
            <div
                x-data="stats"
                class="flex flex-wrap justify-between -mx-5 lg:-mx-10 gap-y-5 md:gap-y-10"
            >
                @foreach ($stats as $stat)
                    @continue(empty($stat['stat']))
                    @if($count == 4 && $loop->iteration == 3)
                        <div class="flex justify-between flex-wrap xl:flex-nowrap flex-1 basis-1/2 gap-y-5 md:gap-y-10">
                    @endif
                        <figure class="px-5 md:px-10 flex-1 max-w-sm md:max-w-none {{$style}}">
                            <div 
                                aria-label="{{$stat['stat']}}"
                                x-html="getStatHTML('{{$stat['stat']}}')"
                                x-intersect.full="animateNumber($el)"
                                @resize.window.throttle="unsetWidth($el)"
                                class="h-20 md:h-30 overflow-hidden flex relative items-center font-display text-5.5xl font-medium leading-extra-tight tracking-tight md:text-8xl md:font-bold">
                            </div>

                            @if(!empty($stat['description']))
                                <figcaption class="md:text-lg">
                                    {!! $stat['description'] !!}
                                </figcaption>
                            @endif
                        </figure>
                    @if($loop->iteration == 4)
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>