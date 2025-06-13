<?php

namespace App\Filament\Resources;

use App\Enums\Category;
use Filament\Forms;
use Filament\Tables;
use App\Models\Artikel;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ArtikelResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArtikelResource\RelationManagers;

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('slug')->required(),
                        TextInput::make('title')->required(),
                        Textarea::make('description')->required(),
                        Forms\Components\Select::make('category')
                            ->options(collect(Category::cases())->pluck('value', 'value'))
                            ->required(),
                        DatePicker::make('date')->required(),
                        FileUpload::make('image')
                            ->directory('artikel-thumbnails')
                            ->image()
                            ->disk('public'),

                        // Tambahkan konten sebagai Repeater
                        Repeater::make('content')
                            ->schema([
                                TextInput::make('title')->label('Konten Judul'),
                                Textarea::make('paragraphs')->label('Paragraf'),
                                TextInput::make('bulletPoints')->label('Poin (pisahkan dengan koma)'),
                            ])
                            ->columnSpanFull(),

                        // Tambahkan artikel terkait
                        Repeater::make('related_articles')
                            ->schema([
                                TextInput::make('title')->label('Judul Artikel Terkait'),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('description')->limit(50)->wrap(),
                TextColumn::make('category')->sortable()->searchable(),
                TextColumn::make('date')->sortable()->searchable(),
                ImageColumn::make('image')->disk('public')->width(50)->height(50),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit' => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
