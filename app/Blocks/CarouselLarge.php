<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\ColorwaysLight;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CarouselLarge extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Carousel Large';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display 2-10 custom topics in a carousel format.';

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
    public $icon = 'align-none';

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
            'cards' => $this->cards(),
            'colors' => new ColorwaysLight( get_field('color') ?? '' ),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $carouselLarge = new FieldsBuilder('carousel_large');

        $carouselLarge
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addRepeater('cards', [
                'label' => __('Cards', 'sage'),
                'min' => 2,
                'max' => 10,
            ])
                ->addMessage('card_message', '', AcfUtils::repeaterTitle('Card', 'align-full-width'))
                ->addText('title', [
                    'label' => __('Title', 'sage'),
                    'instructions' => __('Required - ~100 Characters. For best results all cards should have similar lengths of text.', 'sage'),
                    'required' => 1,
                    'wrapper' => ['width' => '70%'],
                ])
                ->addImage('image', [
                    'label' => __('Image', 'sage'),
                    'instructions' => __('Required - 2000px x 1200px', 'sage'),
                    'required' => 1,
                    'wrapper' => ['width' => '50%'],
                ])
                ->addLink('button', [
                    'label' => __('Button', 'sage'),
                    'wrapper' => ['width' => '50%'],
                ])
            ->endRepeater() 
            ->addAccordion('settings', [
                'label' => __('Block Settings ', 'sage'),
            ])
                ->addRadio('color', [
                    'label' => __('Color', 'sage'),
                    'default_value' => 'tulip'
                ])
                    ->addChoices((new ColorwaysLight())->getColorOptions());

        return $carouselLarge->build();
    }

    public function cards() : array 
    {
        $cards = get_field('cards') ?? [];
        if(empty($cards)) return [];
        
        return collect($cards)->map(function($card){
            if(!empty($card['button']['url'])){
                $target = empty($card['button']['target']) ? '_self' : $card['button']['target'];
                $link = $card['button']['url'];
                $card['element_start'] = "a href=\"$link\" target=\"$target\" ";
                $card['element_end'] = "a";
                $card['style'] = "hover:bg-white/20 group transition-all duration-300";
            }
            else{
                $card['element_start'] = 'div';
                $card['element_end'] = "div";
                $card['style'] = "";
            }
            return $card;
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
