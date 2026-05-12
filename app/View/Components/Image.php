<?php

namespace App\View\Components;

use App\Concerns\GetsFocalPoint;
use Illuminate\View\Component;
use App\Concerns\Image as ImageConcern;

class Image extends Component
{
    /**
     * The image focal point
     */
    public string $focal_point;

    /**
     * The srcset sizes attr
     */
    public string $sizes;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string $size (optional)
     * @param string $class (optional)
     * @param string|array $sizes -
     * Pass a string to use your own sizes value
     * Or an array like this:
     * [
     *  'DEFAULT' => '50vw',
     *  'sm' => '1/2',
     *  'lg' => '12rem',
     *  'xl' => 'container',
     * ]
     * Values in fraction format represent fraction of the container.
     * Other values represent the image size at that breakpoint.
     * Use 'container' to specify 100% of container width.
     * Values apply to the assigned size and above until a larger size is defined.
     * Omit 'DEFAULT' to default to container size.
     *
     * @return void
     */
    public function __construct(
        public string $id,
        public string $size = 'large',
        public string $class = 'object-cover w-full h-full',
        string|array $sizes = 'container',
    ) {
        $this->focal_point = GetsFocalPoint::focal_point($id);
        $this->sizes = ImageConcern::getScrsetSizes($sizes);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image');
    }
}
