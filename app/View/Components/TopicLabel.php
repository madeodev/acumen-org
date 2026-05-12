<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TopicLabel extends Component
{
    public string $icon;
    public string $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $label = '',
        string $icon = '',
        array $term = []
    )
    {
        $this->label = $this->theLabel($label, $term);
        $this->icon = $this->theIcon($term, $icon);
    }

    function theLabel($label, $term)
    {
        if(!empty($label)) return $label;
        if(!empty($term['label'])) return $term['label'];
        return '';
    }

    function theIcon($term, $icon){
        if(!empty($icon)) return "images.tax-icons.$icon";
        return $term['icon'] ?? '';
    }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.topic-label');
    }
}
