<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MainNavItemInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $mainNavItemInfo = new FieldsBuilder('main_nav_item_info');

        $mainNavItemInfo
            ->setLocation('nav_menu_item', '==', 'location/main_navigation');

        $mainNavItemInfo
            ->addTextarea('description', [
                'label' => __('Description', 'sage'),
            ])
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'instructions' => __('For submenu items only')
            ])
            ->addText('featured_heading', [
                'label' => __('Featured Heading', 'sage'),
                'instructions' => __('Heading shown above the featured posts in the Knowledge Hub submenu.', 'sage'),
                'default_value' => __('Featured', 'sage'),
            ])
            ->addRelationship('featured_posts', [
                'label' => __('Featured Knowledge Hub Posts', 'sage'),
                'instructions' => __(
                    'Optional. Select exactly 3 posts (News, Blog, Report, Case Study). First = large card (image + description). Next two = title only. Leave empty for the classic submenu layout.',
                    'sage'
                ),
                'post_type' => ['news', 'post', 'report', 'case-study'],
                'filters' => ['search', 'post_type'],
                'min' => 0,
                'max' => 3,
                'return_format' => 'object',
            ]);

        return $mainNavItemInfo->build();
    }
}
