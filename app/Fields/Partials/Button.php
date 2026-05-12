<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Button extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $button = new FieldsBuilder('button');

        $button
            ->addSelect('button_type', [
                'label' => __('Button Type', 'sage'),
                'choices' => [
                    'link' => __('Link', 'sage'),
                    'download' => __('Download', 'sage'),
                ],
                'default_value' => 'link',
                'wrapper' => ['width' => '33%'],
            ])
            ->addLink('button_link', [
                'label' => __('Link', 'sage'),
                'wrapper' => ['width' => '67%'],
            ])
                ->conditional('button_type', '==', 'link')
            

            ->addText('button_label', [
                'label' => __('Button Label', 'sage'),
                'wrapper' => ['width' => '34%'],
            ])
                ->conditional('button_type', '==', 'download')

            ->addFile('button_file', [
                'label' => __('File', 'sage'),
                'wrapper' => ['width' => '33%'],
            ])
                ->conditional('button_type', '==', 'download');

        return $button;
    }

    public static function getButton(){
        $type = get_field('button_type') ?? 'link';
        switch ($type) {
            case 'link':
                return get_field('button_link') ?: [];
                break;
            
            case 'download':
                $link = get_field('button_file') ?? [];
                $title = get_field('button_label') ?? '';
                if(!empty($title)){
                    $link['title'] = $title;
                }
                return $link;
                break;
            
            default: 
                return [];
                break;
        }
    }
}
