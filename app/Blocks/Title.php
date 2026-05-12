<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Fields\Partials\Button;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Title extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Title';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Displays a page title with an optional featured image, intro text and link button.';

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
    public $icon = 'align-full-width';

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = ['page'];

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
            'logo' => get_field('logo') ?? '',
            'image' => get_field('image') ?? '',
            'title' => get_field('title') ?? '',
            'excerpt' => get_field('excerpt') ?? '',
            'button' => Button::getButton(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $title = new FieldsBuilder('title');

        $title
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addImage('logo', [
                'label' => __('Logo', 'sage'),
                'instructions' => __('An svg or transparent png 120px tall', 'sage'),
                'mime_types' => 'svg, png',
                'wrapper' => ['width' => '50%'],
            ])
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'instructions' => __('1200px x 1200px', 'sage'),
                'wrapper' => ['width' => '50%'],
            ])
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'instructions' => __('Required - Max ~ 80-150 Characters', 'sage'),
                'required' => 1
            ])
            ->addTextarea('excerpt', [
                'label' => __('Introduction', 'sage'),
                'instructions' => __('~100 Characters', 'sage'),
                'rows' => 3,
            ])
            ->addFields($this->get(Button::class));

        return $title->build();
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
