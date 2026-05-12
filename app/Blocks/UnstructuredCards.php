<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Fields\Partials\DividerOptions;
use App\Fields\Partials\HeadingLevel;
use App\Fields\Partials\TopicLabel;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class UnstructuredCards extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Unstructured Cards';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Displays 1-3 cards. All content within each card is manually entered (does not relate to any custom post types).';

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
    public $icon = 'welcome-widgets-menus';

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
            'cards' => $cards,
            ... HeadingLevel::getFields(),
            'divider' => DividerOptions::getClasses(),
            'card_style' => $this->cardStyle($cards),
            'grid_classes' => $this->gridClasses($cards),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $unstructuredCards = new FieldsBuilder('unstructured_cards');

        $unstructuredCards
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addRepeater('cards', [
                'label' => __('Cards', 'sage'),
                'min' => 1,
                'max' => 3,
            ])
                ->addMessage('card_message', '', AcfUtils::repeaterTitle('Card', 'align-full-width'))
                ->addImage('featured_image', [
                    'label' => __('Image', 'sage'),
                    'instructions'  => __('Required - 880px x 566px', 'sage'),
                    'required' => 1,
                    'wrapper' => [ 'width' => '70%', ],
                ])
                ->addFields($this->get(TopicLabel::class))
                ->addText('title', [
                    'label' => __('Title', 'sage'),
                    'instructions'  => __('Required - Recommended max characters: 100', 'sage'),
                    'required' => 1,
                ])
                ->addTextarea('excerpt', [
                    'label' => __('Description', 'sage'),
                    'instructions'  => __('Recommended max characters: 150', 'sage'),
                ])
                ->addLink('button', [
                    'label' => __('Button', 'sage'),
                ])
            ->endRepeater()
            ->addAccordion('settings', [
                'label' => __('Block Settings ', 'sage'),
            ])
                ->addFields($this->get(DividerOptions::class))
                ->addFields($this->get(HeadingLevel::class));

        return $unstructuredCards->build();
    }

    public function cardStyle($cards){
        if(!is_countable($cards)) return '';
        return count($cards).'-up';
    }


    public function gridClasses($cards){
        if(!is_countable($cards)) return '';

        switch (count($cards)) {
            case 1:
                return '';
                break;

            case 2:
                return 'md:grid-cols-2';
                break;
            
            default: //3
                return 'md:grid-cols-2 xl:grid-cols-3';
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
