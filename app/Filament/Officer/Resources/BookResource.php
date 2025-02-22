<?php

namespace App\Filament\Officer\Resources;

use App\Filament\Officer\Resources\BookResource\Pages;
use App\Filament\Officer\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Models\Category;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->label('Title'),
                TextInput::make('author')->required()->label('Author'),
                TextInput::make('publisher')->required()->label('Publisher'),
                DatePicker::make('published_at')->required()->label('Published At'),
                TextInput::make('isbn')
                    ->required()
                    ->unique(Book::class, 'isbn', ignoreRecord: true)
                    ->label('ISBN (International Standard Book Number)'),
                Select::make('category_id')
                    ->label('Category')
                    ->options(Category::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                FileUpload::make('cover')
                    ->image()
                    ->label('Book Cover')
                    ->minSize(4)
                    ->maxSize(10240)
                    ->previewable(false)
                    ->directory('covers')
                    ->required(),
                FileUpload::make('pdf_file')
                    ->label('PDF File')
                    ->acceptedFileTypes(['application/pdf'])
                    ->minSize(4)
                    ->maxSize(25600)
                    ->required()
                    ->directory('pdfs')
                    ->previewable(false),
                RichEditor::make('description')
                    ->label('Description')
                    ->columnSpan(2),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('author')->label('Author')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('publisher')->label('Publisher')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('isbn')->label('ISBN')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->searchable(),
                Tables\Columns\TextColumn::make('published_at')->label('Publish Date')->searchable()->dateTime('d-M-Y'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(Category::pluck('name', 'id'))
                    ->searchable()
                    ->multiple()
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label(false)
                ->icon(false),
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
            'index' => Pages\ListBooks::route('/'),
            // 'create' => Pages\CreateBook::route('/create'),
            // 'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
