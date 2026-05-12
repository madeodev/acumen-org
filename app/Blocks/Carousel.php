<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\ColorwaysLight;
use App\Fields\Partials\DividerOptions;
use App\Fields\Partials\TopicLabel;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Carousel extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Carousel';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display 1-3 custom topics in a carousel format. Each card within the carousel has customizable content: color, image, text and link.';

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
        $cards = get_field('cards') ?? [];
        return [
            'cards' =>  $cards,
            'colors' => $this->cardColors($cards),
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
        $carousel = new FieldsBuilder('carousel');

        $carousel
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addRepeater('cards', [
                'label' => __('Cards', 'sage'),
                'min' => 1,
                'max' => 3,
            ])
                ->addFields($this->get(TopicLabel::class))
                ->addText('title', [
                    'label' => __('Title', 'sage'),
                    'instructions' => __('Required - ~100 Characters. For best results all cards should have similar lengths of text.', 'sage'),
                    'required' => 1,
                ])
                ->addImage('image', [
                    'label' => __('Image', 'sage'),
                    'instructions' => __('Required - 1280px x 1280px', 'sage'),
                    'required' => 1,
                    'wrapper' => ['width' => '50%'],
                ])
                ->addLink('button', [
                    'label' => __('Button', 'sage'),
                    'wrapper' => ['width' => '50%'],
                ])
                ->addRadio('color', [
                    'label' => __('Color', 'sage'),
                    'default_value' => 'woad'
                ])
                    ->addChoices((new ColorwaysLight())->getColorOptions())
            ->endRepeater() 
            ->addAccordion('settings', [
                'label' => __('Block Settings ', 'sage'),
            ])
                ->addFields($this->get(DividerOptions::class))
                ;

        return $carousel->build();
    }

    public function cardColors($cards) {
        if(empty($cards)) return [];

        return collect($cards)->map(function($card){
            return (new ColorwaysLight($card['color']))->classes('wrapper');
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
