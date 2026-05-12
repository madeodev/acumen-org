<?php

namespace App\View\Components;

use App\Concerns\Colors\ButtonColors;
use Roots\Acorn\View\Component;

class Button extends Component
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var object
     */
    public $colors;

    /**
     * @var array
     */
    public $link_attrs;


    /**
     * @var string
     */
    public $icon_class;


    /**
     * Create a new button component instance.
     *
     * Usage Examples:
     *
     * -- as a link --
     * <x-button :link="$link" color="blue" icon="icons.arrow" icon-class="h-4 w-4" />
     *
     * -- as a button --
     * <x-button element="button" @click="clickButton" >
     *   Click here
     * </x-button>
     *
     * @param string $element a|button (optional - default 'a') specify element="button" to render a button elem vs link
     * @param array $link (optional) a link in WordPress link format. Omit if using component as a 'button' element
     * @param string $color (optional - default 'black') a color value defined in Concerns\Colors\ButtonColors. This can be a string or an array with 'outer' and 'icon-classes'.
     * @param string $icon (optional) specify an icon in the images folder
     * @param string $iconClass (optional) classes to add to the icon (reference arg name in kebab-case in the view 'icon-class'). Alternately include an 'icon-class' key in ColorValues
     * @param string $type set this to 'icon' to make the button title screen reader only
     * @param bool $externalGetsIconNewTab - set 'external-gets-icon-new-tab' on a button to force external links to have an arrow icon and open in new tabs
     *
     * @return void
     */
    public function __construct(
        public string $element = 'a',
        array $link = [],
        string $color = 'outline-black',
        public string $icon = '',
        string $iconClass = '',
        public string $type = '',
        public bool $externalGetsIconNewTab = false,
    ) {
        $this->title = $link['title'] ?? '';
        $this->link_attrs = $this->getLinkAttrs($link);
        $this->colors = (new ButtonColors( $color ?? ''));
        $this->icon_class = $this->iconClass($iconClass); 

        $this->setIcon();
    }

    private function setIcon()
    {

        // use 'arrow-outward' if target = _blank and no icon set
        if (
            empty($this->icon) && 
            !empty($this->link_attrs['target']) && 
            $this->link_attrs['target'] === '_blank'
        ) {
            $this->icon = 'arrow-outward';
        }

        // use 'arrow-outward' if externalGetsIconNewTab option is true and it's an external link and no icon is set
        if (
            empty($this->icon) && 
            $this->externalGetsIconNewTab && 
            $this->isExternalLink($this->link_attrs['url'] ?? '')
        ) {
            $this->icon = 'arrow-outward';
        }

        // if there's a download attr set download icon
        if(!empty($this->link_attrs['download'])){
            $this->icon = 'lab-profile';
        }
    }

    private function iconClass($icon_class) {
        $default = 'w-3.5 h-auto flex-shrink-0 relative z-5';
        if (!empty($icon_class)) return $icon_class .' '. $default;
        if(!empty($this->colors->hasSection('icon-class'))) return $this->colors->classes('icon-class');
        return $default;
    }

    /**
     * Get the link attributes
     */
    public function getLinkAttrs(array $link = []) : array
    {
        if($this->element !== 'a' || empty($link)) {
            return [];
        }

        $attrs = [
            'href' => $link['url'] ?? '',
            'target' => empty($link['target']) ? '_self' : $link['target'],
        ];

        if ($this->externalGetsIconNewTab && $this->isExternalLink($link['url'] ?? '')){
            $attrs['target'] = '_blank';
        }

        if(!empty($link['filename'])){
            $attrs['download'] = $link['filename'];
        }

        return $attrs;
    }

    public function isExternalLink($url) : bool
    {
        $link = parse_url($url);
        return !empty($link['host']) && strcasecmp($link['host'], $_SERVER['HTTP_HOST']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
