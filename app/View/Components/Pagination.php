<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    public $links;
    public $hasNext;
    public $hasPrev;
    public $style = "border rounded-full flex items-center justify-center text-md font-medium h-10 min-w-10 select-none";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $queryModel)
    {
        $this->links = $this->getLinks();
        $this->hasNext = $this->next();
        $this->hasPrev = $this->prev();

    }

    public function prev() : bool {
        if ($this->queryModel['total_posts'] == 0) return false;
        if ($this->queryModel['current_page'] == 1) return false;
        return true;
    }

    public function next() : bool {
        if ($this->queryModel['total_posts'] == 0) return false;
        if ($this->queryModel['current_page'] == $this->queryModel['max_pages']) return false;
        return true;
    }

    public function getLinks()  {

        if ($this->queryModel['total_posts'] == 0) return [];

        $total = $this->queryModel['max_pages'];
        if($total == 1) return [];

        $current = $this->queryModel['current_page'];
        $links = [];
        
        if($current <= 4){
            $links = range(1, max(1, $current));
        }
        else{
            $links = [1, '...', $current - 1, $current];
        }

        if($current < $total - 3){
            $links = [...$links, $current + 1, '...', $total];
        }
        elseif($current !== $total){
            $links = [...$links, ...range($current + 1, $total)];
        }

        return collect($links)->map(function($link, $key) use ($current) {
            $arr = [
                'num' => $link,
            ];
            if($link === $current) {
                $arr['current'] = true;
            }
            elseif(is_int($link)) {
                $arr['url'] = get_pagenum_link($link);
            }
            return $arr;
        })->toArray();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}
