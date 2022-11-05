<?php

namespace App\Filament\Resources\TopicResource\Pages;

use App\Filament\Resources\TopicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTopic extends ViewRecord
{
    protected static string $resource = TopicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
