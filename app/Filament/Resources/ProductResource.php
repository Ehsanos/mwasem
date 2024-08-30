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
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $pluralModelLabel = 'المنتجات ';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\Toggle::make('is_active')->label('مفعل/غيرمفعل ')->offColor('danger')->onColor('success'),
                Forms\Components\SpatieMediaLibraryFileUpload::make('img')
                    ->multiple()
                    ->collection('products')->label('صورالمنتج ')->columnSpanFull()
                ,
                Forms\Components\Select::make('category_id')->options(Category::all()->pluck('name', 'id'))->label('الفئة')
                    ->relationship('category', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->label('اسم الفئة')->required(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('img')->collection('cats')->label('صورة الفئة')
                    ])->required(),
                Forms\Components\TextInput::make('name')->label('اسم المنتج')->required(),
                Forms\Components\TextInput::make('price_before')->minValue(0)->numeric()->label('السعر قبل')
                    ->required(),
                Forms\Components\TextInput::make('price_after')->minValue(0)->numeric()->label('سعر العرض')->required(),
                Forms\Components\TextInput::make('quantity')->numeric()->label('الكمية'),
                Forms\Components\Textarea::make('description')->label('الوصف'),
                Forms\Components\Select::make('user_id')->options(
                    User::all()->pluck('name', 'city_id')
                )->label('التاجر')
                    ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('city_id', $state))
                    ->live()->required()
                    ->reactive(),
                Forms\Components\Select::make('city_id')->options(
                    fn(Forms\Get $get): Collection => City::query()
                        ->where('id', $get('user_id'))
                        ->pluck('name', 'id')
                )
                    ->label('المدينة')->required()
                ,
                Forms\Components\DatePicker::make('start')->minDate(Carbon::today())
                    ->rules(['after_or_equal:today'])
                    ->label('تاريخ بداية العرض')->required(),
                Forms\Components\DatePicker::make('end')
                    ->minDate(Carbon::today())
                    ->label('تاريخ نهاية العرض')->required()


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')->label('موافقة/رفض'),
                Tables\Columns\TextColumn::make('user.name')->label('التاجر'),
                Tables\Columns\TextColumn::make('name')->label('اسم العرض'),
                Tables\Columns\TextColumn::make('category.name')->label('الفئة')->sortable()->searchable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('صورة المنتج ')->collection('products')
                    ->circular()->stacked()->wrap()->limit(2),
                Tables\Columns\TextColumn::make('start')->dateTime('m-d-Y')
                    ->label('بداية العرض')->color('primary'),
                Tables\Columns\TextColumn::make('end')->dateTime('m-d-Y')->label('نهاية العرض')->color('danger'),
                Tables\Columns\TextColumn::make('price_before')->label('السعر قبل العرض'),
                Tables\Columns\TextColumn::make('price_after')->label('سعر العرض '),


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
