<?php

namespace App\Models;

use App\Trate\FileHelperTrite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use FileHelperTrite;


    protected $guarded=[];
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('webp')
            ->format('webp')
            ->nonQueued();
    }
//    public function products(){
//        return $this->hasMany(Product::class);
//
//
//    }

}
