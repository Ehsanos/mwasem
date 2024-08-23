<?php

namespace App\Filament\User\Resources\ProductResource\Pages;

use App\Filament\User\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['user_id'] = auth()->user()->id;
        $data['city_id']=auth()->user()->city_id;
        return $data;
    }


}
