<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\Form as FormField;
use App\Concerns\GravityForms;

class Form extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Form';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Default form display. Forms can be created for a variety of uses and embedded directly into a page.';

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
    public $icon = 'forms';

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
            'form' => GravityForms::getFormForDisplay(get_field('form_id') ?? ''),
            'image' => get_field('image') ?? null,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $form = new FieldsBuilder('form');

        $form
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('title', [
                'label' => __('Title', 'sage'),
                'instructions' => __('It is recommended to use up to 50 characters.', 'sage'),
                'required' => true,
            ])
            ->addText('introduction', [
                'label' => __('Introduction', 'sage'),
                'instructions' => __('It is recommended to use up to 250 characters.', 'sage')
            ])
            ->addFields($this->get(FormField::class))
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'instructions' => __('It is recommended to use an image with at least 480 pixels in width. The height of the image will depend on the length of the form.', 'sage'),
                'required' => true,
            ]);

        return $form->build();
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
