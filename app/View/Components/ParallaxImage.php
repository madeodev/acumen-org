<?php

namespace App\View\Components;
use Illuminate\View\Component;

class ParallaxImage extends Component
{
    /**
     * This is a wrapper around the image component
     *
     * @return void
     */
    public function __construct(
        public string $id,
        public string $size = 'large',
        public string $imageClass = 'object-cover w-full h-full',
        public string|array $sizes = '100vw',
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.parallax-image');
    }
}
