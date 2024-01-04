<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    /**
     * The resource record title.
     */
    protected static ?string $recordTitleAttribute = 'title';

    /**
     * The resource model.
     */
    protected static ?string $model = Post::class;

    /**
     * The resource icon.
     */
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    /**
     * The resource navigation group.
     */
    protected static ?string $navigationGroup = 'Collections';

    /**
     * The resource navigation sort order.
     */
    protected static ?int $navigationSort = 0;

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    /**
     * Get the form for the resource.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\Section::make()
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->placeholder('Enter a title')
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, string $operation, ?string $old, ?string $state) {
                                        if (($get('slug') ?? '') !== Str::slug($old) || $operation !== 'create') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    })
                                    ->required()
                                    ->maxLength(255)
                                    ->autofocus(),

                                Forms\Components\Builder::make('content')
                                    ->required()
                                    ->columnSpanFull()
                                    ->default([
                                        ['type' => 'markdown'],
                                    ])
                                    ->blocks([
                                        Builder\Block::make('markdown')
                                            ->schema([
                                                Forms\Components\MarkdownEditor::make('content')
                                                    ->required(),
                                            ]),

                                        Builder\Block::make('figure')
                                            ->schema([
                                                CuratorPicker::make('image')
                                                    ->required(),

                                                Forms\Components\Fieldset::make()
                                                    ->label('Details')
                                                    ->schema([
                                                        Forms\Components\TextInput::make('alt')
                                                            ->label('Alt Text')
                                                            ->placeholder('Enter alt text')
                                                            ->required()
                                                            ->maxLength(255),

                                                        Forms\Components\TextInput::make('caption')
                                                            ->placeholder('Enter a caption')
                                                            ->maxLength(255),
                                                    ]),

                                            ]),
                                    ]),
                            ]),

                        Forms\Components\Section::make()
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\TextInput::make('slug')
                                    ->placeholder('Enter a slug')
                                    ->alphaDash()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                Forms\Components\Select::make('user_id')
                                    ->label('Author')
                                    ->relationship('user', 'name')
                                    ->default(fn () => auth()->id())
                                    ->searchable()
                                    ->required(),

                                CuratorPicker::make('image_id')
                                    ->label('Featured Image'),

                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->default(now())
                                    ->required(),

                                Forms\Components\Toggle::make('is_published')
                                    ->label('Published')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    /**
     * Get the table for the resource.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                CuratorColumn::make('image')
                    ->circular()
                    ->size(32),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->badge()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    /**
     * Get the relationships for the resource.
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Get the pages for the resource.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
