<?php

namespace App\Filament\Resources\ReplyResource\Pages;

use App\Filament\Resources\ReplyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReply extends ViewRecord
{
    protected static string $resource = ReplyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
