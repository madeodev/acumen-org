<div 
    class="pb-7.5 bg-amethyst text-white transition-all" 
    :class="isButton ? '-mt-24 pt-24' : 'pt-2'"
    x-collapse
    x-show="isOpen('{{$loop->iteration}}')"
    @focusout="handleFocusOut('button{{$loop->iteration}}')"
    @click.outside="clickOutside({{$loop->iteration}})"
  >
    <div class="container-fluid flex flex-col gap-5" x-data="{ open: null }" x-id="['child-description']">
        {{-- Column 1 --}}
        <div class="flex flex-col gap-5">
            @if(!empty($item['description']))
                <p class="m-0">
                    {!! $item['description'] !!}
                </p>
            @endif
            @if(!empty($item['url']) && $item['url'] !== '#')
                <x-button :link="$item" type="icon" icon="arrow-right" color="icon-white" />
            @endif
        </div>
        {{-- Column 2 --}}
        <ul>
            @foreach ($item['children'] as $child)
                <li>
                    <x-button 
                        :link="$child" 
                        color="subnav-mobile" 
                        icon="arrow-right"
                    />
                </li>
            @endforeach
        </ul>
    </div>

</div>
