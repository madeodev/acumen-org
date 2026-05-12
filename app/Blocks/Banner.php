<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use App\Fields\Partials\ButtonOrModal;
use App\Fields\Partials\ModuleBackground;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Banner extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Banner';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Displays large headline and optional call to action button. Offers visual interest with a large background image or solid color.';

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
        $banner = new FieldsBuilder('banner');

        $banner
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addFields($this->get(ModuleBackground::class))
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'instructions' => __('Required. Please limit to 80 characters.', 'sage')
            ])
            ->addText('introduction', [
                'label' => __('Introduction', 'sage'),
                'instructions' => __('Optional. Please use a minimum of 100 characters.', 'sage'),
            ])
            ->addFields($this->get(ButtonOrModal::class));

        return $banner->build();
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
