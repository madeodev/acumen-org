<?php

namespace App\Concerns;

class GetsFocalPoint{

    public static function focal_point(string $id = null)
    {
        $y = get_field('focal_point_y', $id) ?? -1;
        $y = $y >= 0 ? $y : '50';
        $x = get_field('focal_point_x', $id) ?? -1;
        $x = $x >= 0 ? $x : '50';

        return 'object-position: '.$x.'% '.$y.'%;';
    }

}