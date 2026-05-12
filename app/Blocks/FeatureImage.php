<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FeatureImage extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Feature Image';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Show an image that animates as it enters the screen.';

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
    public $icon = 'format-image';

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
        $image = get_field('image') ?? [];
        return [
            'image' => !empty($image) ? [
                'id' => $image,
                'caption' => wp_get_attachment_caption($image),
            ] : [],
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $featureImage = new FieldsBuilder('feature_image');

        $featureImage
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addImage('image', [
                'label' => 'Image',
            ]);

        return $featureImage->build();
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
