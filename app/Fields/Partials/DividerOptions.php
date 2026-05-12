<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class DividerOptions extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $dividerOptions = new FieldsBuilder('divider_options');

        $dividerOptions
            ->addSelect('divider', [
                'label' => __('Show Divider', 'sage'),
                'choices' => [
                    'top' => __('Top', 'sage'),
                    'bottom' => __('Bottom', 'sage'),
                    'both' => __('Top and Bottom', 'sage'),
                    'none' => __('None', 'sage'),
                ],
                'default_value' => 'none',
                'wrapper' => ['width' => '50%'],
            ]);

        return $dividerOptions;
    }

    public static function getClasses() {
        $divider = get_field('divider') ?? '';
        switch ($divider) {
            case 'top':
                return 'border-t';
                break;
            
            case 'bottom':
                return 'border-b';
                break;

            case 'both':
                return 'border-t border-b';
                break;
            
            default:
                return '';
                break;
        }
    }
}
