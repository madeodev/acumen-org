<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\DividerOptions;
use App\Models\Partner;

class LogoTiles extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Logo Tiles';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display a grid of partner logos.';

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
    public $icon = 'grid-view';

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
        $logos = $this->getLogos();
        return [
            'posts' => $logos,
            'divider_classes' => DividerOptions::getClasses(),
            'headline' => get_field('headline') ?? '',
            'paragraph' => get_field('paragraph') ?? '',
            'button' => get_field('button') ?? '',
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $logoTiles = new FieldsBuilder('logo_tiles');

        $logoTiles
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('headline', [
                'label' => __('Headline', 'sage'),
                'instructions' => __('Required', 'sage'),
                'required' => 1,
            ])
            ->addText('paragraph', [
                'label' => __('Paragraph', 'sage'),
                'instructions' => __('Optional', 'sage'),
            ])
            ->addLink('button', [
                'label' => __('Button', 'sage'),
                'instructions' => __('Optional. Please limit the button label to 20 characters.', 'sage'),
            ])
            ->addRelationship('posts', [
                'label' => __('Partners', 'sage'),
                'instructions' => __('Please select a minimum of 1 partner from the list. Drag and drop the posts on the right side to change the ordering of the partner logos.', 'sage'),
                'required' => 1,
                'min' => 1,
                'post_type' => 'partner'
            ])
            ->addAccordion('block_settings', [
                'label' => __('Block Settings', 'sage')
            ])
            ->addFields($this->get(DividerOptions::class))
            ->addAccordion('end_block_settings')->endPoint();

        return $logoTiles->build();
    }

    /**
     * get the logos and calculate for dummy spacers so
     * the logos can be justified to the right for desktop
     */
    private function getLogos()
    {
        $logos = get_field('posts') ?? [];

        if (empty($logos)) {
            return;
        }

        return Partner::collection($logos);
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
