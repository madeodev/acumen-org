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
            ->addRadio('report_button_type', [
                'label' => __('Header Button Type', 'sage'),
                'choices' => [
                    'file' => __('Media/Report file', 'sage'),
                    'anchor' => __('Anchor link on this page', 'sage'),
                ],
                'default_value' => 'file',
            ])
            ->addFile('report_file', [
                'label' => __('Media/Report', 'sage'),
            ])
                ->conditional('report_button_type', '!=', 'anchor')
            ->addText('report_button_anchor', [
                'label' => __('Anchor ID', 'sage'),
                'instructions' => __('Enter the HTML anchor set on the target block (e.g. report-form), without #.', 'sage'),
            ])
                ->conditional('report_button_type', '==', 'anchor')
            ->addText('report_button_label', [
                'label' => __('Report Button Label', 'sage'),
                'instructions' => __('Optional. For a file, the filename is used if not set. For an anchor link, "Learn more" is used if not set.', 'sage'),
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
