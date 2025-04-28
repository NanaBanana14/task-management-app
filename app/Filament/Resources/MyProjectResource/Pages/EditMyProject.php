<?php

namespace App\Filament\Resources\MyProjectResource\Pages;

use App\Filament\Resources\MyProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyProject extends EditRecord
{
    protected static string $resource = MyProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
