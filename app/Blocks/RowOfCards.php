<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\Colorways;
use App\Fields\Partials\HeadingLevel;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class RowOfCards extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Row Of Cards';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Introduce topics of equal importance. These are often used to link to other pages within your website and promote exploration.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'bw-blox';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'columns';

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
    public $mode = 'preview';

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
            'headline' => get_field('headline') ?? '',
            'paragraph' => get_field('paragraph') ?? '',
            'link' => get_field('link') ?? [],
            'cards' => get_field('cards') ?? [],
            'card_classes' => $this->cardClasses($cards),
            'colors' => new Colorways('default'),
            ...HeadingLevel::getFields(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $rowOfCards = new FieldsBuilder('row_of_cards');

        $rowOfCards
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addText('headline', [
                'label' => __('Headline', 'sage'),
                'instructions'  => __('Required - Recommended max characters: 80', 'sage'),
                'required' => 1,
                'default_value' => __('Headline', 'sage'),
            ])
            ->addFields($this->get(HeadingLevel::class))
            ->addTextArea('paragraph', [
                'label' => __('Paragraph', 'sage'),
                'instructions'  => __('Optional - Recommended max characters: 125', 'sage'),
                'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id justo odio. Pellentesque quis leo sed justo sagittis tincidunt eget nec tortor. Sed bibendum justo enim, ac finibus libero viverra ac.',
            ])
            ->addLink('link', [
                'label' => __('Button', 'sage'),
                'instructions'  => __('Optional', 'sage'),
            ])
            ->addRepeater('cards', [
                'label' => __('Cards', 'sage'),
                'min' => 2, 
                'max' => 4,
            ])
                ->addMessage('card_title', '', AcfUtils::repeaterTitle('Card', 'align-full-width'))
                ->addText('title', [
                    'label' => __('Headline', 'sage'),
                    'instructions'  => __('Optional - Recommended max characters: 80', 'sage'),
                    'default_value' => __('Headline', 'sage'),
                    'wrapper' => [ 'width' => '70%', ],
                ])
                ->addTextArea('excerpt', [
                    'label' => __('Paragraph', 'sage'),
                    'instructions'  => __('Required - Recommended max characters: 125', 'sage'),
                    'required' => 1,
                    'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id justo odio. Pellentesque quis leo sed justo sagittis tincidunt eget nec tortor. Sed bibendum justo enim, ac finibus libero viverra ac.',
                ])
                ->addLink('button', [
                    'label' => __('Button', 'sage'),
                    'instructions'  => __('Optional', 'sage'),
                ])
                ->addImage('featured_image', [
                    'label' => __('Image', 'sage'),
                    'instructions'  => __('Optional - Recommended size: 650px x 650px', 'sage'),
                ])
            ->endRepeater();

        return $rowOfCards->build();
    }

    function cardClasses($cards){
        if (empty($cards)) return '';
        switch(count($cards)) {
            case 4:
                return 'md:grid-cols-2 xl:grid-cols-4';
                break;

            case 3:
                return 'lg:grid-cols-3';
                break;
            
            default: // 2
                return 'md:grid-cols-2';
                break;
        }
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
