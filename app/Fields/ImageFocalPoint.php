<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageFocalPoint extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $focalPoint = new FieldsBuilder('focal_point');

        $focalPoint
            ->setLocation('attachment', '==', 'image');

        $focalPoint
            ->addMessage('focal_point_message', '', [
                'label' => __('Image Focal Point', 'image_focal_point'),
                'message' => __('Images may be cropped in some layouts. Use the sliders below to determine the center of the cropped image.', 'image_focal_point')
            ])
            ->addRange('focal_point_y',[
                'label' => __('Focal Point: Up - Down', 'image_focal_point'),
                'instructions' => 'Drag this slider to move the focal point from top (0) to bottom (100).',
                'default_value' => '50',
                'wrapper' => array('width' => '50%')
            ])
            ->addRange('focal_point_x',[
                'label' => __('Focal Point: Left - Right', 'image_focal_point'),
                'instructions' => 'Drag this slider to move the focal point from left (0) to right (100).',
                'default_value' => '50',
                'wrapper' => array('width' => '50%')
            ]);

        return $focalPoint;
    }
}
