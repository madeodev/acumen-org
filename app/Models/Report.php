<?php

namespace App\Models;

class Report extends Post
{
    public function toArray(): array
    {
        $parent = parent::toArray();
        $year = Term::getSingleByPostID($this->id, 'acumen-year');

        if (!empty($year)) {
            $parent['topics'][] = $year;
        }

        $report = get_field('report_file', $this->id) ?: [];
        $buttonLabel = get_field('report_button_label', $this->id) ?? '';

        if (!empty($buttonLabel) && !empty($report)) {
            $report['title'] = $buttonLabel;
        }

        return [
            ...$parent,
            'type' => Term::getSingleByPostID($this->id, 'report-type'),
            'title_button' => $report,
            'link' => get_field('external_url', $this->id) ?: $parent['link'],
            'target' => get_field('external_url', $this->id) ? '_blank' : '_self',
            'media_format' => Term::getSingleByPostID($this->id, 'media-format'),
            'year' => $year,
            'featured_image_position' => get_field('featured_image_location', $this->id) ?? 'side',
            'featured_video' => get_field('show_video', $this->id) ? [
                'webm' => get_field('webm', $this->id),
                'mp4' => get_field('mp4', $this->id),
            ] : [],
        ];
    }
}
