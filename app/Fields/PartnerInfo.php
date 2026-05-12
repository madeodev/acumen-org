<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PartnerInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $partnerInfo = new FieldsBuilder('partner_info');

        $partnerInfo
            ->setLocation('post_type', '==', 'partner');

        $partnerInfo
            ->addMessage('about', '', [
                'label' => __('About Partner Images', 'sage'),
                'message' => __('Partner logos (the featured image) the should be at least 700px wide by 520px tall. When viewed in the Logo Titles block they will be cropped to fit that aspect ratio (59/44) if necessary. Ensure there is adequate padding surrounding the logo. If possible, we recommend uploading a transparent png or svg.', 'sage'),
            ]);

        return $partnerInfo->build();
    }
}
