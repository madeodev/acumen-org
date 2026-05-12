<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Concerns\Video;
use App\Concerns\Colors\ButtonColors;

class ModalVideo extends Component
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $src;

    /**
     * @var string
     */
    public $button_class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $modal)
    {
        $this->id = $modal['id'] ?? null;
        $this->src = !empty($modal['video']) ? (new Video)->getVideoSrc($modal['video'], [
            'autoplay' => true,
        ]) : null;
        $this->button_class = (new ButtonColors('icon-white'))->classes();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-video');
    }
}
