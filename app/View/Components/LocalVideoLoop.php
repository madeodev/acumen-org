<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LocalVideoLoop extends Component
{
    private static int $instanceCount = 0;

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

    /**.
     *
     * @var string
     */
    public $accessibleLabel;

    /**.
     *
     * @var string
     */
    public $videoId;

    /**.
     *
     * @var string
     */
    public $playAriaLabel;

    /**.
     *
     * @var string
     */
    public $pauseAriaLabel;

    /**
     * Create a new component instance.
     *
     *  @param string $placeholder - the placeholder image ID
     *  @param array $webm - a webm video file array
     *  @param array $mp4 - a mp4 video file array
     * @param bool $preload - when true, loads video on page load. Default false: loads video on x-intersect.margin.400px
     * @param string $ariaLabel - fallback label when media has no description
     * @param bool $decorative - when true and no label exists, hide video from assistive tech
     * @return void
     */
    public function __construct(
        public string $placeholder = '',
        public $webm = [],
        public $mp4 = [],
        public bool $preload = false,
        public string $ariaLabel = '',
        public bool $decorative = true,
    )
    {
        self::$instanceCount++;
        $this->videoId = 'video-' . self::$instanceCount;
        $this->thumbnail_url = empty($placeholder) ? '' : wp_get_attachment_image_url($placeholder, 'medium_large');
        $this->caption = $this->getVideoDescription($webm, $mp4);
        $this->accessibleLabel = $this->getAccessibleLabel();
        $this->playAriaLabel = __('Play video', 'video');
        $this->pauseAriaLabel = __('Pause video', 'video');
    }

    /**
     * Get the accessible label for the video
     */
    public function getAccessibleLabel(): string
    {
        if (!empty($this->caption)) {
            return strip_tags($this->caption);
        }

        if (!empty($this->ariaLabel)) {
            return strip_tags($this->ariaLabel);
        }

        return '';
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
