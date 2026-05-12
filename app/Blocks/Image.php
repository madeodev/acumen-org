<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Image extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Image';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Show one or more images with optional captions.';

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
    public $icon = 'format-gallery';

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
        $images = $this->images();
        return [
            'images' => $images,
            'count' => count($images),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $image = new FieldsBuilder('image');

        $image
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addGallery('images', [
                'label' => __('Images', 'sage'),
                'instructions' => __('If multiple images are selected they will be cropped to a square aspect ratio on desktop screen sizes.', 'sage'),
                'min' => 1,
            ]);

        return $image->build();
    }

    public function images(){
        $images = get_field('images') ?? [];
        if(empty($images)) return [];
        return collect($images)->map(function($image){
            return [
                'id' => $image,
                'caption' => wp_get_attachment_caption($image),
            ];
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
