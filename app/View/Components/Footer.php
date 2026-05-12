<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Concerns\InteractsWithMenus;
use App\Concerns\GravityForms;
use App\Providers\MenuServiceProvider;

class Footer extends Component
{
    /**
     * @var array
     */
    public $nav;

    /**
     * @var array
     */
    public $utility;

    /**
     * @var array
     */
    public $newsletter;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(InteractsWithMenus $menus)
    {
        $nav_settings = $menus->getMenuSettings(MenuServiceProvider::FOOTER_NAVIGATION);

        $this->nav = $menus->footerNavigation();
        $this->utility = $menus->footerUtilityNavigation();
        $this->newsletter = [
            'heading' => $nav_settings['heading'] ?? '',
            'form' => GravityForms::getFormForDisplay($nav_settings['form_id'] ?? ''),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
