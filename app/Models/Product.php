<?php

namespace App\Models;

use App\Trate\FileHelperTrite;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use FileHelperTrite;

    protected $guarded=[];


    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('webp')
            ->format('webp')
            ->nonQueued();
    }
}
