<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Concerns\InteractsWithMenus;

class SocialMedia extends Component
{
    /**
     * @var array
     */
    public $links;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(InteractsWithMenus $menus)
    {
        $this->links = $menus->socialNavigation();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.social-media');
    }
}
