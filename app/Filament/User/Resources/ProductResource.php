<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\ProductResource\Pages;
use App\Filament\User\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ProductResource extends Resource

{
    protected static ?string $pluralModelLabel = 'المنتجات ';

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_active')->label('متوفر ')->offColor('danger')->onColor('success'),
                Forms\Components\SpatieMediaLibraryFileUpload::make('img')
                    ->multiple()
                    ->collection('products')->label('صورالمنتج ')
                ,
                Forms\Components\Select::make('cat_id')->options(Category::all()->pluck('name', 'id'))->label('الفئة')
                    ->relationship('category', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->label('اسم الفئة')->required(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('img')->collection('cats')->label('صورة الفئة')
                    ]),
                Forms\Components\TextInput::make('name')->label('اسم المنتج'),
                Forms\Components\TextInput::make('price_before')->numeric()->label('السعر قبل'),
                Forms\Components\TextInput::make('price_after')->numeric()->label('سعر العرض'),
                Forms\Components\TextInput::make('quantity')->numeric()->label('الكمية'),
                Forms\Components\Textarea::make('description')->label('الوصف'),

                Forms\Components\DateTimePicker::make('start')->label('تاريخ بداية العرض'),
                Forms\Components\DateTimePicker::make('end')->label('تاريخ نهاية العرض')


            ]);

    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active'),
                Tables\Columns\TextColumn::make('category.name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
