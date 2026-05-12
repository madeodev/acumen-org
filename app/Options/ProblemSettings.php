<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Fields\Partials\HeadingIntro;

class ProblemSettings extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Impact Sector Settings';

    /**
     * The option page menu name.
     *
     * @var string
     */
    public $slug = 'problem-settings';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Impact Sector Settings';

    /**
     * The slug of another admin page to be used as a parent.
     *
     * @var string
     */
    public $parent = 'edit.php?post_type=problem';

    /**
     * The post ID to save and load values from.
     *
     * @var string|int
     */
    public $post = 'problem_options';

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $problemSettings = new FieldsBuilder('problem_settings', [
            'title' => 'Impact Sector Settings'
        ]);

        $problemSettings
            ->addMessage('featured_posts', '', [
                'label' => __('Featured Posts', 'sage'),
                'message' => __('Settings for the featured post module displayed for single posts. If the fields below are left empty, the default content from the <a href="admin.php?page=site-settings" target="_blank">Site Settings page</a> will be used.<br /><br /><strong>Note: This does not affect the usage of the Featured Posts module in pages.</strong>', 'sage'),
            ])
            ->addGroup('featured_posts', [
                'label' => '',
            ])
                ->addFields($this->get(HeadingIntro::class))
            ->endGroup();

        return $problemSettings->build();
    }
}
