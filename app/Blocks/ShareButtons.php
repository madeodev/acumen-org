<?php

namespace App\Blocks;

use App\Concerns\AcfUtils;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ShareButtons extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Share Buttons';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Offer users an opportunity to share to popular social networks or email. Include this block at the bottom of your text area.';

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
    public $icon = 'share';

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
        $title = rawurlencode(get_the_title());
        $link = get_the_permalink();

        return [
            'copied' => __('Link Copied', 'share_buttons'),
            'copy_failed' => __('Sorry, we were not able to copy the link', 'share_buttons'),
            'share_options' => [
                [
                    'image' => 'facebook',
                    'title' => __('Share on Facebook', 'share_buttons'),
                    'url' => "https://www.facebook.com/sharer.php?t=$title&u=$link",
                ],
                [
                    'image' => 'twitter',
                    'title' => __('Share on X/Twitter', 'share_buttons'),
                    'url' => "https://twitter.com/intent/tweet?text=$title&url=$link",
                ],
                [
                    'image' => 'linkedin',
                    'title' => __('Share on LinkedIn', 'share_buttons'),
                    'url' => "https://www.linkedin.com/shareArticle?title=$title&url=$link",
                ],
                [
                    'image' => 'pintrest',
                    'title' => __('Share on Pintrest', 'share_buttons'),
                    'url' => "https://pinterest.com/pin/create/button/?description=$title&url=$link",
                ],
                [
                    'image' => 'email',
                    'title' => __('Share via Email', 'share_buttons'),
                    'url' => "mailto:?subject=$title&body=$link",
                ],
            ],
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $shareButtons = new FieldsBuilder('share_buttons');

        $shareButtons
            ->addMessage('block_title', '', AcfUtils::blockTitle($this->name, $this->icon, $this->description));

        return $shareButtons->build();
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
