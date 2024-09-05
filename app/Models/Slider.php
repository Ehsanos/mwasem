<?php

namespace App\Models;

use App\Trate\FileHelperTrite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slider extends Model implements HasMedia
{
    use HasFactory;use InteractsWithMedia;
    use FileHelperTrite;

    protected $guarded=[];
    protected $table ='sliders';

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('webp')
            ->format('webp')
            ->nonQueued();
    }



}
