<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use App\Repositories\ProblemRepository;
use App\Repositories\RegionRepository;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Providers\CustomPostTypeProvider;

use function Roots\bundle;

class InteractiveMap extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Interactive Map';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Interactive map used to display problem, region CPTs. Each drawer also contains related program CPTs.';

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
    public $icon = 'admin-site-alt';

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
        'multiple' => false,
        'jsx' => true,
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        $problemLabel = CustomPostTypeProvider::getPostTypeLabels('problem');
        $regionLabel = CustomPostTypeProvider::getPostTypeLabels('region');

        return [
            'data' => $this->data(),
            'endpoint' => get_rest_url(null, 'sage-api/v2/programs/'),
            'labels' => [
                'region' => $regionLabel['singular_name'],
                'problem' => $problemLabel['singular_name'],
                'close' =>  __('Close modal', 'interactive_map'),
                'learn_more' =>  __('Learn more', 'interactive_map'),
                'programs' =>  __('Programs', 'interactive_map'),
                'next' =>  __('next', 'interactive_map'),
                'prev' =>  __('previous', 'interactive_map'),
            ],
            'countries' => AcfUtils::countryOptions(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $interactiveMap = new FieldsBuilder('interactive_map');

        $interactiveMap
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description));

        return $interactiveMap->build();
    }

    public function data()
    {
        $args = ['order' => 'ASC', 'orderby' => 'title'];
        return [
            'region' => (new RegionRepository())->all($args)->data ?? [],
            'problem' => (new ProblemRepository())->all($args)->data ?? [],
        ];
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        if (is_admin()) {
            return;
        }

        bundle('interactiveMap')->enqueue();
    }
}
