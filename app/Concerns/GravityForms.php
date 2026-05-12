<?php

namespace App\Concerns;

use GFAPI;

class GravityForms
{
    protected $forms;

    public function __construct()
    {
        if (!class_exists('GFAPI')) {
            return;
        }

        $this->forms = once(function () {
            return GFAPI::get_forms();
        });
    }

    public function getFormOptions()
    {
        if (!class_exists('GFAPI')) {
            return;
        }

        if (empty($this->forms)) {
            return;
        }

        return once(function () {
            return collect($this->forms)
                ->filter(function($form){
                    return !empty($form);
                })
                ->mapWithKeys(function ($form) {
                    return [$form['id'] => $form['title']];
                })
                ->toArray();
        });
    }

    public static function getFormForDisplay(string $id)
    {
        if (empty($id) || !function_exists('gravity_form')) {
            return;
        }

        return gravity_form($id, false, false, false, null, true, null, false, null, false);
    }

    /**
     * parse form HTML using DOMDocument and move the 'gform_required_legend' element to the end of the form
     * 
     * @param string $formHTML
     */
    public static function moveRequiredLegendToEnd($formHTML)
    {
        return $formHTML;
    }
}
