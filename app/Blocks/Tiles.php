<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Colors\Colorways;
use App\Concerns\Colors\TileColors;

class Tiles extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Tiles';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display 2 or more custom topics in a grid format.';

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
    public $icon = 'screenoptions';

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
            'tiles' => $this->getTiles(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $tiles = new FieldsBuilder('tiles');

        $tiles
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addRepeater('tiles', [
                'label' => __('Tiles', 'sage'),
                'min' => 2,
            ])
                ->addText('title', [
                    'label' => __('Title', 'sage'),
                    'instructions' => __('Required. It is recommended to use a minimum of 20 characters.', 'sage'),
                    'required' => 1,
                ])
                ->addTextarea('description', [
                    'label' => __('Description', 'sage'),
                    'instructions' => __('Required. It is recommended to use a minimum of 50 characters.', 'sage'),
                    'required' => 1,
                    'rows' => 2,
                ])
                ->addLink('button', [
                    'label' => __('Button', 'sage'),
                    'instructions' => __('Optional. It is recommended to use a minimum of 20 characters for the button text.', 'sage'),
                ])
                ->addAccordion('tile_settings', [
                    'label' => __('Tile Background Setting', 'sage'),
                ])
                    ->addRadio('color', [
                        'label' => __('Background Color', 'sage'),
                        'instructions' => __('Required', 'sage'),
                        'default_value' => 'lapis',
                        'required' => 1,
                    ])
                        ->addChoices((new TileColors())->getColorOptions())
                    ->addImage('image', [
                        'label' => __('Background Hover Image', 'sage'),
                        'instructions' => __('Required', 'sage'),
                        'required' => 1,
                    ])
                ->addAccordion('end_settings')->endPoint()
            ->endRepeater();

        return $tiles->build();
    }

    /**
     * get the colours assocaite to each tile
     * and update the element tag if there is a link provided
     */
    private function getTiles()
    {
        $tiles = get_field('tiles') ?? [];

        return collect($tiles)->map(function ($tile) {
            $tile['color'] = new Colorways($tile['color'] ?? '');
            $hasButton = !empty($tile['button']);
            $tile['tag'] = $hasButton ? 'a' : 'div';

            if ($hasButton) {
                $tile['button']['target'] = $tile['button']['target'] ?: '_self';
            }

            return $tile;
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
