<?php

namespace App\Filament\Resources;

use App\Enums\CourseCategory;
use Filament\Forms;
use Filament\Tables;
use App\Models\Courses;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CoursesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CoursesResource\RelationManagers;
use Filament\Forms\Components\Fieldset;

class CoursesResource extends Resource
{
    protected static ?string $model = Courses::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('course_slug')->required(),
                        TextInput::make('title')->required(),
                        Textarea::make('description')->required(),
                        Forms\Components\Select::make('course_category')
                            ->options(collect(CourseCategory::cases())->pluck('value', 'value'))
                            ->required(),
                        FileUpload::make('image')
                            ->directory('artikel-thumbnails')
                            ->image()
                            ->disk('public'),
                        Repeater::make('content')
                            ->schema([
                                TextInput::make('title')->label('Konten Judul'),
                                Textarea::make('paragraphs')->label('Paragraf'),
                                TextInput::make('bulletPoints')->label('Poin (pisahkan dengan koma)'),
                            ])
                            ->columnSpanFull(),
                        TextInput::make('num_course')
                            ->label('Number of course')
                            ->numeric()
                            ->minValue(0)
                            ->integer(),
                        Fieldset::make('Duration')
                            ->schema([
                                TextInput::make('duration_hours')
                                    ->label('Hours')
                                    ->numeric()
                                    ->minValue(0)
                                    ->integer(), // Use ->integer() if you don't want decimal hours
                                TextInput::make('duration_minutes')
                                    ->label('Minutes')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(59)
                                    ->integer(),
                            ])
                            ->columns(2),
                        TextInput::make('num_video')
                            ->label('Number of video')
                            ->numeric()
                            ->minValue(0)
                            ->integer(),
                        TextInput::make('num_quiz')
                            ->label('Number of quiz')
                            ->numeric()
                            ->minValue(0)
                            ->integer(),
                        TextInput::make('cta_link')->required(),

                        Repeater::make('related_courses')
                            ->schema([
                                TextInput::make('title')->label('Judul Course Terkait'),
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
                TextColumn::make('course_slug')->sortable()->searchable(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('description')->limit(50)->wrap(),
                TextColumn::make('course_category')->sortable()->searchable(),
                TextColumn::make('cta_link')->sortable()->searchable(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourses::route('/create'),
            'edit' => Pages\EditCourses::route('/{record}/edit'),
        ];
    }
}
