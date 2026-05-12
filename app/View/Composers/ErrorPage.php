<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ErrorPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        '404'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => __('404 — Page not found.', '404_page'),
            'content' => __('Whoops sorry about that! The page you\'re looking for has been moved, deleted or might never have existed...', '404_page'),
            'link' => [
                'target' => '_self',
                'url' => home_url(),
                'title' => __('Visit home page', '404_page'),
            ],
        ];
    }
}
