<?php

namespace App\View\Components;

use App\Concerns\Colors\CardColors;
use Illuminate\View\Component;

class Card extends Component
{

    public $colors;
    public $element;
    public $button_element;
    public $link_attrs;

    /**
     * Create a new component instance.
     *
     * @param array $card an array with keys for 'featured_image' (image ID), 'title', 'excerpt', 'link' (url), 'button' (link array). All keys optional.
     * @param string $headingTag the tag for the card heading (reference arg name in kebab-case in the view 'heading-tag')
     * @param bool $isLink pass this param (in kebab-case 'is-link') if whole card is to be a link. Card link will use $card['link'] if present with a fallback to $card['button']
     * @param string $color a color value key from CardColors
     *
     * @return void
     */
    public function __construct(
        public array $card,
        public string $headingTag = 'h3',
        bool $isLink = false,
        string $color = '',
        public array $secondaryTopic = [],
        public bool $showExcerpt = true,
    ) {
        $link_attrs = $this->getLinkAttrs($isLink);
        $this->link_attrs = $link_attrs;
        $this->element = !empty($link_attrs) ? 'a' : 'div';
        $this->button_element = empty($link_attrs) ? 'a' : 'span';
        $this->colors = new CardColors($color);
    }

    /**
     * Get the link attributes
     */
    public function getLinkAttrs(bool $is_link) : string
    {
        if (!$is_link) {
            return '';
        }

        $card = $this->card;
        $attr = [];

        if (!empty($card['link'])) {
            $attr = [
                'href' => $card['link']
            ];
        } elseif (!empty($card['button']['url'])) {
            $attr = [
                'href' => $card['button']['url'],
                'target' => !empty($card['button']['target']) ? $card['button']['target'] : '_self',
            ];
        };

        if (!empty($attr)) {
            return collect($attr)->map(function ($val, $key) {
                return $key . '=' . $val;
            })->join(' ');
        }

        return '';

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
