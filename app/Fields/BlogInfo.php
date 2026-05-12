<?php

namespace App\Fields;

use App\Fields\Partials\MediaFormat;
use App\Fields\Partials\ProblemRegion;
use App\Fields\Partials\Author;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BlogInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $blogInfo = new FieldsBuilder('blog_info', [
            'label' => __('Blog Info', 'sage'),
            'position' => 'side',
        ]);

        $blogInfo
            ->setLocation('post_type', '==', 'post');

        $blogInfo
            ->addLink('title_button', [
                'label' => __('Title Button', 'sage'),
            ])
            ->addText('vanity_author', [
                'label' => __('Vanity Author', 'sage'),
                'instructions' => '<em>Deprecated in favour of the "Author" field</em>',
            ])
            ->addFields($this->get(Author::class))
            ->addFields($this->get(MediaFormat::class))
            ->addTaxonomy('type', [
                'label' => __('Blog Type', 'sage'),
                'taxonomy' => 'blog-type',
            ])
            ->addFields($this->get(ProblemRegion::class));

        return $blogInfo->build();
    }
}
