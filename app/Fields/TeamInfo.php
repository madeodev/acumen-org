<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TeamInfo extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $teamInfo = new FieldsBuilder('team_info', [
            'label' => __('Team Info', 'sage'),
            'position' => 'side'
        ]);

        $teamInfo
            ->setLocation('post_type', '==', 'team');

        $teamInfo
            ->addText('first_name', [
                'label' => __('First Name', 'sage'),
            ])
            ->addText('last_name', [
                'label' => __('Last Name', 'sage'),
            ])
            ->addTrueFalse('open_page', [
                'label' => __('Open as a page', 'sage'),
                'instructions' => __('Toggle if this team member\'s bio will open as a page instead of a drawer', 'sage'),
            ])
            ->addLink('custom_link', [
                'label' => __('Custom page link', 'sage'),
                'instructions' => __('Optional. Clicking on this team member will open the page selected. If this is left empty, it will open the team member\'s page.', 'sage'),
            ])
                ->conditional('open_page', '==', '1')
            ->addText('title', [
                'label' => __('Title', 'sage'),
            ])
            ->addUrl('linkedIn', [
                'label' => __('LinkedIn Profile', 'sage'),
            ])
            ->addTaxonomy('type', [
                'label' => __('Team Type', 'sage'),
                'taxonomy' => 'team-type',
                'field_type' => 'multi_select',
            ])
            ->addTaxonomy('office', [
                'label' => __('Office', 'sage'),
                'taxonomy' => 'office',
            ])
            ->addTaxonomy('function', [
                'label' => __('Function', 'sage'),
                'taxonomy' => 'team-function',
            ]);

        return $teamInfo->build();
    }
}
