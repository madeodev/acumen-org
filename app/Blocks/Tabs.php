<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Fields\Partials\ImageOrVideo;
use App\Fields\Partials\DividerOptions;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tabs extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Tabs';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display 1-4 tabbed headlines with supporting text, link and image. This is useful to display compact content for text heavy topics.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'bw-blox';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'table-col-after';

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'edit';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => false,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        $tabs = $this->getTabs();

        return [
            'tabs' => $tabs,
            'tab_count' => count($tabs),
            'image_alignment' => get_field('image_alignment') ?? 'right',
            'divider_classes' => DividerOptions::getClasses(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $tabs = new FieldsBuilder('tabs');

        $tabs
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addMessage('heading_notice', '', [
                'label' => __('Heading', 'sage'),
                'message' => __('Please always preced this module by a block that provides a heading for all the tabs.', 'sage'),
            ])
            ->addButtonGroup('image_alignment', [
                'label' => __('Image Alignment', 'sage'),
                'instructions' => __('Select where to align the image.', 'sage'),
                'default_value' => 'right',
                'choices' => [
                    'left' => __('Left', 'sage'),
                    'right' => __('Right', 'sage'),
                ]
            ])
            ->addRepeater('tabs', [
                'label' => __('Tabs', 'sage'),
                'min' => 1,
                'max' => 4,
            ])
                ->addMessage('tabs_title', '', AcfUtils::repeaterTitle('Tab'))
                ->addText('label', [
                    'label' => __('Tab Label', 'sage'),
                    'instructions'  => __('Required. It is recommended to limit the number of characters to 30.', 'sage'),
                    'required' => 1,
                    'wrapper' => [ 'width' => '70%', ],
                ])
                ->addLink('button', [
                    'label' => __('Tab Button', 'sage'),
                    'instructions' => __('Optional. Please limit the button label to 20 characters.', 'sage'),
                    'wrapper' => [ 'width' => '30%', ],
                ])
                ->addTextArea('content', [
                    'label' => __('Tab Content', 'sage'),
                    'instructions'  => __('Optional', 'sage'),
                    'required' => 1,
                    'instructions'  => __('Required. It is recommended to limit the number of characters to 125.', 'sage'),
                    'wrapper' => [ 'width' => '70%', ],
                ])
                ->addFields($this->get(ImageOrVideo::class))
            ->endRepeater()
            ->addAccordion('block_settings', [
                'label' => __('Block Settings', 'sage')
            ])
                ->addFields($this->get(DividerOptions::class))
            ->addAccordion('end_block_settings')->endPoint();

        return $tabs->build();
    }

    private function getTabs()
    {
        $tabs = get_field('tabs') ?? [];

        if (empty($tabs)) {
            return [];
        }

        return collect($tabs)->map(function ($tab) {
            $tab[] = ImageOrVideo::getFields();
            return $tab;
        })->toArray();
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }
}
