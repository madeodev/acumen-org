<?php

namespace App\Models;

abstract class Resource
{
  /** 
   * @var any 
   */
  protected $resource;

  protected function __construct($resource)
  {
    $this->resource = $resource;
  }

  public function toArray(): array
  {
    return [];
  }

  public static function serialize($resource)
  {
    $result = new static($resource);

    return is_null($resource) ? null : $result->toArray();
  }

  public static function collection($resources): array
  {
    return collect($resources)
      ->filter(function ($resource) {
        return !empty($resource);
      })
      ->map(function ($resource) {
        return static::serialize($resource);
      })
      ->toArray();
  }
}
