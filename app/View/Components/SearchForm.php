<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchForm extends Component
{
    public string $search_query;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $ref = ''
    )
    {
        $this->search_query = get_search_query();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-form');
    }
}
