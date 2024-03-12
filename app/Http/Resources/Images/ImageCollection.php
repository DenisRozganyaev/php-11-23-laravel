<?php

namespace App\Http\Resources\Images;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ImageCollection extends ResourceCollection
{
    public $collects = ImageResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
