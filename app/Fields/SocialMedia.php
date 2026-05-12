<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Concerns\SocialMedia as SocialList;

class SocialMedia extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $socialMedia = new FieldsBuilder('social_media');

        $socialMedia
            ->setLocation('nav_menu_item', '==', 'location/social_navigation');

        $socialMedia
            ->addSelect('social', [
                'label' => __('Social Media', 'sage')
            ])
                ->addChoices($this->getOptions());

        return $socialMedia->build();
    }

    private function getOptions()
    {
        return collect(SocialList::SOCIAL_MEDIA)->mapWithKeys(function ($social) {
            return [$social => ucfirst($social)];
        })->toArray();
    }
}
