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
                'label' => __('Featured Knowledge Hub Post', 'sage'),
                'instructions' => __(
                    'Optional. Select the main featured post (News, Blog, Report, or Case Study). ' .
                    'The next two cards are populated automatically with the latest Knowledge Hub posts. ' .
                    'Leave empty for the classic submenu layout.',
                    'sage'
                ),
                'post_type' => ['news', 'post', 'report', 'case-study'],
                'filters' => ['search', 'post_type'],
                'min' => 0,
                'max' => 1,
                'return_format' => 'object',
            ]);

        return $mainNavItemInfo->build();
    }
}
