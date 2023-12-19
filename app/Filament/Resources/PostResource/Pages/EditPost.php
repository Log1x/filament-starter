<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    /**
     * The resource model.
     */
    protected static string $resource = PostResource::class;

    /**
     * The header actions.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view')
                ->label('View post')
                ->url(fn ($record) => $record->url)
                ->extraAttributes(['target' => '_blank']),

            Actions\DeleteAction::make(),
        ];
    }
}
