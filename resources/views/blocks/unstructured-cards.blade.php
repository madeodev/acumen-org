@if ($block->preview)
    <x-preview :block="$block" />
@else
    @if (!empty($cards))
        <section class="{{ $block->classes }} container-fluid">
            <div class="{{ $divider }} py-5 md:py-20 grid grid-cols-1 {{ $grid_classes }} gap-5 md:gap-20">
                @foreach ($cards as $card)
                    <x-card 
                        :card="$card"
                        :heading-tag="$heading_primary"
                        :color="$card_style"
                        is-link
                    />
                @endforeach
            </div>
        </section>
    @endif
@endif
