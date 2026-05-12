<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LocalVideoLoop extends Component
{
    /**.
     *
     * @var string
     */
    public $thumbnail_url;

    /**.
     *
     * @var string
     */
    public $caption;

    /**
     * Create a new component instance.
     *
     *  @param string $placeholder - the placeholder image ID
     *  @param array $webm - a webm video file array
     *  @param array $mp4 - a mp4 video file array
     * @param bool $preload - when true, loads video on page load. Default false: loads video on x-intersect.margin.400px
     * @return void
     */
    public function __construct(
        public string $placeholder = '',
        public $webm = [],
        public $mp4 = [],
        public bool $preload = false,
    )
    {
        $this->thumbnail_url = empty($placeholder) ? '' : wp_get_attachment_image_url($placeholder, 'medium_large');
        $this->caption = $this->getVideoDescription($webm, $mp4);
    }

    /**
     * Get the description of the video
     */
    public function getVideoDescription($webm, $mp4) :string
    {   
        if(!empty($webm['description'])){
            return $webm['description'];
        }

        if(!empty($mp4['description'])){
            return $mp4['description'];
        }

        return '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.local-video-loop');
    }
}
