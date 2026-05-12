@if(!empty($id))
    <div {{ $attributes->merge() }} parallax >
        <x-image 
            :id="$id" 
            :size="$size" 
            :class="$imageClass . ' scale-125 origin-bottom'" 
            :sizes="$sizes" 
        />
    </div>
@endif