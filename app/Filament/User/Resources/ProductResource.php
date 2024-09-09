<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\ProductResource\Pages;
use App\Filament\User\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\City;
use Carbon\Carbon;
use Filament\Actions\DeleteAction;
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

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\TextInput::make('is_active')->default(0),
                Forms\Components\SpatieMediaLibraryFileUpload::make('img')->multiple()->collection('products')->label('صورالمنتج ')
                ->columnSpanFull(),
                Forms\Components\Select::make('category_id')->options(Category::all()->pluck('name', 'id'))->label('الفئة'),

                Forms\Components\TextInput::make('name')->label('اسم المنتج')->required(),
                Forms\Components\TextInput::make('price_before')->numeric()->label('السعر قبل')->required(),
                Forms\Components\TextInput::make('price_after')->numeric()->label('سعر العرض')->required(),
                Forms\Components\TextInput::make('quantity')->numeric()->label('الكمية'),
                Forms\Components\Textarea::make('description')->label('الوصف'),

                Forms\Components\DatePicker::make('start')->label('تاريخ بداية العرض')
                    ->rule('after_or_equal:today')
                    ->required()->default(now()
                    ->format('Y-m-d')),
                Forms\Components\DatePicker::make('end')->label('تاريخ نهاية العرض')->required()
                    ->default(Carbon::now()->addDay()->format('Y-m-d'))


            ]);

    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')->label('بانتظار الموافقة')->disabled()
                ->onIcon('heroicon-o-check')
                ->offIcon('heroicon-o-clock')
                ->onColor('success')
                ->offColor('danger')
                ,
                Tables\Columns\TextColumn::make('name')->label('اسم العرض'),
                Tables\Columns\TextColumn::make('category.name')->label('الفئة')->sortable()->searchable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('صورة المنتج ')->collection('products')
                    ->circular()->stacked()->wrap()->limit(2) ,
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
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getTableQuery(): Builder
    {
        return Post::query();
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
