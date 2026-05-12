<?php

namespace App\Concerns;

use stdClass;

class Video
{
    public function getVideoSrc($link, $attributes = []) : string
    {
        $url = parse_url($link);
        if (empty($url['host'])) {
            return '';
        }

        switch ($url['host']) {
            case 'youtube.com':
            case 'm.youtube.com':
            case 'www.youtube.com':
            case 'youtu.be':
                
                $id = $this->getYouTubeID($link);

                if (!empty($id)) {
                    $src = 'https://www.youtube-nocookie.com/embed/' . $id . '?modestbranding=1&playsinline=1&enablejsapi=1&rel=0';

                    if (!empty($attributes)) {
                        $src .= '&' . http_build_query($attributes);
                    }
                }

                break;

            case 'vimeo.com':
                $video = str_replace('/', '', $url['path']);
                $src = 'https://player.vimeo.com/video/' . $video . '?background=1';

                if (!empty($attributes['mute'])) {
                    $src .= '&muted=1';
                }

                if (!empty($attributes['autoplay'])) {
                    $src .= '&autoplay=1';
                }
                break;

            default:
                return '';
                break;
        }

        if(empty($src)) {
            return '';
        }

        return $src;
    }

    /**
     * Retrieve a video ID from a YouTube link
     * @param string $link
     * @return string - the video ID
     */
    public function getYouTubeID(string $link): string
    {
        $url = parse_url($link);

        if (empty($url['host'])) {
            return '';
        }

        if (!in_array($url['host'], ['youtube.com','www.youtube.com','youtu.be', 'm.youtube.com'])) {
            return '';
        }

        if (!empty($url['query'])) {
            parse_str($url['query'], $query);
        }

        if (!empty($query['v'])) {
            return $query['v'];
        }

        if (!empty($url['path'])) {
            $segments = explode('/', $url['path']);
            return array_pop($segments);
        }

        return '';
    }
}
