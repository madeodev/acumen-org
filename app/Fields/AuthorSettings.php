<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AuthorSettings extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $authorSettings = new FieldsBuilder('author_settings');

        $authorSettings
            ->setLocation('taxonomy', '==', 'post-author');

        $authorSettings
            ->addImage('image', [
                'label' => 'Image',
                'instructions' => 'Image to display for this author.',
            ])
            ->addText('title', [
                'label' => 'Title',
            ]);

        return $authorSettings->build();
    }
}
