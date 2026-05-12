<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Title extends Component
{
    public string $date;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $logo = '',
        public string $title = '',
        public string $excerpt = '',
        public string $image = '',
        public string $datetime = '',
        public string $author = '',
        public array $button = [],
        public string $buttonIcon = '',
        public array $taxonomies = [],
        public string $imagePosition = 'side',
        public string $imageCaption = '',
        public array $video = [],
        string $postType = '',
        string $date = '',
    )
    {
        $this->date = $this->getDate($postType, $date);
    }

    public function getDate($post_type, $date){
        if (empty($post_type)) return $date;
        if ($post_type == 'post' || $post_type == 'news') return $date;
        return '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.title');
    }
}
