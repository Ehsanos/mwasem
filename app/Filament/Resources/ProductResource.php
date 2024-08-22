<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
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
    protected static ?string $model = Product::class;

    protected static ?string $pluralModelLabel = 'المنتجات ';


    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_active')->label('مفعل/غيرمفعل ')->offColor('danger')->onColor('success'),
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
                Forms\Components\Select::make('user_id')->options(
                    User::all()->pluck('name', 'city_id')
                )->label('التاجر')
                    ->afterStateUpdated(fn(Forms\Set $set,?string $state) =>$set('city_id',$state))
                    ->live()
->reactive()                ,
                Forms\Components\Select::make('city_id')->options(
                    fn(Forms\Get $get):Collection =>City::query()
                    ->where('id',$get('user_id'))
                    ->pluck('name','id')
                )
                    ->label('المدينة')->live()
                  ,
                Forms\Components\DateTimePicker::make('start')->label('تاريخ بداية العرض'),
                Forms\Components\DateTimePicker::make('end')->label('تاريخ نهاية العرض')


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
