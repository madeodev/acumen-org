<form 
    role="search" 
    action="{{ esc_url( home_url( '/' ) ) }}"
    method="get"
    class="relative w-125 max-w-full" 
>
<label>
    <span class="sr-only">
        {!! __( 'Search for:', 'header' ) !!}
    </span>
    <input 
        x-ref="{{$ref}}" 
        class="bg-transparent text-white placeholder:text-white w-full border border-white py-4 pl-6 pr-16 rounded-full"
        type="search" 
        name="s" 
        value="{{ $search_query }}"
        placeholder="{!! __('What can we help you find...', 'header') !!}"
    >
</label>
<x-button 
    @click="toggleMenu('desktop-search')" 
    element="button" 
    type="submit"
    icon="search" 
    color="icon-search" 
    aria-label="{!! __('Search', 'header') !!}" 
    x-bind:aria-expanded="isOpen('desktop-search')"
/>
</form>