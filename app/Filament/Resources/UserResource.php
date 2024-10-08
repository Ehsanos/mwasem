<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\City;

use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $pluralModelLabel = 'المستخدمون ';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }



    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\CheckboxList::make('roles')
                    ->relationship('roles', 'name')->label('الصلاحيات')->columnSpanFull(),
                Forms\Components\Toggle::make('is_admin')->label('أدمن ')->onIcon('heroicon-m-bolt')
                    ->offIcon('heroicon-m-user') ->onColor('success')
                    ->offColor('danger'),
                Forms\Components\Toggle::make('is_active')->label('مفعل/غيرمفعل ')->offColor('danger')->onColor('success'),
                Forms\Components\SpatieMediaLibraryFileUpload::make('صورة المستخدم')->collection('users')->columnSpanFull(),
                Forms\Components\TextInput::make('name')->label('اسم المستخدم')->required(),
                Forms\Components\TextInput::make('email')->label('البريد الالكتروني'),
                Forms\Components\TextInput::make('password')->label('كلمة المرور')->password()->revealable()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state)),
                Forms\Components\TextInput::make('phone')->label('رقم الهاتف'),
                Forms\Components\Select::make('city_id')->options(City::all()->pluck('name','id'))->label('مدينة/بلدة')->required()
                  ->relationship('city','name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->label('المدينة')->required(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('img')->collection('cities')->label('صورة الفئة')
                    ])
                ,
                Forms\Components\Textarea::make('description')->label('التفاصيل'),
                Forms\Components\TextInput::make('address')->label('العنوان'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ToggleColumn::make('is_active')->label('مفعل')->onColor('success')
                    ->offColor('danger')->offIcon('heroicon-m-no-symbol')
                    ->onIcon('heroicon-m-check')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_admin')->label('مدير ')->sortable()->searchable()
                ->onIcon('heroicon-m-user')->onColor('success')
                    ->offColor('danger')
                ,
                Tables\Columns\SpatieMediaLibraryImageColumn::make('صورة المستخدم')->collection('users')->circular()
                ,
                Tables\Columns\TextColumn::make('city.name')->label('مدينة/بلدة')->sortable()->searchable()
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
