<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Accordion extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Accordion';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Used to reduce page length without loosing valuable in-depth content. Allow your audience to easily scan content until they find what they need.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'acumen';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'menu-alt3';

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
        return [
            'items' => get_field('items') ?? [],
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $accordion = new FieldsBuilder('accordion');

        $accordion
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addRepeater('items', [
                'label' => __('Accordion Sections', 'sage'),
                'min' => 1,
            ])
                ->addText('title', [
                    'label' => __('Title', 'sage'),
                    'instructions'  => __('Required - Recommended max characters: 50', 'sage'),
                    'required' => 1,
                ])                
                ->addWysiwyg('textarea', [
                    'label' => __('Content', 'sage'),
                    'instructions'  => __('Required', 'sage'),
                    'required' => 1,
                ])
                ->addLink('button', [
                    'label' => __('Button', 'sage'),
                ])     
            ->endRepeater();

        return $accordion->build();
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
