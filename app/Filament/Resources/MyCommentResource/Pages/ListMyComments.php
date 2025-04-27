<?php

namespace App\Filament\Resources\MyCommentResource\Pages;

use App\Filament\Resources\MyCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyComments extends ListRecords
{
    protected static string $resource = MyCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
