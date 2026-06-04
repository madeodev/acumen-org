<?php

namespace App\Fields;

use App\Fields\Partials\MediaFormat;
use App\Fields\Partials\ProblemRegion;
use App\Fields\Partials\Year;
use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ReportInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $reportInfo = new FieldsBuilder('report_info', [
            'label' => __('Report Info', 'sage'),
            'position' => 'side'
        ]);

        $reportInfo
            ->setLocation('post_type', '==', 'report');

        $reportInfo
            ->addUrl('external_url', [
                'label' => __('External URL', 'sage'),
                'instructions' => __('If an external url is added, this report will open that link instead of the report page.'),
            ])
            ->addFile('report_file', [
                'label' => __('Media/Report', 'sage'),
            ])
            ->addText('report_button_label', [
                'label' => __('Report Button Label', 'sage'),
                'instructions' => __('Optional. If not set, the filename of the report file will be used.', 'sage'),
            ])
            ->addFields($this->get(MediaFormat::class))
            ->addTaxonomy('type', [
                'label' => __('Report Type', 'sage'),
                'taxonomy' => 'report-type',
            ])
            ->addFields($this->get(ProblemRegion::class))
            ->addFields($this->get(Year::class));

        return $reportInfo->build();
    }
}
