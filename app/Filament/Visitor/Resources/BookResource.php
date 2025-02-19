<?php

namespace App\Filament\Visitor\Resources;

use App\Filament\Visitor\Resources\BookResource\Pages;
use App\Models\Book;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\ContentGrid;
use Filament\Resources\Pages\Page;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Action;
use Filament\Infolists\Components\Actions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use function Symfony\Component\Translation\t;


class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Books';

    protected static ?string $navigationGroup = 'Library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Title'),
                Forms\Components\TextInput::make('author')
                    ->required()
                    ->label('Author'),
                Forms\Components\TextInput::make('publisher')
                    ->required()
                    ->label('Publisher'),
                Forms\Components\DatePicker::make('published_at')
                    ->required()
                    ->label('Published At'),
                Forms\Components\TextInput::make('isbn')
                    ->required()
                    ->unique(Book::class)
                    ->label('ISBN (International Standard Book Number)'),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(Category::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\FileUpload::make('cover')
                    ->image()
                    ->label('Book Cover')
                    ->minSize(4)
                    ->maxSize(10240)
                    ->previewable(false)
                    ->required(),
                Forms\Components\FileUpload::make('pdf_file')
                    ->label('PDF File')
                    ->acceptedFileTypes(['application/pdf'])
                    ->minSize(4)
                    ->maxSize(25600)
                    ->required()
                    ->previewable(false),
                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    ImageColumn::make('cover')
                        ->label('Cover')
                        ->width(250)
                        ->height(400)
                        ->tooltip(fn($record) => $record->title . ' - ' . $record->author),
                    // TextColumn::make('title')
                    //     ->label('Title')
                    //     ->extraAttributes(['class' => 'font-bold'])
                    //     ->searchable()
                    //     ->sortable()
                ])


            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->multiple()
                    ->options(Category::pluck('name', 'id'))
                    ->searchable(),
            ])
            ->actions([
                ViewAction::make()->label(false)->icon(false)->slideOver(),
            ])
            ->contentGrid([
                'sm' => 1,
                'md' => 3,
                'xl' => 4,
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Split::make([])
                ImageEntry::make('cover')
                    ->label(false)
                    ->width(250)
                    ->height(400)
                    ->columns(),
                Section::make()
                    ->schema([
                    TextEntry::make('title')
                        ->columns(),
                    TextEntry::make('author')
                        ->columns(),
                    TextEntry::make('publisher')
                        ->columns(),
                    TextEntry::make('published_at')
                        ->columns(),
                    TextEntry::make('isbn')
                        ->columns(),
                    TextEntry::make('category.name')
                        ->columns(),
                    TextEntry::make('description')
                    ->default('No description :)')
                        ->markdown()
                        ->columns(),
                ])->label(false)->columns(),



                // Section::make('Contact Information')
                //     ->schema([
                //         TextEntry::make('email'),
                //         TextEntry::make('phone_number'),
                //     ])
                //     ->columns(),
                // Section::make('Additional Details')
                //     ->schema([
                //         TextEntry::make('description'),
                //     ]),
                // Section::make('Lead and Stage Information')
                //     ->schema([
                //         TextEntry::make('leadSource.name'),
                //         TextEntry::make('pipelineStage.name'),
                //     ])
                //     ->columns(),
            ]);
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
