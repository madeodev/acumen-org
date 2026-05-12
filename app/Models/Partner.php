<?php

namespace App\Models;

class Partner extends Post
{
    public function toArray(): array
    {
        return [
            ...parent::toArray(),
        ];
    }
}
