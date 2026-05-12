<?php

namespace App\Fields;

use App\Fields\Partials\MediaFormat;
use App\Fields\Partials\ProblemRegion;
use App\Fields\Partials\Author;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class NewsInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $newsInfo = new FieldsBuilder('news_info', [
            'label' => __('News Info', 'sage'),
            'position' => 'side'
        ]);

        $newsInfo
            ->setLocation('post_type', '==', 'news');

        $newsInfo
            ->addLink('title_button', [
                'label' => __('Title Button (Outlet)', 'sage'),
            ])
            ->addUrl('external_url', [
                'label' => __('External URL', 'sage'),
                'instructions' => __('If an external url is added, this news item will open that link instead of the news item page.'),
            ])
            ->addFields($this->get(Author::class))
            ->addFields($this->get(MediaFormat::class))
            ->addTaxonomy('type', [
                'label' => __('News Type', 'sage'),
                'taxonomy' => 'news-type',
            ])
            ->addFields($this->get(ProblemRegion::class));


        return $newsInfo->build();
    }
}
