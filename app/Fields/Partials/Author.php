<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Author extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $author = new FieldsBuilder('author');

        $author
            ->addTaxonomy('author', [
                'label' => __('Author', 'sage'),
                'taxonomy' => 'post-author',
                'multiple' => true,
                'field_type' => 'multi_select',
                'return_format' => 'object',
            ]);

        return $author;
    }
}
