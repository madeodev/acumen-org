<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\Colors\Colorways;
use App\Concerns\Colors\ColorwaysLight;
use App\Models\CaseStudy;

class CarouselCaseStudyCard extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Carousel Case Study Card';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Display a series of case study CPTs in a carousel format. Manually select the background color and case study to display on each card. All data is pulled and populates from the case study CPT.';

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
    public $icon = 'image-flip-horizontal';

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
            'items' => $this->getItems(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $carouselCaseStudyCard = new FieldsBuilder('carousel_case_study_card');

        $carouselCaseStudyCard
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description))
            ->addRepeater('items', [
                'label' => __('Case Studies', 'sage'),
                'min' => 1,
                'max' => 5,
            ])
                ->addPostObject('post', [
                    'label' => __('Case Study', 'sage'),
                    'instructions' => __('Required', 'sage'),
                    'post_type' => 'case-study',
                    'required' => 1
                ])
                ->addRadio('color', [
                    'label' => __('Color', 'sage'),
                    'default_value' => 'woad'
                ])
                    ->addChoices((new ColorwaysLight())->getColorOptions())
            ->endRepeater();

        return $carouselCaseStudyCard->build();
    }

    private function getItems()
    {
        $posts = get_field('items') ?? [];

        if (empty($posts)) {
            return;
        }

        return collect($posts)->map(function ($item) {
            $post = CaseStudy::serialize($item['post']);
            $item['color'] = new Colorways($item['color'] ?? '');
            $item['term'] = [
                'label' => $post['post_type_pretty'],
                'icon' => $post['icon']
            ];

            $item['button'] = [
                'title' => __('Read case study', 'case-study-carousel'),
                'url' => $post['link'],
                'target' => '_self',
            ];

            unset($item['post']);

            return array_merge($post, $item);
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
