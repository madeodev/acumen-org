@if(!empty($links))
    <nav class="flex justify-between gap-2.5 max-w-full my-5 md:my-15" aria-label="{!! __('Pagination', 'pagination') !!}">
        @if(!empty($hasPrev))
            <a href="{{get_previous_posts_page_link()}}" class="{{$style}} px-3.5 hover:bg-white/20">
                {!! __('Previous', 'pagination') !!}
            </a>
        @endif
        <ul class="hidden sm:flex mx-auto gap-2.5 flex-wrap justify-center" aria-label="{!!__('Page links', 'pagination')!!}">
            @foreach ($links as $link)
                <li>
                    @if(!empty($link['url']))
                        <a class="{{ $style }} hover:bg-white/20" href="{{ $link['url'] }}" aria-label="{!!__('Go to page: ', 'pagination')!!} {{$link['num']}}">
                            {!! $link['num'] !!}
                        </a>                    
                    @elseif(!empty($link['current']))
                        <div class="{{ $style }} bg-white text-black h-full w-full" aria-current="true" aria-label="{!!__('Page: ', 'pagination')!!} {{$link['num']}}">
                            {!! $link['num'] !!}
                        </div>
                    @else
                        <div class="{{ $style }}">
                            {!! $link['num'] !!}
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
        @if(!empty($hasNext))
            <a href="{{get_next_posts_page_link()}}" class="{{$style}} px-3.5 hover:bg-white/20">
                {!! __('Next', 'pagination') !!}
            </a>
        @endif
    </nav>
@endif