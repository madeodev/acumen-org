<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthorCard extends Component
{
    public string $name;
    public int $image;
    public string $bio;
    public string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->name = $data['label'] ?? '';
        $this->image = $data['image'] ?? 0;
        $this->bio = $data['description'] ?? '';
        $this->title = $data['title'] ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.author-card');
    }
}
