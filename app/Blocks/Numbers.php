<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Concerns\Colors\Colorways;
use App\Fields\Partials\HeadingLevel;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Numbers extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Numbers';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A module to display 4 statistics with a headline and description for each.';

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
    public $icon = 'editor-ol';

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
        return [
            'heading'      => get_field('heading') ?? '',
            ...HeadingLevel::getFields(),
            'stats'        => get_field('stats') ?? [],
            'colors'       => new Colorways('default'),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $numbers = new FieldsBuilder('numbers');

        $numbers
            ->addMessage('block_title', '',  AcfUtils::blockTitle(
                $this->name, $this->icon, $this->description
            ))
            ->addText('heading', [
                'label'        => __('Heading', 'sage'),
                'instructions' => __('Optional - Heading for module section', 'sage')
            ])
            ->addFields($this->get(HeadingLevel::class))
            ->addRepeater('stats', [
                'label' => __('Number Statistics', 'sage'),
                'min'   => 4,
                'max'   => 4,
            ])  
                ->addMessage('stat_title', '', AcfUtils::repeaterTitle('Stat', 'star-filled'))
                ->addText('stat_heading', [
                    'label'         => __('Stat Heading', 'sage'),
                    'instructions'  => __('Required - Recommended max characters: 35', 'sage'),
                    'required'      => 1,
                    'default_value' => __('Stat Heading', 'sage'),
                    'wrapper' => [ 'width' => '70%', ],
                ])
                ->addTextarea('stat_description', [
                    'label'         => __('Stat Description', 'sage'),
                    'instructions'  => __('Required - Recommended max characters: 260', 'sage'),
                    'required'      => 1,
                    'default_value' => __('Stat Description', 'sage'),
                ])

            ->endRepeater();

        return $numbers->build();
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
