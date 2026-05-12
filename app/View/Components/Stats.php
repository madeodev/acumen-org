<?php

namespace App\View\Components;

use App\Concerns\Colors\ColorwaysDark;
use Illuminate\View\Component;

class Stats extends Component
{
    public array $stats;
    public int $count;
    public string $style;
    public string $wrapper_classes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $title,
        array $stats,
        public string $innerClasses = '',
        string $color = '',
    )
    {
        $this->stats = $this->getStats($stats);
        $this->count = count($this->stats);
        $this->style = count($this->stats) == 4 ? 'basis-1/2 md:basis-1/4' : '';
        $this->wrapper_classes = $color ? (new ColorwaysDark($color))->classes('wrapper') : '';
    }

    public function getStats($stats) : array {
        return collect($stats)->filter(function($stat){
            return !empty($stat['stat']);
        })->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stats');
    }
}
