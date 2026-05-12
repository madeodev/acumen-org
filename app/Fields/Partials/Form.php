<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

use App\Concerns\GravityForms;

class Form extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $form = new FieldsBuilder('form');
        $formOptions = (new GravityForms)->getFormOptions();

        if (empty($formOptions)) {
            $form->addMessage('missing_forms', '', [
                'label' => __('Missing Gravity Forms', 'sage'),
                'message' => __('It looks like Gravity Forms is not activated, or there are no forms to choose from. Please make sure to activate the plugin in the Plugins page to use this module, and that there are forms available.', 'sage')
            ]);
        } else {
            $form->addSelect('form_id', [
                'label' => __('Form', 'sage')
            ])
                ->addChoices($formOptions);
        }

        return $form;
    }
}
