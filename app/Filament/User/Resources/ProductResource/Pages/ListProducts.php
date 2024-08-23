<?php

namespace App\Filament\User\Resources\ProductResource\Pages;

use App\Filament\User\Resources\ProductResource;
use Filament\Actions;
use App\Models\Product;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getTableQuery(): ?Builder
    {

        $lisat = Product::where('user_id', auth()->user()->id);
        return $lisat;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
