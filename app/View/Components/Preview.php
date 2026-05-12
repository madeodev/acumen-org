<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Concerns\Colors;

class Preview extends Component
{
    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(object $block, string $variant = '')
    {
        $path = 'images/previews/' . $block->slug;
        $ext = '.jpg';
        $siteTheme = (new Colors)->getSiteTheme();
        $asset = asset($path . '-' . $siteTheme . $ext);

        if (!empty($variant)) {
            $asset = asset($path . '-' . $siteTheme . '-' . $variant . $ext);

            if (!file_exists($asset->path())) {
                $asset = asset($path . '-' . $variant . $ext);
            }
        }

        if (file_exists($asset->path())) {
            $image = $asset->uri();
        } else {
            $asset = asset($path . $ext);
            $image = file_exists($asset->path()) ? $asset->uri() : '';
        }

        $this->image = $image;
        $this->name = $block->name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.preview');
    }
}
