<?php

namespace App\Trate;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait FileHelperTrite
{
    public function getImageAttribute(): string
    {
        if ($this->hasMedia('image')) {
            return $this->getMedia('image')[0]->getUrl('webp');
        } else {
            return asset('images/default.png');
        }

    }

    public function getImage($collection): string
    {
        if ($this->hasMedia($collection)) {
            return $this->getMedia($collection)[0]->getUrl('webp');
        } else {
            return asset('images/default.png');
        }
    }


    public function getImagesAttribute(): Collection
    {
        if ($this->hasMedia('image')) {
            $list = [];
             foreach ($this->getMedia('image') as $media) {
                $list[$media->getAttribute('id')] = $media->getUrl('webp');
            }
            return collect($list);
        }
        return collect(['default' => asset('images/default.png')]);

    }


}
