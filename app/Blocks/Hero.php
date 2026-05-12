<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Fields\Partials\ButtonOrModal;
use App\Fields\Partials\ModuleBackground;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Video;

class Hero extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hero';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Displays page title with an optional excerpt and button. Can be used on any page. It is recommended to only use this module at the top of a page.';

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
    public $icon = 'cover-image';

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
        'multiple' => false,
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
            'title' => get_field('title') ?? '',
            'intro' => get_field('introduction') ?? '',
            ...ButtonOrModal::getFields(),
            ...ModuleBackground::getFields(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $hero = new FieldsBuilder('hero');

        $hero
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addFields($this->get(ModuleBackground::class))
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'required' => 1,
                'instructions' => __('Required. Please limit to 80 characters.', 'sage')
            ])
            ->addText('introduction', [
                'label' => __('Introduction', 'sage'),
                'instructions' => __('Optional. Please use a minimum of 100 characters.', 'sage'),
            ])
            ->addFields($this->get(ButtonOrModal::class));

        return $hero->build();
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
